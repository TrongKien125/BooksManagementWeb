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
          <p> <i class="fa fa-eye" > Luợt xem: {{ $book->total_view }}</i> </p>
          <b> <i class="fa fa-heart"> Lượt thích: {{ $book->total_like }}</i></p>
          <div class="book-description">
            <label>Tóm tắt nội dung:</label>
            {!!$book->description!!}
          </div>
          <br>
          <div class="book-buttons mt-4">
              <a href="{{route('readbook', $book->id)}}" class="btn btn-outline-success"><i class="fa fa-check"></i>  Đọc  </a>
              <a href="{{route('likebook', $book->id)}}" class="btn btn-outline-danger"><i class="fa fa-heart"></i>  Thích  </a>
          </div>
        </div>
        {{-- <iframe src="{{asset('images/books/In phiếu dự thi TOEIC.pdf')}}" frameborder="0" width="100%" height="600px"></iframe> --}}

      </div>
    </div>
  </div>

</div>
<!------END content--------->
@endsection