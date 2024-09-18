@extends('layout.layout')

@section('content')
  <div class="content">
    <div class="container">
      <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12 mt-5">
            <h4>Enrollment Form</h4>
          </div>
          <div class="col-md-6">
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
          </div>
          <div class="col-md-6 mb-5">
            <label for="year">Year:</label>
            <select type="text" class="form-control" name="year" id="year">
              <option value="1">1st year</option>
              <option value="2">2nd year</option>
              <option value="3">3rd year</option>
              <option value="4">4th year</option>
            </select>
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
            <h6 class="mt-4">
              After you send your enrollment form, wait for the school to accept
              your enrollment!
            </h6>
            <button type="submit" class="btn btn-primary form-control mt-3">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-3 mt-5 text-center">
            <img src="img/edUni.png" class="logofooter" alt="" />
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
            <img src="/img/fb.png" alt="" />
            <img src="/img/ig.png" alt="" />
          </div>
          <div class="col-md-12 text-center mt-3 font-weight-bold">
            <p>Copyright © Educational University Philippines 2024</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
@endsection
