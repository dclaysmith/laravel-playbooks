<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Cms Paths
         * - Stores a history of any paths for a page. If matched will 30X redirect to current
         */
        Schema::create("lp_activities", function (Blueprint $table) {
            $table->id();
            // $table
            //     ->foreignId("some_id")
            //     ->constrained()
            //     ->onDelete("CASCADE");
            $table->string("target_id");
            $table->string("sequence_id");


            $table->timestamps();

            $table->index("target_id");

            $table->unique(["target_id", "user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists("table_name");
    }
};
