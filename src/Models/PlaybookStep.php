<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaybookStep extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_playbook_steps";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "condition_class_name",
        "lp_playbook_id",
        "name",
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

    public function playbookActions()
    {
        return $this->hasMany(
            \Dclaysmith\LaravelPlaybooks\Models\PlaybookAction::class,
            "lp_playbook_step_id"
        );
    }
}
