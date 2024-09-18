@if (!auth()->check())
  <nav class="navbar navbar-expand-lg navbar-light">
    <img src="{{ asset('img/edUni.png') }}" alt="" />
    <a class="navbar-brand font-weight-bold" href="#">Ed<span>Uni</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="#" data-target="#login" data-toggle="modal">Login</a>
      </div>
    </div>
  </nav>

  <!-- login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('authenticate') }}" method="post">
          @csrf
          <div class="modal-body">
            <label for="id">ID no:</label>
            <input type="text" class="form-control" name="id" id="id">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@else
  <!-- logout -->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to logout?</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <form action="{{ route('logout') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @if (auth()->user()->usertype === 'student')
    <nav class="navbar navbar-expand-lg navbar-light">
      <img src="../img/edUni.png" alt="" />
      <a class="navbar-brand font-weight-bold" href="#">Ed<span>Uni</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
            href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link {{ request()->routeIs('users.show') ? 'active' : '' }}"
            href="{{ route('users.show', Auth::user()->id) }}">Profile</a>

          <a class="nav-item nav-link" href="#" data-target="#logout" data-toggle="modal">Logout</a>
        </div>
      </div>
    </nav>
  @elseif (auth()->user()->usertype === 'incharge')
    <nav class="navbar navbar-expand-lg navbar-light">
      <img src="../img/edUni.png" alt="" />
      <a class="navbar-brand font-weight-bold" href="#">Ed<span>Uni</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
            href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link {{ request()->routeIs('enrollments.index') ? 'active' : '' }}"
            href="{{ route('enrollments.index') }}">Enrollment Form</a>
          <a class="nav-item nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
            href="{{ route('users.index') }}">Students</a>
            <a class="nav-item nav-link {{ request()->routeIs('subjects.index') ? 'active' : '' }}"
              href="{{ route('subjects.index') }}">Subject</a>
          <a class="nav-item nav-link {{ request()->routeIs('users.show') ? 'active' : '' }}"
            href="{{ route('users.show', Auth::user()->id) }}">Profile</a>
          <a class="nav-item nav-link" href="#" data-target="#logout" data-toggle="modal">Logout</a>
        </div>
      </div>
    </nav>
  @elseif (auth()->user()->usertype === 'admin')
    <nav class="navbar navbar-expand-lg navbar-light">
      <img src="../img/edUni.png" alt="" />
      <a class="navbar-brand font-weight-bold" href="#">Ed<span>Uni</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
            href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link {{ request()->routeIs('enrollments.index') ? 'active' : '' }}"
            href="{{ route('enrollments.index') }}">Enrollment Form</a>
          <a class="nav-item nav-link {{ request()->routeIs('users.index', ['usertype' => 'student']) ? 'active' : '' }}"
            href="{{ route('users.index') }}">Students</a>
          <a class="nav-item nav-link {{ request()->routeIs('users.index', ['usertype' => 'incharge']) ? 'active' : '' }}"
            href="{{ route('users.index', ['usertype' => 'incharge']) }}">Incharge</a>
          <a class="nav-item nav-link {{ request()->routeIs('subjects.index') ? 'active' : '' }}"
            href="{{ route('subjects.index') }}">Subject</a>
          <a class="nav-item nav-link {{ request()->routeIs('users.show') ? 'active' : '' }}"
            href="{{ route('users.show', Auth::user()->id) }}">Profile</a>
          <a class="nav-item nav-link" href="#" data-target="#logout" data-toggle="modal">Logout</a>
        </div>
      </div>
    </nav>
  @endif
@endif
