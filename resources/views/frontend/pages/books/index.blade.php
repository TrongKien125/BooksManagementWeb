@extends('frontend.layouts.app')

@section('content')
    <!------Content--------->
<div class="main-content">
    <div class="advance-search">
      <div class="container">
        <h3>Tìm kiếm</h3>
        <form action="{{route('searchadvance')}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                  <label for="exampleInputEmail1">Tên sách/Nội dung</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='content' placeholder="Tên sách/Nội dung sách">
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" name='publisher_id'>
                  <label for="exampleInputEmail1">Nhà xuất bản</label>
                  <select class="form-control"> 
                    <option>Nhà xuất bản</option>
                    @foreach ($publishers as $publisher)
                    <option value="{{$publisher->id}}">{{$publisher->name}}</option>  
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" name='category_id'>
                  <label for="exampleInputEmail1">Thể loại</label>
                  <select class="form-control"> 
                    <option>Thể loại</option>
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
            <h3>Kết quả tìm kiếm: {{$search}}</h3>
  
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
                    <span class="page-link">Trước</span>
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
                    <a class="page-link" href="#">Tiếp theo</a>
                  </li>
                </ul>
              </nav>
            </div>
  
          </div> <!-- Book List -->
  
          <div class="col-md-3">
            <div class="widget">
              <h5 class="mb-2 border-bottom pb-3">
                Thể loại
              </h5>
              
              <div class="list-group mt-3">
                <a href="{{route('home')}}" class="list-group-item list-group-item-action">
                  Tất cả
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