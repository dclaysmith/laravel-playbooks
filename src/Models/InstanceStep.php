<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstanceStep extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_ACTIONS_CREATED = 2;
    const STATUS_COMPLETED = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_instance_steps";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "lp_instance_id",
        "lp_playbook_step_id",
        "status_id",
        "completed_at",
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

    public function playbookStep()
    {
        return $this->belongsTo(
            \Dclaysmith\LaravelPlaybooks\Models\PlaybookStep::class,
            "lp_playbook_step_id"
        );
    }
}
