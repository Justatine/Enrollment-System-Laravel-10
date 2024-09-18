<?php

use App\Models\Enrollment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('enrollments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('status')->default('pending');
      $table->timestamps();
    });

    Enrollment::insert([
      [
        'user_id' => 202002,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 202003,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 202004,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('enrollments');
  }
};
