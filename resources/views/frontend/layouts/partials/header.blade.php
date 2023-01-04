<div class="top-header">
    <div class="container">
      @if (Auth::check())
      <div class="dropdown float-right">
        <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i> {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
      @else
        <div class="dropdown float-right">
          <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i> Đăng nhập
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
            <a class="dropdown-item" href="{{route('register')}}">Đăng ký</a>
          </div>
        </div>
      @endif
      
      <div class="clearfix"></div>
    </div>
  </div>
<!------NAVBAR--------->
  <div class="main-navbar">
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand mr-5" href="{{route('home')}}">
        <img src="{{asset("images/logo.jpg")}}" class="logo-image">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Trang chủ <span class="sr-only">(current)</span></a>
          </li>
          
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sách</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="{{route('book.create')}}">Thêm sách mới</a>
            @if (Auth::check())
            <a class="dropdown-item" href="{{route('user.books')}}">Sách của tôi</a>
            @endif 
          </div>
        </li>
             
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{route('booksearch')}}" method="POST">
          @csrf
          <input class="form-control mr-sm-2 search-form" type="text" name='string_search' placeholder="Tìm kiếm" aria-label="Search" required>
          <button class="btn btn-secondary my-2 my-sm-0 search-button" type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
  </nav>
</div>
<!------END NAVBAR--------->
