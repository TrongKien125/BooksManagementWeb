@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Sửa nội dung sách</h1>
    </div>
    
    @include('backend.layouts.partials.messages')
    
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('books.update', ['book'=>$book->id]) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="row">
                <div class="col-md-12">
                  <label for="">Tên sách</label>
                  <br>
                  <input type="text" class="form-control" name="title" placeholder="Tên sách" value="{{$book->title}}">
                </div>
                
                <div class="col-md-6">
                  <label for="">Thể loại sách</label>
                  <br>
                   <select name="category_id" id="category_id" class="form-control">
                    <option value="">Chọn thể loại</option>
                    @foreach ($categories as $category)
                      <option {{$category->id === $book->category_id ? "selected" : ""}} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div> 

                <div class="col-md-6">
                  <label for="">Tác giả</label>
                  <br>
                   <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
                    @foreach ($authors as $author)
                      <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                  </select>
                </div> 

                
                <div class="col-md-6">
                  <label for="">Nhà xuất bản</label>
                  <br>
                   <select name="publisher_id" id="publisher_id" class="form-control">
                    <option value="">Nhà xuất bản</option>
                    @foreach ($publishers as $publisher)
                      <option {{$publisher->id === $book->publisher_id ? "selected" : ""}} value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                  </select>
                </div> 
                
                <div class="col-md-6">
                  <label for="">Năm xuất bản</label>
                  <br>
                   <select name="public_year" id="public_year" class="form-control">
                    <option value="">Năm xuất bản</option>
                    @for ($year = date('Y'); $year >= 1900 ; $year--)
                      <option {{$year == $book->public_year ? "selected" : ""}} value="{{ $year }}">{{ $year }}</option>
                    @endfor
                  </select>
                </div> 

                <div class="col-md-6">
                    <label for="image" class="image">Hình ảnh</label>
                    <br>
                    <input name='image' type="file" class="form-control">
                </div>
                <div class="col-md-6"></div>
                
                <div class="col-12">
                  <label for="">Tóm tắt nội dung sách</label>
                  <br>
                  <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="Nội dung cuốn sách">{{$book->description}}</textarea>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
            </div>
            </form>
      </div>
    </div>

@endsection