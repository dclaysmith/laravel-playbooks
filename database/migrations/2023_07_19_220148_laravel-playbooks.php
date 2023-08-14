<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create("lp_playbooks", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("target_class");
            $table->boolean("allow_multiple");
            $table->integer("multiple_buffer_days");
            $table->boolean("allow_concurrent");
            $table->timestamps();
        });

        Schema::create("lp_playbook_audiences", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_playbook_id")
                ->constrained()
                ->onDelete("CASCADE");
            $table->string("class_name");
            $table->string("exit_action"); # CONTINUE | CANCEL
            $table->datetime("last_ran_at")->nullable(true);
            $table->timestamps();

            $table->index("lp_playbook_id");
        });

        Schema::create("lp_playbook_steps", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_playbook_id")
                ->constrained()
                ->onDelete("CASCADE");
            $table->string("name");
            $table->string("condition_class_name")->nullable(true);
            $table->integer("sort_order");

            $table->timestamps();

            $table->index("lp_playbook_id");
        });

        Schema::create("lp_playbook_actions", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_playbook_id")
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_step_id")
                ->constrained()
                ->onDelete("CASCADE");
            $table->string("name");
            $table->string("case"); # IF | ELSE | FINALLY
            $table->string("action_class_name");
            $table->jsonb("configuration");
            $table->integer("sort_order");

            $table->timestamps();

            $table->index("lp_playbook_id");
            $table->index("lp_playbook_step_id");
        });

        Schema::create("lp_logs", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_playbook_id")
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_step_id")
                ->nullable(true)
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_action_id")
                ->nullable(true)
                ->constrained()
                ->onDelete("CASCADE");

            $table->integer("status_id")
                ->nullable(true); # PENDING | COMPLETE | ERROR

            $table->string("message");
            $table->jsonb("details");

            $table->timestamps();

            $table->index("lp_playbook_id");
            $table->index("lp_playbook_step_id");
            $table->index("lp_playbook_action_id");
        });

        Schema::create("lp_instances", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_playbook_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->string("target_id")
                ->nullable(false);
            $table->integer("status_id"); # IN PROGRESS | COMPLETE | FAILED
            $table->string("audience_class_name")->nullable(true);
            $table->timestamps();

            $table->index("lp_playbook_id");
            $table->index("lp_playbook_step_id");
            $table->index("lp_playbook_action_id");
        });

        Schema::create("lp_instance_steps", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_instance_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_step_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");

            $table->integer("status_id"); # PENDING | COMPLETE | FAILED

            $table->datetime("completed_at")->nullable(true);

            $table->timestamps();

            $table->index("lp_playbook_step_id");
            $table->index("lp_instance_id");
        });

        Schema::create("lp_instance_actions", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lp_instance_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_step_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");
            $table
                ->foreignId("lp_playbook_action_id")
                ->nullable(false)
                ->constrained()
                ->onDelete("CASCADE");

            $table->integer("status_id"); # PENDING | COMPLETE | FAILED

            $table->datetime("completed_at")->nullable(true);

            $table->timestamps();

            $table->index("lp_playbook_action_id");
            $table->index("lp_playbook_step_id");
            $table->index("lp_instance_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("lp_instance_actions");
        Schema::dropIfExists("lp_instance_steps");
        Schema::dropIfExists("lp_instances");
        Schema::dropIfExists("lp_logs");
        Schema::dropIfExists("lp_playbook_actions");
        Schema::dropIfExists("lp_playbook_steps");
        Schema::dropIfExists("lp_playbook_audiences");
        Schema::dropIfExists("lp_playbooks");
    }
};
