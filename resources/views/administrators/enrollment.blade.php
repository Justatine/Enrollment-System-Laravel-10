@extends('layout.layout')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 mt-5">
          <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h4>Enrollment Form</h4>
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
          </form>
        </div>

        <div class="col-md-9 mt-5">
          <h4>Enrollment Form List</h4>
          <table class="table bg-light">
            <thead>
              <tr>
                <th scope="col">Enrollee ID</th>
                <th scope="col">Image</th>
                <th scope="col">Fullname</th>
                <th scope="col">Course & Year</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Gender</th>
                <th scope="col">Email Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($enrollments as $enrollee)
                <tr>
                  <th scope="row">{{ $enrollee->user->id }}</th>
                  <td><img src="{{ $enrollee->user->image() }}" alt="" width="70" height="70"></td>
                  <td>
                    {{ $enrollee->user->firstname . ' ' . $enrollee->user->middlename . ' ' . $enrollee->user->lastname }}
                  </td>
                  <td>{{ $enrollee->user->course . ' - ' . $enrollee->user->year }}</td>
                  <td>{{ \Carbon\Carbon::parse($enrollee->user->birthdate)->format('F j, Y') }}</td>
                  <td>{{ $enrollee->user->gender }}</td>
                  <td>{{ $enrollee->user->email }}</td>
                  <td>
                    <button type="submit" class="btn btn-info statusBTN" data-target="#editstatus{{ $enrollee->id }}"
                      data-toggle="modal" data-status="{{ $enrollee->status }}" data-id="{{ $enrollee->id }}"
                      data-subject="{{ $enrollee->subject }}">{{ $enrollee->status }}</button>
                  </td>
                </tr>
                <div class="modal fade" id="editstatus{{ $enrollee->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Enrollment Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{ route('enrollments.update', $enrollee->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-3">
                              <label for="subject">Subject:</label>
                            </div>
                            <div class="col-md-1">
                              <label for="subject">Days:</label>
                            </div>
                            <div class="col-md-6 text-center">
                              <label for="subject">Schedule:</label>
                            </div>
                            <div class="col-md-2">
                              <label for="subject">Room:</label>
                            </div>
                          </div>
                          <div class="row">
                            @forelse ($subjects as $subject)
                              <div class="col-md-3">
                                <div class="form-check">
                                  <label class="form-check-label" for="{{ $subject->id }}">
                                    <input type="checkbox"
                                      class="form-check-input schedule-checkbox{{ $enrollee->id }}"
                                      id="{{ $subject->id }}" name="subjects_id[]" value="{{ $subject->id }}"
                                      {{ in_array($subject->id, $enrollee->user->subjects->pluck('id')->toArray()) ? 'checked' : '' }}
                                      data-schedule="{{ $subject->schedulein }} - {{ $subject->scheduleout }}">
                                    {{ $subject->subject }}
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-2">
                                {{ $subject->day }}
                              </div>
                              <div class="col-md-5 text-center">
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->schedulein)[0])->format('h:i A') }}
                                -
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->scheduleout)[0])->format('h:i A') }}
                              </div>
                              <div class="col-md-2">
                                {{ $subject->room }}
                              </div>
                            @empty
                              <div class="col-md-12">
                                No subjects
                              </div>
                            @endforelse
                          </div>
                          <div class="row mt-3">
                            <div class="col">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input selectall-checkbox{{ $enrollee->id }}">
                                  Select all subjects
                                </label>
                              </div>
                            </div>
                          </div>
                          <label for="status" class="mt-3">Status:</label>
                          <select class="custom-select status" id="inputGroupSelect01"
                            data-enrollee-id="{{ $enrollee->id }}" name="status">
                            <option value="pending" {{ $enrollee->status === 'pending' ? 'selected' : '' }}>
                              Pending
                            </option>
                            <option value="approved" {{ $enrollee->status === 'approved' ? 'selected' : '' }}>
                              Approved
                            </option>
                            <option value="denied" {{ $enrollee->status === 'denied' ? 'selected' : '' }}>
                              Denied
                            </option>
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @empty
                <tr>
                  <td colspan="8">No enrollees</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $enrollments->links() }}
        </div>
      </div>
    </div>
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
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('.statusBTN').click(function() {
        var id = $(this).data('id')

        $('.selectall-checkbox' + id).change(function() {
          var isChecked = $(this).prop('checked');

          $('.schedule-checkbox' + id).prop('checked', isChecked);
        });

        $('.schedule-checkbox' + id).change(function() {
          var allChecked = $('.schedule-checkbox' + id + ':checked').length === $('.schedule-checkbox' + id).length;
          $('.selectall-checkbox' + id).prop('checked', allChecked);
        });
      })
    });
  </script>
@endsection
