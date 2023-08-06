<?php

namespace Dclaysmith\LaravelPlaybooks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instance extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED_AUDIENCE = 3;
    const STATUS_CANCELLED_MANUALLY = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "lp_instances";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "lp_playbook_id",
        "target_id",
        "status_id",
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
