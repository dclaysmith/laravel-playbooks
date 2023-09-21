<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstanceAction extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_FAILED = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_instance_actions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "lp_instance_id",
        "lp_instance_step_id",
        "lp_playbook_action_id",
        "status_id",
        "completed_at"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ["completed_at" => "datetime"];

    public function instance()
    {
        return $this->belongsTo(
            \Dclaysmith\LaravelPlaybooks\Models\Instance::class,
            "lp_instance_id"
        );
    }

    public function instanceStep()
    {
        return $this->belongsTo(
            \Dclaysmith\LaravelPlaybooks\Models\InstanceStep::class,
            "lp_instance_step_id"
        );
    }

    public function playbookAction()
    {
        return $this->belongsTo(
            \Dclaysmith\LaravelPlaybooks\Models\PlaybookAction::class,
            "lp_playbook_action_id"
        );
    }
}
