<?php

use App\Models\UsersSubject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('users_subjects', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
      $table->timestamps();
    });

    UsersSubject::insert([
      [
        'user_id' => 202002,
        'subject_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 202002,
        'subject_id' => 2,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 202002,
        'subject_id' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('users_subjects');
  }
};
