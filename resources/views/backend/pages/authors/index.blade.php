@extends('backend.layouts.app')

@section('admin-content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Quản lý tác giả</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i>Thêm tác giả</a>
  </div>

  @include('backend.layouts.partials.messages')

  <!-- Add Author -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm tác giả</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form action="{{route('authors.store')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <label for="">Tên tác giả</label>
                <br>
                <input type="text" class="form-control" name="name" placeholder="Tên tác giả">
              </div>
              <div class="col-12">
                <label for="">Thông tin tác giả</label>
                <br>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder= "Một vài thông tin về tác giả"></textarea>
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tác giả</h6>
          </div>
          <div class="card-body">
            <table class="table" id="dataTable">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên tác giả</th>
                  <th>Link</th>
                  <th>Thông tin tác giả</th>
                  <th>Thực thi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($authors as $author)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->link }}</td>
                    <td>{{ $author->description }}</td>
                    <td>
                      <a href="#editModal{{ $author->id }}" class="btn btn-success"  data-toggle="modal"><i class="fa fa-edit"></i>Sửa</a>
                      <a href="#deleteModal{{ $author->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i>Xoá</a>
                    </td>
                  </tr>
                  <!-------------EDIT------------>
                    <div class="modal fade" id="editModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tác giả</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form action="{{route('authors.update', ['author'=>$author->id])}}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="row">
                                <div class="col-12">
                                  <label for="">Tên tác giả</label>
                                  <br>
                                  <input type="text" class="form-control" name="name" value="{{$author->name}}">
                                </div>
                                <div class="col-12">
                                  <label for="">Thông tin tác giả</label>
                                  <br>
                                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Thông tin về tác giả">{!! $author->description !!}</textarea>
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
                  <div class="modal fade" id="deleteModal{{ $author->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận xoá</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('authors.destroy', $author->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div>
                              Bạn có muốn xoá {{ $author->name }} không !
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