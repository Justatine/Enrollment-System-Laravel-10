<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('firstname');
      $table->string('middlename')->nullable();
      $table->string('lastname');
      $table->string('nickname');
      $table->string('course')->nullable();
      $table->unsignedInteger('year')->nullable();
      $table->date('birthdate');
      $table->string('gender');
      $table->string('contactnumber');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('usertype');
      $table->string('image')->nullable();
      $table->timestamps();
    });

    User::insert([
      [
        'id' => 202000,
        'firstname' => 'Micky',
        'middlename' => 'Mouse',
        'lastname' => 'Clubhouse',
        'nickname' => 'mikmik',
        'course' => null,
        'year' => null,
        'birthdate' => '2000-01-01',
        'gender' => 'male',
        'contactnumber' => '09342862942',
        'email' => 'incharge@gmail.com',
        'password' => Hash::make('1234'),
        'usertype' => 'incharge',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 202001,
        'firstname' => 'Por',
        'middlename' => 'Pavore',
        'lastname' => 'Amigo',
        'nickname' => 'amigo',
        'course' => null,
        'year' => null,
        'birthdate' => '2000-01-01',
        'gender' => 'male',
        'contactnumber' => '09342862942',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('1234'),
        'usertype' => 'admin',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 202002,
        'firstname' => 'John',
        'middlename' => 'Constantine',
        'lastname' => 'Doe',
        'nickname' => 'johnny',
        'course' => 'BSIT',
        'year' => 1,
        'birthdate' => '2000-01-01',
        'gender' => 'male',
        'contactnumber' => '09342862942',
        'email' => 'user@gmail.com',
        'password' => Hash::make('1234'),
        'usertype' => 'student',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 202003,
        'firstname' => 'Oveenus',
        'middlename' => 'Mars',
        'lastname' => 'Earth',
        'nickname' => 'Veenus',
        'course' => 'BSIT',
        'year' => 1,
        'birthdate' => '2000-01-01',
        'gender' => 'male',
        'contactnumber' => '09342862942',
        'email' => 'veenus@gmail.com',
        'password' => Hash::make('1234'),
        'usertype' => 'student',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 202004,
        'firstname' => 'Wais',
        'middlename' => 'Notwise',
        'lastname' => 'Smart',
        'nickname' => 'wais',
        'course' => 'BSIT',
        'year' => 1,
        'birthdate' => '2000-01-01',
        'gender' => 'male',
        'contactnumber' => '09342862942',
        'email' => 'wais@gmail.com',
        'password' => Hash::make('1234'),
        'usertype' => 'student',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('users');
  }
};
