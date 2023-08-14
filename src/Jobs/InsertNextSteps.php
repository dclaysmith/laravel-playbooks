<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



/*
|--------------------------------------------------------------------------
| InsertNextSteps
|--------------------------------------------------------------------------
|
| Look for playbooks with steps to be actioned
|
*/

class InsertNextSteps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\InsertNextSteps");

        /**
         * Query the items
         */
        $sql = <<<eof
WITH to_insert AS (
    SELECT
        *
    FROM
        (
            SELECT
                ROW_NUMBER() OVER (
                    PARTITION BY "instance_id"
                    ORDER BY "sort_order" ASC
                ) AS "rank",
                *
            FROM
                (
                    SELECT 
                        lp_instances.id AS instance_id, 
                        lp_playbook_steps.id AS playbook_step_id, 
                        lp_playbook_steps.name AS name, 
                        lp_instance_steps.id AS instance_step_id, 
                        lp_playbook_steps.sort_order
                    FROM 
                        lp_instances 
                    JOIN
                        lp_playbooks ON lp_instances.lp_playbook_id = lp_playbooks.id
                    JOIN 
                        lp_playbook_steps ON  lp_playbook_steps.lp_playbook_id =  lp_playbooks.id
                    LEFT JOIN 
                        lp_instance_steps ON lp_instance_steps.lp_instance_id = lp_instances.id AND lp_instance_steps.lp_playbook_step_id = lp_playbook_steps.id
                    WHERE
                        (lp_instance_steps.id IS NULL
                            OR
                        lp_instance_steps.status_id = 1)
                            AND
                        lp_instances.status_id = 1
                    ORDER BY 
                        lp_playbook_steps.sort_order ASC
                ) sub1
        ) sub
    WHERE 
        "sub"."rank" = 1
        AND instance_step_id IS NULL
    ORDER BY
        "sub"."instance_id" ASC,
        "sub"."sort_order" DESC
)
INSERT INTO lp_instance_steps
    (
        lp_instance_id, 
        lp_playbook_step_id,
        status_id, 
        created_at, 
        updated_at
    )
SELECT
    instance_id, 
    playbook_step_id,
    1 AS status_id,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
FROM 
    to_insert;
eof;

        DB::insert($sql);
    }
}
