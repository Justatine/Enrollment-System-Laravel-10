<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
  use AuthorizesRequests, ValidatesRequests;

  public function index() {
    return view('layout.index');
  }

  public function register() {
    return view('guest.enrollment');
  }

  public function authenticate() {
    $validated = request()->validate([
      'id' => 'required',
      'password' => 'required',
    ]);

    if (auth()->attempt($validated)) {
      $user = auth()->user();

      if ($user->usertype === 'student') {
        $enrollmentStatus = $user->enrollment->status ?? null;

        if ($enrollmentStatus === 'approved') {
          request()->session()->regenerate();
          return redirect()->route('index')->with('success', 'User logged in!');
        } elseif ($enrollmentStatus === 'pending') {
          auth()->logout();
          return redirect()->route('index')->with('failed', 'Your enrollment is pending. Please wait for approval.');
        } elseif ($enrollmentStatus === 'denied') {
          auth()->logout();
          return redirect()->route('index')->with('failed', 'Your enrollment is denied.');
        }
      } else {
        request()->session()->regenerate();
        return redirect()->route('index')->with('success', 'User logged in!');
      }
    }

    return redirect()->route('index')->with('failed', 'Invalid id or password');
  }

  public function logout() {
    auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('index')->with('success', 'Logged out successfully');
  }
}
