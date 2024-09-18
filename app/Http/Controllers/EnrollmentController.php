<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\UsersSubject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller {
  public function index() {
    $enrollments = Enrollment::orderBy('id', 'ASC')->paginate(10);
    $subjects = Subject::get();

    return view('administrators.enrollment', compact('enrollments', 'subjects'));
  }

  public function update(Enrollment $enrollment) {

    $validated = request()->validate([
      'status' => 'required',
    ]);

    $val = request()->validate([
      'subjects_id' => 'array',
    ]);

    $user_id = $enrollment->user_id;

    UsersSubject::where('user_id', $user_id)->delete();

    if (isset($val['subjects_id']) && is_array($val['subjects_id'])) {
      foreach ($val['subjects_id'] as $subject_id) {
        UsersSubject::create([
          'user_id' => $user_id,
          'subject_id' => $subject_id,
        ]);
      }
    }

    $enrollment->update($validated);

    return redirect()->route('enrollments.index')->with('success', 'Enrollee updated');
  }
}
