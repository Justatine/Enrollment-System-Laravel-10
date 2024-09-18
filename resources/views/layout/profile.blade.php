@extends('layout.layout')

@section('content')
  <section class="content ">
    <div class="container mb-5">
      <h6 class="text-info pt-5">
        @if (auth()->user()->usertype === 'student')
          STUDENT
        @elseif (auth()->user()->usertype === 'incharge')
          INCHARGE
        @elseif (auth()->user()->usertype === 'admin')
          ADMIN
        @endif
        ID NUMBER: <span class="font-weight-bold">{{ $user->id }}</span>
      </h6>
      <h4 class="mt-3">Personal Information</h4>
      <img src="{{ $user->image() }}" class="userprof" alt="" />
      <div class="row">
        <div class="col-md-6 mt-5">
          <p class="font-weight-bold">
            Firstname: <span class="font-weight-normal">{{ $user->firstname }}</span>
          </p>
          <p class="font-weight-bold">
            Middile Name: <span class="font-weight-normal">{{ $user->middlename }}</span>
          </p>
          <p class="font-weight-bold">
            Birthdate: <span
              class="font-weight-normal">{{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}</span>
          </p>
          <p class="font-weight-bold">
            Email Address: <span class="font-weight-normal">{{ $user->email }}</span>
          </p>
          @if (auth()->user()->usertype === 'student')
            <p class="font-weight-bold">
              Year Level: <span class="font-weight-normal">{{ $user->year }}</span>
            </p>
            <p class="font-weight-bold">
              Course: <span class="font-weight-normal">{{ $user->course }}</span>
            </p>
          @endif
        </div>
        <div class="col-md-6 mt-5">
          <p class="font-weight-bold">
            Lastname: <span class="font-weight-normal">{{ $user->lastname }}</span>
          </p>
          <p class="font-weight-bold">
            Gender: <span class="font-weight-normal">{{ $user->gender }}</span>
          </p>
          <p class="font-weight-bold">
            Contact Number: <span class="font-weight-normal">{{ $user->contactnumber }}</span>
          </p>
          @if (auth()->user()->usertype === 'student')
            <br>
            <div class="row">
              <div class="col-md-2 font-weight-bold">
                <label for="subject">Subject:</label>
              </div>
              <div class="col-md-1 font-weight-bold">
                <label for="subject">Days:</label>
              </div>
              <div class="col-md-4 font-weight-bold text-center">
                <label for="subject">Schedule:</label>
              </div>
              <div class="col-md-2 font-weight-bold">
                <label for="subject">Room:</label>
              </div>
              <div class="col-md-3 font-weight-bold">
                <label for="subject">Instructor:</label>
              </div>

            </div>
            @forelse ($user->subjects as $subject)
              <div class="row">
                <div class="col-md-2">
                  <span class="font-weight-normal">{{ $subject->subject }}</span>
                </div>
                <div class="col-md-1">
                  <span class="font-weight-normal">{{ $subject->day }}</span>
                </div>
                <div class="col-md-4 text-center">
                  <span class="font-weight-normal">
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->schedulein)[0])->format('h:i A') }}
                    -
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->scheduleout)[0])->format('h:i A') }}
                  </span>
                </div>
                <div class="col-md-2">
                  <span class="font-weight-normal">{{ $subject->room }}</span>
                </div>
                <div class="col-md-3">
                  <span class="font-weight-normal">{{ $subject->instructor }}</span>
                </div>
              </div>
            @empty
              <span class="font-weight-normal">No subjects</span>
            @endforelse
          @endif
        </div>
        <div class="col-md-12 mt-5">
          <button class="btn btn-info" data-target="#editprof" data-toggle="modal">Edit Personal Information</button>
          <button class="btn btn-warning" data-target="#cpassword" data-toggle="modal">Change Password</button>

        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-3 mt-5 text-center">
          <img src="../img/edUni.png" class="logofooter" alt="" />
        </div>
        <div class="col-md-3 text-center mt-5">
          <h6 class="font-weight-bold">Other Services</h6>
          <p>EdiUni Library</p>
          <p>EdiUni Alumni</p>
        </div>
        <div class="col-md-3 text-center mt-5">
          <h6 class="font-weight-bold">EdUni Admin</h6>
          <p>✉ eu@edi.euni.ph | ediuni@edi.euni.ph</p>
          <p>☎ + 6381 2321 0867 | <br />Fax: + 1233 45 2</p>
        </div>
        <div class="sc col-md-3 text-center mt-5">
          <h6 class="font-weight-bold">Social Media</h6>
          <img src="..//img/fb.png" alt="" />
          <img src="..//img/ig.png" alt="" />
        </div>
        <div class="col-md-12 text-center mt-3 font-weight-bold">
          <p>Copyright © Educational University Philippines 2024</p>
        </div>
      </div>
    </div>
  </footer>

  @include('layout.edit-profile-modal')
@endsection
