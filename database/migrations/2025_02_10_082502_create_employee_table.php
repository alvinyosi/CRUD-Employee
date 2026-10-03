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
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->enum('gender', ['male','female']);
            $table->string('address',100)->nullable();
            $table->date('dob');
            $table->foreignId('dept_id')->constrained('department', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->enum('status', ['cont','emp', 'not_act']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
