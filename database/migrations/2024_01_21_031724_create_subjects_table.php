<?php

use Carbon\Carbon;
use App\Models\Subject;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('subjects', function (Blueprint $table) {
      $table->id();
      $table->string('subject');
      $table->text('description');
      $table->string('room');
      $table->string('day');
      $table->time('schedulein');
      $table->time('scheduleout');
      $table->string('instructor');
      $table->timestamps();
    });

    Subject::insert([
      [
        'subject' => 'Mathematics',
        'description' => 'Mathematics',
        'room' => '304',
        'day' => 'M,W,F',
        'schedulein' => Carbon::parse('08:00:00'),
        'scheduleout' => Carbon::parse('10:00:00'),
        'instructor' => 'Sir Jacinto',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'subject' => 'English',
        'description' => 'English',
        'room' => '305',
        'day' => 'T,TH',
        'schedulein' => Carbon::parse('10:30:00'),
        'scheduleout' => Carbon::parse('12:30:00'), 
        'instructor' => 'Maam Joy',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'subject' => 'Filipino',
        'description' => 'Filipino',
        'room' => '306',
        'day' => 'F,S',
        'schedulein' => Carbon::parse('13:00:00'),
        'scheduleout' => Carbon::parse('15:00:00'), 
        'instructor' => 'Sir Presinto',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('subjects');
  }
};
