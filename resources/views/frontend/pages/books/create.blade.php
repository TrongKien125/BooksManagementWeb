@extends('frontend.layouts.app')

@section('content')
<!------Content--------->
<div class="main-content">

  <div class="book-show-area">
    <div class="container">
      <h3>Thêm sách mới</h3>
      @if (Auth::check())
      @include('backend.layouts.partials.messages')
      <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <label for="">Tên sách</label>
            <br>
            <input type="text" class="form-control" name="title" placeholder="Tên sách">
          </div>
          
          <div class="col-md-6">
            <label for="">Thể loại sách</label>
            <br>
             <select name="category_id" id="category_id" class="form-control">
              <option value="">Chọn thể loại</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
              @endforeach
            </select>
          </div> 
          
          <div class="col-md-6">
            <label for="">Năm xuất bản</label>
            <br>
             <select name="public_year" id="public_year" class="form-control">
              <option value="">Năm xuất bản</option>
              @for ($year = date('Y'); $year >= 1900 ; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
              @endfor
            </select>
          </div> 

          <div class="col-md-6">
              <label for="image" class="image">Hình ảnh</label>
              <br>
              <input name='image' type="file" class="form-control" required>
          </div>
          <div class="col-md-6"></div>
          <div class="col-md-6">
            <label for="file" class="file">File sách</label>
            <br>
            <input name='file' type="file" class="form-control" required>
          </div>
          <div class="col-md-6"></div>
          
          <div class="col-12">
            <label for="">Tóm tắt nội dung sách</label>
            <br>
            <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="Nội dung cuốn sách"></textarea>
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
      </div>
      </form>

      @else
        <div class="card card-body">
          <p>
            <a href="{{ route('login') }}" class="btn btn-primary">
            Vui lòng đăng nhập để thêm sách mới
          </a>
          </p>
        </div>
      @endif
     
     
    </div>
  </div>

</div>
<!------END content--------->
@endsection