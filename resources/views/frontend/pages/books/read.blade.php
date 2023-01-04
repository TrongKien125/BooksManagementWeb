@extends('frontend.layouts.app')

@section('content')
<!------Content--------->
<div class="main-content">
  <div class="book-show-area">
    <div class="container">
      <h3>{{$book->title}}</h3>
      <div class="row">
        <iframe src="{{asset('file_upload/'.$book->file)}}" frameborder="0" width="100%" height="600px"></iframe>

      </div>
    </div>
  </div>

</div>
<!------END content--------->
@endsection