<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('plan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('plan_percent');
            $table->string('amount');
            $table->string('duration');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('earned');
            $table->string('last_check');
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
