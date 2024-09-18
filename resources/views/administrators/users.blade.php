@extends('layout.layout')

@section('content')
  <div class="content">
    <section class="container">
      <div class="row">
        <div class="col mt-5">
          <h4>
            @if ($usertype === 'student')
              Student
            @else
              Incharge
            @endif
            List
          </h4>
        </div>
        <div class="col mt-5 text-right">
          <button class="btn btn-primary" data-target="#addstud" data-toggle="modal">
            Add New
            @if ($usertype === 'student')
              Student
            @else
              Incharge
            @endif
          </button>
        </div>
        <div class="col-md-12 mt-3">
          <table class="table bg-light">
            <thead>
              <tr>
                <th scope="col">ID number</th>
                <th scope="col">Profile</th>
                <th scope="col">Fullname</th>
                <th scope="col">Nickname</th>
                @if ($usertype === 'student')
                  <th scope="col">Course & Year</th>
                @endif
                <th scope="col">Birthdate</th>
                <th scope="col">Gender</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Email Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <th scope="row">{{ $user->id }}</th>
                  <td><img src="{{ $user->image() }}" alt="" width="70" height="70"></td>
                  <td>
                    {{ $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname }}
                  </td>
                  <td>{{ $user->nickname }}</td>
                  @if ($usertype === 'student')
                    <td>{{ $user->course . ' - ' . $user->year }}</td>
                  @endif
                  <td>{{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}</td>
                  <td>{{ $user->gender }}</td>
                  <td>{{ $user->contactnumber }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <button class="btn btn-warning" data-target="#editstud{{ $user->id }}" data-toggle="modal">
                      Edit
                    </button>
                    <button class="btn btn-danger" data-target="#delete{{ $user->id }}" data-toggle="modal">
                      Delete
                    </button>
                  </td>
                </tr>
                @include('layout.user-crud')
              @empty
                <tr>
                  <td colspan="10" class="text-center">No students</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $users->links() }}
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
            <img src="../img/fb.png" alt="" />
            <img src="../img/ig.png" alt="" />
          </div>
          <div class="col-md-12 text-center mt-3 font-weight-bold">
            <p>Copyright © Educational University Philippines 2024</p>
          </div>
        </div>
      </div>
    </footer>
  </div>


  <!-- Add Student -->
  <div class="modal fade" id="addstud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="usertype" value="{{ $usertype }}">
            <label for="image">Profile Picture</label>
            <input type="file" class="form-control" name="image" id="image" />
            <label for="firstname">Firstname:</label>
            <input type="text" class="form-control" name="firstname" id="firstname" />
            <label for="middlename">Middle Name:</label>
            <input type="text" class="form-control" name="middlename" id="middlename" />
            <label for="lastname">Lastname:</label>
            <input type="text" class="form-control" name="lastname" id="lastname" />
            <label for="nickname">Nickname:</label>
            <input type="text" class="form-control" name="nickname" id="nickname" />
            @if ($usertype === 'student')
              <label for="course">Course:</label>
              <select class="form-control" name="course" id="course">
                <option value="BSIT">BS in Information Technology</option>
                <option value="BSCS">BS in Computer Science</option>
                <option value="BLIS">Bachelor of Library and Information Science</option>
                <option value="BSCE">BS Civil Engineering</option>
                <option value="BSME">BS Mechanical Engineering</option>
                <option value="BSEE">BS Electrical Engineering</option>
                <option value="BSMT">BS Medical Technology</option>
                <option value="BSRT">BS Radiologic Technology</option>
                <option value="BSN">BS Nursing</option>
                <option value="BSM">BS Midwifery</option>
                <option value="BSA">BS Accountancy</option>
                <option value="BSMA">BS Management Accounting</option>
              </select>
              <label for="year">Year:</label>
              <select type="text" class="form-control" name="year" id="year">
                <option value="1">1st year</option>
                <option value="2">2nd year</option>
                <option value="3">3rd year</option>
                <option value="4">4th year</option>
              </select>
            @endif
            <label for="birthdate">Birthdate:</label>
            <input type="date" class="form-control" name="birthdate" id="birthdate" />
            <label for="gender">Gender:</label>
            <select class="custom-select" id="inputGroupSelect01" name="gender" id="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <label for="contactnumber">Contact Number:</label>
            <input type="text" class="form-control" name="contactnumber" id="contactnumber" />
            <label for="email">Email Address:</label>
            <input type="email" class="form-control" name="email" id="email" />
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
