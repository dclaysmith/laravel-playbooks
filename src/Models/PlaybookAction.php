<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaybookAction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_playbook_actions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "lp_playbook_id",
        "lp_playbook_step_id",
        "name",
        "case",
        "action_class_name",
        "configuration",
        "sort_order",
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
    protected $casts = [];

    public function playbook()
    {
        return $this->belongsTo(
            \Dclaysmith\LaravelPlaybooks\Models\Playbook::class,
            "lp_playbook_id"
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
