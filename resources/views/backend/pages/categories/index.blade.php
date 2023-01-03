@extends('backend.layouts.app')

@section('admin-content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Phân loại sách</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i>Thêm Loại sách</a>
  </div>

  @include('backend.layouts.partials.messages')

  <!-- Add category -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm loại sách</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <label for="">Loại sách</label>
                <br>
                <input type="text" class="form-control" name="name" placeholder="Tên thể loại">
              </div>
              <div class="col-12">
                <label for="">Mô tả thể loại</label>
                <br>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder= "Thể loại sách: hay...."></textarea>
              </div>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">Lưu</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
          </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách các thể loại sách</h6>
          </div>
          <div class="card-body">
            <table class="table" id="dataTable">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Loại sách</th>
                  <th>Tóm tắt</th>
                  <th>Thực thi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                      <a href="#editModal{{ $category->id }}" class="btn btn-success"  data-toggle="modal"><i class="fa fa-edit"></i> Sửa</a>
                      <a href="#deleteModal{{ $category->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i> Xoá</a>
                    </td>
                  </tr>
                  <!-------------EDIT------------>
                    <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">nhà xuất bản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form action="{{route('categories.update', ['category'=>$category->id])}}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="row">
                                <div class="col-12">
                                  <label for="">Thể loại sách</label>
                                  <br>
                                  <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                </div>
                                <div class="col-12">
                                  <label for="">Tóm tắt thể loại</label>
                                  <br>
                                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Tóm tắt thể loại">{!! $category->description !!}</textarea>
                                </div>
                              </div>
                  
                              <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  <!-------------- Delete--------------------->
                  <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận xoá</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div>
                              Bạn có muốn xoá {{ $category->name }} không !
                            </div>

                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Xoá</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                          </div>
                          </form>

                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>

@endsection