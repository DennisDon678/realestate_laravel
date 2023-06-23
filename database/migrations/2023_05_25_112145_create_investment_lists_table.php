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
        Schema::create('investment_lists', function (Blueprint $table) {
            $table->id();
            $table->string('plan_id');
            $table->string('basic_min');
            $table->string('basic_max');
            $table->string('basic_percent');
            $table->string('elite_min');
            $table->string('elite_max');
            $table->string('elite_percent');
            $table->string('pro_min');
            $table->string('pro_percent');
            $table->string('image');
            $table->string('size');
            $table->string('rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_lists');
    }
};
