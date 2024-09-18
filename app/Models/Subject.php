<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
  use HasFactory;

  protected $guarded = [];

  public function users() {
    return $this->hasMany(UsersSubject::class);
  }

  public function getFullDaysAttribute() {
    $days = explode(',', $this->attributes['day']);
    $fullDays = [];

    foreach ($days as $day) {
      switch ($day) {
        case 'M':
          $fullDays[] = 'Monday';
          break;
        case 'T':
          $fullDays[] = 'Tuesday';
          break;
        case 'W':
          $fullDays[] = 'Wednesday';
          break;
        case 'TH':
          $fullDays[] = 'Thursday';
          break;
        case 'F':
          $fullDays[] = 'Friday';
          break;
        case 'S':
          $fullDays[] = 'Saturday';
          break;
      }
    }

    return implode(', ', $fullDays);
  }
}
