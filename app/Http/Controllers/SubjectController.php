<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller {
  public function index() {
    $subjects = Subject::paginate(5);
    return view('administrators.subjects', compact('subjects'));
  }

  public function store(){
    $validated = request()->validate([
      'subject' => 'required|unique:subjects,subject',
      'description' => 'required',
      'room' => 'required',
      'schedulein' => 'required',
      'scheduleout' => 'required',
      'instructor' => 'required',
    ]);

    $validated['day'] = implode(',', request()->get('days_id'));

    Subject::create($validated);

    return redirect()->route('subjects.index')->with('success', 'Subject added');
  }

  public function update(Subject $subject) {
    $validated = request()->validate([
      'subject' => [
        'required',
        Rule::unique('subjects', 'subject')->ignore($subject->id),
      ],
      'description' => 'required',
      'room' => 'required',
      'schedulein' => 'required',
      'scheduleout' => 'required',
      'instructor' => 'required',
    ]);
    
    $validated['day'] = implode(',', request()->get('days_id'));

    $subject->update($validated);

    return redirect()->route('subjects.index')->with('success', 'Subject updated');
  }

  public function destroy(Subject $subject) {
    $subject->delete();

    return redirect()->route('subjects.index')->with('success', 'Subject deleted');
  }
}
