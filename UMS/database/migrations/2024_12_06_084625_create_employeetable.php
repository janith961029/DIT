<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->enum('rank', ['Sgm', 'lcpl', 'cpl', 'sgt', 'ssgt', 'woi', 'woii'])->notNull();
        $table->string('serno')->notNull();
        $table->string('name')->notNull();
        $table->date('dob')->notNull();
        $table->string('image')->nullable();
        $table->enum('gender', ['male', 'female','other'])->notNull();
        $table->enum('squadron', ['HQ', 'radio', 'tele', 'computer', 'relay'])->notNull(); // Renamed this column
        $table->enum('position', ['ssm', 'technician', 'clerk', 'foreman', 'di', 'rsm'])->notNull(); // Renamed this column
        $table->string('email')->notNull();
        $table->string('address')->notNull();
        $table->string('teleno')->notNull();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeetable');
    }
};
