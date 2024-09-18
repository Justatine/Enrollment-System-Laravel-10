<!-- editprof -->
<div class="modal fade" id="editprof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Personal Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.updatePersonalInfo', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <label for="image">Profile Picture</label>
          <input type="file" class="form-control" name="image" id="image" />
          <label for="firstname">Firstname:</label>
          <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $user->firstname }}" />
          <label for="middlename">Middle Name:</label>
          <input type="text" class="form-control" name="middlename" id="middlename"
            value="{{ $user->middlename }}" />
          <label for="lastname">Lastname:</label>
          <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $user->lastname }}" />
          <label for="nickname">Nickname:</label>
          <input type="text" class="form-control" name="nickname" id="nickname" value="{{ $user->nickname }}" />
          @if (auth()->user()->usertype === 'student')
            <label for="course">Course:</label>
            <input type="text" class="form-control" name="course" id="course" value="{{ $user->course }}" />
            <label for="year">Year:</label>
            <input type="text" class="form-control" name="year" id="year" value="{{ $user->year }}" />
          @endif
          <label for="birthdate">Birthdate:</label>
          <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ $user->birthdate }}" />
          <label for="gender">Gender:</label>
          <select class="custom-select" id="inputGroupSelect01" name="gender">
            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
          </select>
          <label for="contactnumber">Contact Number:</label>
          <input type="text" class="form-control" name="contactnumber" id="contactnumber"
            value="{{ $user->contactnumber }}" />
          <label for="email">Email Address:</label>
          <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-info">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="cpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.updatePassword', Auth::user()->id) }}" method="post">
        @csrf
        @method('put')
        <div class="modal-body">
          <label for="password">New Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-info">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
