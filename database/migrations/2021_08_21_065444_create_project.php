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
            $table->string("name");
            $table->string("assign_employee");
            $table->timestamp("due_date");
            $table->string("status");
            $table->string("priority");
            $table->text("description")->nullable();
            $table->integer("budget")->nullable();
            $table->integer("payment_amount")->nullable();
            $table->integer("manager_id");
            $table->integer("client_id")->nullable();
            $table->string('project_files', 255)->nullable();
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
