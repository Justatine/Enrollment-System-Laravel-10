<!-- edit Student -->
<div class="modal fade" id="editsub{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('subjects.update', $subject->id) }}" method="post">
        @csrf
        @method('put')
        <div class="modal-body">
          <label for="subject">Subject:</label>
          <input type="text" class="form-control" name="subject" id="subject" value="{{ $subject->subject }}" />
          <label for="description">Description:</label>
          <textarea class="form-control" rows="5" name="description" id="description">{{ $subject->description }}</textarea>
          <label for="subject">Room:</label>
          <input type="text" class="form-control" name="room" id="room" value="{{ $subject->room }}" />
          <br>
          Day:
          <div class="row">
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="M"
                    {{ in_array('M', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Monday
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="T"
                    {{ in_array('T', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Tuesday
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="W"
                    {{ in_array('W', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Wednesday
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="TH"
                    {{ in_array('TH', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Thursday
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="F"
                    {{ in_array('F', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Friday
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input day-checkbox" name="days_id[]" value="S"
                    {{ in_array('S', explode(',', $subject->day)) ? 'checked' : '' }}>
                  Saturday
                </label>
              </div>
            </div>
          </div>
          <br>
          <label for="schedulein">Schedule In:</label>
          <input type="time" class="form-control" name="schedulein" id="schedulein"
            value="{{ $subject->schedulein }}" />
          <label for="scheduleout">Schedule Out:</label>
          <input type="time" class="form-control" name="scheduleout" id="scheduleout"
            value="{{ $subject->scheduleout }}" />
          <label for="instructor">Instructor:</label>
          <input type="text" class="form-control" name="instructor" id="instructor"
            value="{{ $subject->instructor }}" />
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
<!-- delete -->
<div class="modal fade" id="delete{{ $subject->id }}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Delete Subject
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Are you sure you want to delete this Subject?</h6>
      </div>
      <div class="modal-footer">
        <form action="{{ route('subjects.destroy', $subject->id) }}" method="post">
          @csrf
          @method('delete')
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
