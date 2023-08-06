<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

use Dclaysmith\LaravelPlaybooks\Models\Instance;
use Google\Service\AndroidEnterprise\Install;

/*
|--------------------------------------------------------------------------
| RunAudiences
|--------------------------------------------------------------------------
|
| Process a single audience
|
*/

class RunAudience implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $playbookAudience;

    public function __construct(
        PlaybookAudience $playbookAudience,
    ) {
        $this->playbookAudience = $playbookAudience;
    }

    public function handle()
    {

        $className = "\\App\\Packages\\LaravelPlaybooks\\Audiences\\" . $this->playbookAudience->class_name;

        // A query of likely 'users'
        $builder = $className::builder();

        // Likely \App\Models\User
        $model = $builder->getModel();

        // Likely 'users'
        $table = $model->getTable();

        // Select models from audience query not already in instances
        $clone = clone $builder;
        $newInstances = $clone->leftJoinSub(Instance::query(), "instances", function (JoinClause $join) use ($table) {
            $join->on("$table.id", "=", "instances.target_id");
            $join->where("instances.lp_playbook_id", $this->playbookAudience->lp_playbook_id);
        })->whereNull("instances.id")->select("$table.*")->get();

        // Add these to instances
        foreach ($newInstances as $newInstance) {
            $instance = new \Dclaysmith\LaravelPlaybooks\Models\Instance();
            $instance->lp_playbook_id = $this->playbookAudience->lp_playbook_id;
            $instance->target_id = $newInstance->id;
            $instance->status_id = Instance::STATUS_ACTIVE;
            $instance->audience_class_name = $this->playbookAudience->class_name;
            $instance->save();
        }

        // Select instances where target no longer in audience
        $clone = clone $builder;
        $oldInstances = Instance::query() // lp_instances
            ->join("lp_playbooks", "lp_playbooks.id", "=", "lp_instances.lp_playbook_id")
            ->join("lp_playbook_audiences", function (JoinClause $join) {
                $join->on("lp_playbook_audiences.lp_playbook_id", "=", "lp_instances.lp_playbook_id");
                $join->where("lp_playbook_audiences.class_name", $this->playbookAudience->class_name);
                $join->where("lp_playbook_audiences.exit_action", "CANCEL");
            })
            ->leftJoinSub($clone, "audience", function (JoinClause $join) use ($model) {
                $join->on("audience.id", "=", "lp_instances.target_id");
            })
            ->where("lp_instances.lp_playbook_id", $this->playbookAudience->lp_playbook_id)
            ->whereNull("audience.id")
            ->select("lp_instances.*")
            ->get();

        // Cancel these instances
        foreach ($oldInstances as $oldInstance) {
            $oldInstance->status_id = Instance::STATUS_CANCELLED_AUDIENCE;
            $oldInstance->save();
        }
    }
}
