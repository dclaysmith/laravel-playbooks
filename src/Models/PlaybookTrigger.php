<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaybookTrigger extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_playbook_triggers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "lp_playbook_id",
        "class_name",
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
}
