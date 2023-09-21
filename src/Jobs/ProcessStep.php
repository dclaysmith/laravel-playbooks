<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use Dclaysmith\LaravelPlaybooks\Models\InstanceStep;
use Dclaysmith\LaravelPlaybooks\Models\InstanceAction;

/*
|--------------------------------------------------------------------------
| ProcessStep
|--------------------------------------------------------------------------
|
| Execute a Step
|
*/

class ProcessStep implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $instanceStep;

    public function __construct(
        InstanceStep $instanceStep,
    ) {
        $this->instanceStep = $instanceStep;
    }

    public function handle()
    {
        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep: Id - " . $this->instanceStep->id);

        /**
         * Is there a condition?
         */
        $conditionResult = $this->evaluateCondition();

        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep: Condition Result - " . $conditionResult);

        /**
         * Actions associated with this step
         */
        $playbookActions = $this->instanceStep->playbookStep->playbookActions;

        /**
         * If True, Run True Steps
         */
        if (TRUE === $conditionResult) {
            
            $filtered = $playbookActions->filter(function ($playbookAction) {
                return $playbookAction->case == 'true';
            });

            Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep: TRUE Count - " . count($filtered));

            foreach ($filtered as $playbookAction) {
                $instanceAction = new InstanceAction;
                $instanceAction->lp_instance_id = $this->instanceStep->lp_instance_id;
                $instanceAction->lp_instance_step_id = $this->instanceStep->id;
                $instanceAction->lp_playbook_action_id = $playbookAction->id;
                $instanceAction->status_id = InstanceAction::STATUS_PENDING;
                $instanceAction->save();
            }
        }

        /**
         * Else if False, Run False Steps
         */
        if (FALSE === $conditionResult) {

            $filtered = $playbookActions->filter(function ($playbookAction) {
                return $playbookAction->case == 'false';
            });

            Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep: FALSE Count - " . count($filtered));

            foreach ($filtered as $playbookAction) {
                $instanceAction = new InstanceAction;
                $instanceAction->lp_instance_id = $this->instanceStep->lp_instance_id;
                $instanceAction->lp_instance_step_id = $this->instanceStep->id;
                $instanceAction->lp_playbook_action_id = $playbookAction->id;
                $instanceAction->status_id = InstanceAction::STATUS_PENDING;
                $instanceAction->save();
            }
        }

        /**
         * Add finally conditions
         */
        $filtered = $playbookActions->filter(function ($playbookAction) {
            return $playbookAction->case == 'finally';
        });

        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep: FINALLY Count - " . count($filtered));

        foreach ($filtered as $playbookAction) {
            $instanceAction = new InstanceAction;
            $instanceAction->lp_instance_id = $this->instanceStep->lp_instance_id;
            $instanceAction->lp_instance_step_id = $this->instanceStep->id;
            $instanceAction->lp_playbook_action_id = $playbookAction->id;
            $instanceAction->status_id = InstanceAction::STATUS_PENDING;
            $instanceAction->save();
        }  
        
        $this->instanceStep->status_id = \Dclaysmith\LaravelPlaybooks\Models\InstanceStep::STATUS_COMPLETED;
        $this->instanceStep->save();        
    }

    private function evaluateCondition() {

        Log::debug(
            "Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep->evaluateCondition() - condition_class_name " . 
            $this->instanceStep->playbookStep->condition_class_name
        );

        /**
         * If there is no class name, evalutes as TRUE
         */
        if (!$className = $this->instanceStep->playbookStep->condition_class_name) {
            return true;
        }

        /**
         * Get the fully namesapced classname
         */
        $namespacedClass = "\\App\\Packages\\LaravelPlaybooks\\Conditions\\" . $className;

        /** 
         * Create an instance of the condition 
         */
        $instance = new $namespacedClass();

        /**
         * Get an instance of the target
         */
        if (!$target = $this->instanceStep->instance->target) {
            throw new \Exception("No target instance.");
        }

        /**
         * Test the condition on the target
         */
        return $instance::check($target);
    }
}
