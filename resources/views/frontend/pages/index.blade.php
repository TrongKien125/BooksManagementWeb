@extends('frontend.layouts.app')

@section('content')
    <!------Content--------->
<div class="main-content">
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide main-slider" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('images/sliders/slider1.png')}}" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <h3>Welcome to your Book </h3>
            <p>
              <a href="register.html" class="btn btn-primary slider-link">
                New Account
              </a>
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{asset('images/sliders/slider2.png')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3>Welcome to your Book</h3>
            <p>
              <a href="" class="btn btn-primary slider-link">
                New Account
              </a>
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{asset('images/sliders/slider3.png')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3>Welcome to your Book </h3>
            <p>
              <a href="" class="btn btn-primary slider-link">
                New Account
              </a>
            </p>
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
    <!-- Carousel -->
  
    <div class="advance-search">
      <div class="container">
        <h3>T??m ki???m</h3>
        <form action="{{route('searchadvance')}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                  <label for="exampleInputEmail1">T??n s??ch/N???i dung</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='content' placeholder="T??n s??ch/N???i dung s??ch">
                </div>
            </div>

            <div class="col-md-3">
              <div class="form-group" name='publisher_id'>
                  <label for="exampleInputEmail1">Nh?? xu???t b???n</label>
                  <select class="form-control"> 
                    <option>Nh?? xu???t b???n</option>
                    @foreach ($publishers as $publisher)
                    <option value="{{$publisher->id}}">{{$publisher->name}}</option>  
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" name='category_id'>
                  <label for="exampleInputEmail1">Th??? lo???i</label>
                  <select class="form-control"> 
                    <option>Th??? lo???i</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>  
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-1">
                 <button type="submit" class="btn btn-success btn-lg" name="">
                  <i class="fa fa-search"></i>
                 </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  
    <div class="book-list-sidebar">
      <div class="container">
        <div class="row">
  
          <div class="col-md-9">
            <h3>G???n ????y</h3>
  
            <div class="row">
              @foreach ($books as $book)
              <div class="col-md-4">
                <div class="single-book">
                  <img src="{{asset('images/books/'.$book->image)}}" alt="">
                  <div class="book-short-info">
                    <h5>{{$book->title}}</h5>
                    
                    <p><i class="fa fa-eye" >  {{ $book->total_view }}</i>  <i class="fa fa-heart">  {{ $book->total_like }}</i> </p>
                    <a href="{{route('book.show',$book->id)}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View</a>
                  </div>
                </div>
              </div> <!-- Single Book Item -->
              @endforeach
              
             
  
  
            </div>
  
            <div class="books-pagination mt-5">
              <nav aria-label="...">
                <ul class="pagination">
                  <li class="page-item disabled">
                    <span class="page-link">Tr?????c</span>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active" aria-current="page">
                    <span class="page-link">
                      2
                      <span class="sr-only">(current)</span>
                    </span>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Ti???p theo</a>
                  </li>
                </ul>
              </nav>
            </div>
  
          </div> <!-- Book List -->
  
          <div class="col-md-3">
            <div class="widget">
              <h5 class="mb-2 border-bottom pb-3">
                Th??? lo???i
              </h5>
              
              <div class="list-group mt-3">
                <a href="{{route('home')}}" class="list-group-item list-group-item-action">
                  T???t c???
                </a>
                @foreach ($categories as $category)
                  <a href="{{route('categorybooks', $category->id)}}" class="list-group-item list-group-item-action">
                    {{$category->name}}
                  </a>
                @endforeach
                
              </div>
  
            </div> <!-- Single Widget -->
  
          </div> <!-- Sidebar -->
  
        </div>
      </div>
    </div>
  
  </div>
  <!------END content--------->
@endsection