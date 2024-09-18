<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller {
  public function index() {
    $usertype = request()->get('usertype', 'student');

    $approvedStudentIds = Enrollment::where('status', 'approved')->pluck('user_id');

    if ($usertype === 'incharge') {
      $users = User::where('usertype', $usertype)->paginate(10);
    } else {
      $users = User::where('usertype', $usertype)
        ->whereIn('id', $approvedStudentIds)
        ->paginate(10);
    }

    return view('administrators.users', compact('users', 'usertype'));
  }

  public function show(User $user) {
    return view('layout.profile', compact('user'));
  }

  public function store() {
    $usertype = request()->get('usertype', 'student');
    $commonRules = [
      'image' => 'image|nullable',
      'firstname' => 'required',
      'lastname' => 'required',
      'nickname' => 'required',
      'birthdate' => 'required|date',
      'gender' => 'required',
      'contactnumber' => 'required|digits:11',
      'email' => 'required|email|unique:users,email',
      'password' => 'required'
    ];

    $extraRules = $usertype === 'student'
      ? ['course' => 'required', 'year' => 'required|integer|digits:1']
      : [];

    $validated = request()->validate(array_merge($commonRules, $extraRules));

    $validated['middlename'] = request()->get('middlename', ' ');

    $validated['usertype'] = 'student';
    if ($usertype === 'incharge') {
      $validated['usertype'] = 'incharge';
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;
    }

    $user = User::create($validated);

    if ($validated['usertype'] === 'student') {
      if (!auth()->check()) {
        Enrollment::create(['user_id' => $user->id]);
      } else if ($usertype === 'student') {
        Enrollment::create(['user_id' => $user->id, 'status' => 'approved']);
      }
    }

    if (!auth()->check()) {
      return redirect()->route('index')->with('success', 'ID: ' . $user->id . ' You have been enrolled, please wait for your enrollment to be approved');
    }

    if ($usertype === 'student') {
      return redirect()->route('users.index')->with('success', 'Student enrolled!');
    } else if ($usertype === 'incharge') {
      return redirect()->route('users.index', ['usertype' => 'incharge'])->with('success', 'Incharge added!');
    }
    return redirect()->route('enrollments.index')->with('success', 'Student enrollment is being processed');
  }

  public function updatePersonalInfo(User $user) {
    $commonRules = [
      'image' => 'image|nullable',
      'firstname' => 'required',
      'lastname' => 'required',
      'nickname' => 'required',
      'birthdate' => 'required|date',
      'gender' => 'required',
      'contactnumber' => 'required|digits:11',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($user->id),
      ],
    ];

    $extraRules = auth()->user()->usertype === 'student'
      ? ['course' => 'required', 'year' => 'required|integer|digits:1']
      : [];

    $validated = request()->validate(array_merge($commonRules, $extraRules));

    $validated['middlename'] = request()->get('middlename', ' ');

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;

      if ($user->image) {
        $existingImagePath = public_path('profile') . '/' . $user->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $user->update($validated);

    return redirect()->route('users.show', $user->id)->with('success', 'Profile updated');
  }

  public function updatePassword(User $user) {
    $validated = request()->validate([
      'password' => 'required',
    ]);

    $user->update($validated);

    return redirect()->route('users.show', $user->id)->with('success', 'Password updated');
  }

  public function update(User $user) {
    $usertype = request()->get('usertype', 'student');
    $commonRules = [
      'image' => 'image|nullable',
      'firstname' => 'required',
      'lastname' => 'required',
      'nickname' => 'required',
      'birthdate' => 'required|date',
      'gender' => 'required',
      'contactnumber' => 'required|digits:11',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($user->id),
      ],
    ];

    $extraRules = $usertype === 'student'
      ? ['course' => 'required', 'year' => 'required|integer|digits:1']
      : [];

    $validated = request()->validate(array_merge($commonRules, $extraRules));

    $validated['middlename'] = request()->get('middlename', ' ');

    if (request()->get('password') != null) {
      $validated['password'] = request()->get('password');
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;

      if ($user->image) {
        $existingImagePath = public_path('profile') . '/' . $user->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $user->update($validated);

    if ($usertype === 'student') {
      return redirect()->route('users.index')->with('success', 'Student updated');
    }
    return redirect()->route('users.index', ['usertype' => 'incharge'])->with('success', 'Incharge updated');
  }

  public function destroy(User $user) {
    $usertype = request()->get('usertype', 'student');
    $user->delete();

    if ($user->image) {
      $existingImagePath = public_path('profile') . '/' . $user->image;
      if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
      }
    }
    if ($usertype === 'student') {
      return redirect()->route('users.index')->with('success', 'Student deleted');
    }
    return redirect()->route('users.index', ['usertype' => 'incharge'])->with('success', 'Incharge deleted');
  }
}
