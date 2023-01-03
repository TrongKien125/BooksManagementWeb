@extends('frontend.layouts.app')

@section('content')
<!------Content--------->
<div class="main-content">
  <div class="book-show-area">
    <div class="container">
      <div class="row">

        <div class="col-md-3">
          <img src="{{asset('images/books/'.$book->image)}}" class="img img-fluid" />
        </div>
        <div class="col-md-9">
          <h3>{{$book->title}}</h3>
          <p class="text-muted">Tác giả:  
            <span class="text-primary">
              @foreach ($authors as $author)
                  {{$author->author->name}}, 
              @endforeach
            </span>
          </p>
          <hr>
          <p><strong>Thể loại: </strong> {{$book->category->name}}</p>
          <p><strong>Nhà phát hành: </strong> {{$book->publisher->name}}</p>
          <div class="book-description">
            <label>Tóm tắt nội dung:</label>
            {!!$book->description!!}
          </div>
          <br>
          <div class="book-buttons mt-4">
              <a href="" class="btn btn-outline-success"><i class="fa fa-check"></i>  Đọc  </a>
              <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i>  Thích  </a>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
<!------END content--------->
@endsection