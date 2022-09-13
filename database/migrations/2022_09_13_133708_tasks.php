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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id')->autoIncrement()->unsigned();
            $table->string('task_name', 255)->nullable(false);
            $table->longText('task_description')->nullable(false);
            $table->enum('task_priority', ['low', 'medium', 'high'])->nullable(false);
            $table->enum('task_status', ['todo', 'in_progress', 'done'])->nullable(false);
            $table->integer('task_order')->nullable(false);
            $table->timestamp('task_created_at')->useCurrent();
            $table->timestamp('task_updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
