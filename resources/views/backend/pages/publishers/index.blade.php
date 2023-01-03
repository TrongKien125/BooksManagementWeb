@extends('backend.layouts.app')

@section('admin-content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nhà xuất bản</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i>Thêm nhà xuất bản</a>
  </div>

  @include('backend.layouts.partials.messages')

  <!-- Add publisher -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm nhà xuất bản</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form action="{{route('publishers.store')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <label for="">Tên nhà xuất bản</label>
                <br>
                <input type="text" class="form-control" name="name" placeholder="Tên nhà xuất bản">
              </div>
              <div class="col-12">
                <label for="">Địa chỉ</label>
                <br>
                <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
              </div>
              <div class="col-6">
                <label for="">Trang chủ</label>
                <br>
                <input type="text" class="form-control" name="link" placeholder="Link">
              </div>
              <div class="col-6">
                <label for="">Outlet</label>
                <br>
                <input type="text" class="form-control" name="outlet" placeholder="Outlet">
              </div>
              <div class="col-12">
                <label for="">Thông tin nhà xuất bản</label>
                <br>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder= "Một vài thông tin về nhà xuất bản"></textarea>
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nhà xuất bản</h6>
          </div>
          <div class="card-body">
            <table class="table" id="dataTable">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên nhà xuất bản</th>
                  <th>Trang chủ</th>
                  <th>Địa chỉ</th>
                  <th>Outlet</th>
                  <th>Thông tin nhà xuất bản</th>
                  <th>Thực thi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($publishers as $publisher)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $publisher->name }}</td>
                    <td><a href="{{ $publisher->link }}">{{ $publisher->link }}</a></td>
                    <td>{{ $publisher->address }}</td>
                    <td>{{ $publisher->outlet }}</td>
                    <td>{{ $publisher->description }}</td>
                    <td>
                      <a href="#editModal{{ $publisher->id }}" class="btn btn-success"  data-toggle="modal"><i class="fa fa-edit"></i> Sửa</a>
                      <a href="#deleteModal{{ $publisher->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i> Xoá</a>
                    </td>
                  </tr>
                  <!-------------EDIT------------>
                    <div class="modal fade" id="editModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">nhà xuất bản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form action="{{route('publishers.update', ['publisher'=>$publisher->id])}}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="row">
                                <div class="col-12">
                                  <label for="">Tên nhà xuất bản</label>
                                  <br>
                                  <input type="text" class="form-control" name="name" value="{{$publisher->name}}">
                                </div>
                                <div class="col-12">
                                  <label for="">Địa chỉ</label>
                                  <br>
                                  <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="{{$publisher->address}}">
                                </div>
                                <div class="col-6">
                                  <label for="">Trang chủ</label>
                                  <br>
                                  <input type="text" class="form-control" name="link" placeholder="Link" value="{{$publisher->outlet}}">
                                </div>
                                <div class="col-6">
                                  <label for="">Outlet</label>
                                  <br>
                                  <input type="text" class="form-control" name="outlet" placeholder="Outlet" value="{{$publisher->outlet}}">
                                </div>
                                <div class="col-12">
                                  <label for="">Thông tin nhà xuất bản</label>
                                  <br>
                                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Thông tin về nhà xuất bản">{!! $publisher->description !!}</textarea>
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
                  <div class="modal fade" id="deleteModal{{ $publisher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận xoá</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('publishers.destroy', $publisher->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <div>
                              Bạn có muốn xoá {{ $publisher->name }} không !
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