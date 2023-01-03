@extends('frontend.layouts.app')

@section('content')
    <!------Content--------->
<div class="main-content">

    <div class="book-list-sidebar">
      <div class="container">
        <div class="row">
  
          <div class="col-md-9">
            <h3>Tủ sách của tôi</h3>
            @include('backend.layouts.partials.messages')
            <div class="row">
              @foreach ($books as $book)
                <div class="col-md-4">
                  <div class="single-book">
                    <img src="{{asset('images/books/'.$book->image)}}" alt="">
                    <div class="book-short-info">
                      <h5>{{$book->title}}</h5>
                      {{-- <p>
                        <a href="" class=""><i class="fa fa-upload"></i> Polash Rana</a>
                      </p> --}}
                      <a href="{{route('book.show',$book->id)}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Xem</a>
                      <a href="{{route('user.book.edit',$book->id)}}" class="btn btn-outline-success"><i class="fa fa-edit"></i> Sửa</a>
                      <a href="#deleteModal{{ $book->id }}" class="btn btn-outline-danger" data-toggle="modal"><i class="fa fa-trash"></i>Xoá</a>
                         
                    </div>
                  </div>
                </div> 
                 <!-- Delete Modal -->
                 <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xoá sách</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <form action="{{route('user.book.delete',$book->id)}}" method="post">
                          @csrf
                          <div>
                            Sách {{ $book->name }} sẽ được xoá. 
                          </div>

                          <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Xoá</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        </div>
                        </form>

                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- Delete Modal -->
              @endforeach
          </div>
          </div> <!-- Book List -->
  
          <div class="col-md-3">
            <div class="widget">
              <h5 class="mb-2 border-bottom pb-3">
                Thể loại
              </h5>
              
              <div class="list-group mt-3">
                <a href="{{route('user.books')}}" class="list-group-item list-group-item-action">
                  Tất cả
                </a>
                @foreach ($categories as $category)
                  <a href="{{route('user.books.category', $category->id)}}" class="list-group-item list-group-item-action">
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