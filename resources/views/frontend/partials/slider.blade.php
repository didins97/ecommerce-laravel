<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        @foreach ($banners as $banner)

        @if ($loop->first)
        <div class="carousel-item active">
          <div class="img-slider">
              <img class="bd-placeholder-img" src="{{ asset('storage/images/slide/'.$banner->image) }}" alt="" width="100%"
                  height="100%">
          </div>

          <div class="container">
              <div class="carousel-caption text-start">
                  <h1>{{$banner->title}}</h1>
                  <p>{{$banner->description}}</p>
                  <p><a class="btn btn-lg" href="#">Sign up today</a></p>
              </div>
          </div>
      </div>
        @else
        <div class="carousel-item">
          <div class="img-slider">
              <img class="bd-placeholder-img" src="{{ asset('storage/images/slide/'.$banner->image) }}" alt="" width="100%"
                  height="100%">
          </div>

          <div class="container">
              <div class="carousel-caption text-start">
                  <h1>{{$banner->title}}</h1>
                  <p>{{$banner->description}}</p>
                  <p><a class="btn btn-lg" href="#">Sign up today</a></p>
              </div>
          </div>
      </div>
        @endif

        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
