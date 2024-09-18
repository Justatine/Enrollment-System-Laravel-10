@extends('layout.layout')

@section('content')
  <div class="content">
    <section class="container">
      <div class="row">
        <div class="col mt-5">
        </div>
        <div class="col mt-5 text-right">
          <button class="btn btn-primary" data-target="#addsub" data-toggle="modal">
            Add Subject
          </button>
        </div>
        <div class="col-md-12 mt-3">
          <table class="table bg-light">
            <thead>
              <tr>
                <th scope="col">Subject ID</th>
                <th scope="col">Subject</th>
                <th scope="col">Description</th>
                <th scope="col">Room</th>
                <th scope="col">Day</th>
                <th scope="col">Schedule</th>
                <th scope="col">Instructor</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($subjects as $subject)
                <tr>
                  <th scope="row">{{ $subject->id }}</th>
                  <td>{{ $subject->subject }}</td>
                  <td>{{ $subject->description }}</td>
                  <td>{{ $subject->room }}</td>
                  <td>
                    {{ $subject->day }}
                  </td>
                  <td>
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->schedulein)[0])->format('h:i A') }}
                    -
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', explode(' - ', $subject->scheduleout)[0])->format('h:i A') }}
                  </td>
                  <td>{{ $subject->instructor }}</td>
                  <td>
                    <button class="btn btn-warning" data-target="#editsub{{ $subject->id }}" data-toggle="modal">
                      Edit
                    </button>
                    <button class="btn btn-danger" data-target="#delete{{ $subject->id }}" data-toggle="modal">
                      Delete
                    </button>
                  </td>
                </tr>
                @include('layout.subject-crud')
              @empty
                <tr>
                  <td colspan="10" class="text-center">No students</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $subjects->links() }}
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


  <!-- Add Subject -->
  <div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('subjects.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" name="subject" id="subject" />
            <label for="description">Description:</label>
            <textarea type="text" class="form-control" rows="5" name="description" id="description"></textarea>
            <label for="subject">Room:</label>
            <input type="text" class="form-control" name="room" id="room" />
            <br>
            Day:
            <div class="row">
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="M">
                    Monday
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="T">
                    Tuesday
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="W">
                    Wednesday
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="TH">
                    Thursday
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="F">
                    Friday
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="S">
                    Saturday
                  </label>
                </div>
              </div>
            </div>
            <br>
            <label for="schedulein">Schedule In:</label>
            <input type="time" class="form-control" name="schedulein" id="schedulein" />
            <label for="scheduleout">Schedule Out:</label>
            <input type="time" class="form-control" name="scheduleout" id="scheduleout" />
            <label for="instructor">Instructor:</label>
            <input type="text" class="form-control" name="instructor" id="instructor" />
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
