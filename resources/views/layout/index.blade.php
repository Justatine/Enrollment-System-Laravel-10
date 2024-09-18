@extends('layout.layout')

@section('content')
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('img/img3.jpg') }}" alt="Third slide" />
        <div class="carousel-caption d-none d-md-block text-dark">
          <h1 class="apply">Apply Educational University</h1>
          @if (!auth()->check())
            <a href="{{ route('register') }}" class="btn btn-primary">Enroll-now!</a>
          @endif 
        </div>
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{ asset('img/img1.jpg') }}" alt="First slide" />
        <div class="carousel-caption d-none d-md-block text-dark">
          <h1 class="apply">Educational University Library</h1>
          <h4>More than 10M+ books you can read!</h4>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('img/img2.jpg') }}" alt="Second slide" />
        <div class="carousel-caption d-none d-md-block text-dark">
          <h1 class="apply">Educational University Plaza</h1>
          <h4>Break, Eat, Rest & Enjoy!</h4>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-5">
          <h4 class="mt-5">Educational University</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
            nihil esse excepturi corrupti ad quam doloremque porro
            perspiciatis quo beatae, sapiente, in suscipit quod, architecto
            eius adipisci at commodi totam. Lorem ipsum dolor sit, amet
            consectetur adipisicing elit. Animi voluptas eaque, officiis nam
            consectetur sint laboriosam obcaecati quam voluptatem numquam ad
            nemo praesentium tenetur architecto doloribus hic? Necessitatibus,
            quaerat magni!
          </p>
          @if (!auth()->check())
            <a href="{{ route('register') }}" class="btn btn-primary">Enroll-now!</a>
          @endif
        </div>
        <div class="col-md-6 text-center">
          <img src="img/edUni.png" alt="" />
        </div>
      </div>
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
