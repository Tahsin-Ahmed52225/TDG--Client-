<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string("project_name");
            $table->string("assign_employee");
            $table->integer("manager_id");
            $table->integer("project_manager_id")->nullable();
            $table->timestamp("due_date");
            $table->string("status");
            $table->string("priority");
            $table->text("description")->nullable();
            $table->text("project_type");
            $table->integer("budget")->nullable();
            $table->integer("payment_amount")->nullable();
            $table->integer("client_id")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
