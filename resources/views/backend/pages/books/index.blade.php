@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Quản lý sách</h1>

      <a href="{{ route('books.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50" ></i> Thêm sách</a>
    </div>
    
    @include('backend.layouts.partials.messages')

    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh sach sách</h6>
            </div>
            <div class="card-body">
              
              <table class="table" id="dataTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sách</th>
                    <th>Link</th>
                    <th>Thể loại</th>
                    <th>Nhà phát hành</th>
                    <th>Thống kê</th>
                    <th>Trạng thái</th>
                    <th>Thực thi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($books as $book)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                      <a href="{{ route('books.show', $book->slug) }}" target="_blank">{{ route('books.show', $book->slug) }}
                      </a>
                      </td>
                    <td>
                      {{ $book->category->name }}
                    </td>
                    <td>
                      {{ $book->publisher->name }}
                    </td>
                    <td>
                     <i class="fa fa-eye"></i> {{ $book->total_view }}
                     <br>
                     <i class="fa fa-search"></i> {{ $book->total_search }}
                    </td>
                    <td>
                      @if ($book->status)
                        <span class="badge badge-success">
                          <i class="fa fa-check"></i> Hoạt động
                        </span>
                        @else
                        <span class="badge badge-danger">
                          <i class="fa fa-times"></i> Không hoạt động
                        </span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('books.edit',['book'=>$book->id]) }}" class="btn btn-success" ><i class="fa fa-edit"></i></a>
                      <a href="#deleteModal{{ $book->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>


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
                          
                          <form action="{{ route('books.destroy',$book->id) }}" method="post">
                            @csrf
                            @method('delete')
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

                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

@endsection