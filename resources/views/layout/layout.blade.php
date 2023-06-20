<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- bootstraps -->
    <link href="{{asset('/1plugin/bootstraps5.3/css/bootstrap.min.css') }}" rel="stylesheet" text="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/sendiri/style.css') }}">
    <!-- datatable -->
    <link rel="stylesheet" href="{{asset('/1plugin/DataTables /datatables.css') }}">
    <link rel="stylesheet" href="{{asset('/1plugin/DataTables /datatables.min.css') }}">

    <link rel="stylesheet" href="{{asset('/1plugin/DataTables /Buttons-2.3.4/css/buttons.bootstrap5.min.css') }}">
    <!-- summornote -->
    <link rel="stylesheet" href="{{asset('/1plugin/summernote/summernote-bs4.min.css') }}">
    <!-- <script src="{{asset('/1plugin/summernote/summernote-bs4.min.js') }}" type="text/javascript" ></script> -->

    <script src="https://use.fontawesome.com/1d579dc938.js"></script>

    <!-- jquery -->
    <script src="{{asset('/1plugin/jquery-3.6.3.min.js')}}" type="text/javascript"></script>
    <!-- versi 4nya -->
    <link rel="stylesheet" href="{{asset('/fontawesome-free/css/all.css') }}">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- sampe sini boostrap -->
    <style>
    body {
        background-color: #f2f2f2;
    }

    .bg-cards {
        background-color: #E8ECFC;
    }

    .jdl {
        text-decoration: none;

    }

    .buttons-copy {
        /* background-color:#0d6efd;
    padding:5px 30px;
    border-radius:10px;
    color:white; */
        display: none;
    }

    .buttons-csv {
        background-color: #198754;
        padding: 5px 30px;
        border-radius: 10px;
        color: white;
        border: 1px solid #198754;
    }

    .buttons-csv:hover {
        background-color: white;
        color: black;
        border: 1px solid #198754;
    }

    .buttons-excel {
        background-color: #198754;
        padding: 5px 30px;
        border-radius: 10px;
        color: white;
        border: 1px solid #198754;
    }

    .buttons-excel:hover {
        background-color: white;
        color: black;
        border: 1px solid #198754;
    }

    .buttons-pdf {
        background-color: #dc3545;
        padding: 5px 30px;
        border-radius: 10px;
        color: white;
        border: 1px solid #dc3545;
    }

    .buttons-pdf:hover {
        background-color: white;
        color: black;
        border: 1px solid #dc3545;
    }

    .buttons-print {
        background-color: #0d6efd;
        padding: 5px 30px;
        border-radius: 10px;
        color: white;
        border: 1px solid #0d6efd;
    }

    .buttons-print:hover {
        background-color: white;
        color: black;
        border: 1px solid #0d6efd;
    }

    .dropdown>a>span.start-100 {
        left: 140% !important;
    }

    .dropdown>a>ul>li {
        border-bottom: 2px solid red;
    }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="container-fluid aplication-container">
        <div class="sidebar-container">
            @include('layout.sidebar')
        </div>

        <div class="content-container">
            <div class="header-container">
                <div class="row">
                @if(auth()->user()->level == 1  || auth()->user()->level == 2)
                    <div class="col-md-3">
                        <div class="dropdown">
                            <a class="text-dark text-decoration-none position-relative" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill fs-5"></i>
                                @php
                                $taskTodo = session('task_todo');
                                $taskPembelian= session('task_beli');
                                $taskTerima= session('task_terima');
                                $taskPenjualan= session('task_jual');
                                @endphp
                                @if( @$taskTodo > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    @if($taskTodo>98)
                                    +99
                                    @else
                                    {{$taskTodo}}
                                    @endif
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @else
                                
                                @endif
                            </a>
                            <ul class="dropdown-menu" style="min-width:13rem; padding:0;">
                                <li class="d-flex flex-row justify-content-between"
                                    style="border-bottom:2px solid #aeaeb0; padding:0px 0.5rem; margin:0.5rem 0px;">
                                    <p>Pembelian</p>
                                    @if($taskPembelian >0)
                                    <p class="badge rounded-pill text-bg-danger">{{$taskPembelian}}</p>
                                    @else
                                    <p class="badge rounded-pill text-bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                            <path
                                                d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                        </svg>
                                    </p>
                                    @endif
                                </li>
                                <li class="d-flex flex-row justify-content-between"
                                    style="border-bottom:2px solid #aeaeb0; padding:0px 0.5rem; margin:1rem 0px;">
                                    <p>Terima Barang</p>
                                    @if($taskTerima > 0)
                                    <p class="badge rounded-pill text-bg-danger">{{$taskTerima}}</p>
                                    @else
                                    <p class="badge rounded-pill text-bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                            <path
                                                d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                        </svg>
                                    </p>
                                    @endif
                                </li>
                                <li class="d-flex flex-row justify-content-between" style="padding: 0 0.5rem;">
                                    <p>Barang Keluar</p>
                                    @if($taskPenjualan)
                                    <p class="badge rounded-pill text-bg-danger">{{$taskPenjualan}}</p>
                                    @else
                                    <p class="badge rounded-pill text-bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                            <path
                                                d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                        </svg>
                                    </p>
                                    @endif
                                </li>
                                <li class="p-2 text-center task__detail"><a href="{{url('/task_todo')}}"
                                        class="text-decoration-none text-light">Lihat selengkapnya</a></li>
                            </ul>
                        </div>
                    </div>
                @elseif(auth()->user()->level == 3 )
                    <div class="col-md-3">
                        <div class="dropdown">
                            <a class="text-dark text-decoration-none position-relative" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill fs-5"></i>
                                @php
                                $taskTodo = session('task_todo');
                                $taskPembelian= session('task_beli');
                                $taskTerima= session('task_terima');
                                $taskPenjualan= session('task_jual');
                                @endphp
                                @if( @$taskTodo > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    @if($taskTerima>98)
                                    +99
                                    @else
                                    {{$taskTerima}}
                                    @endif
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @else
                                @endif
                            </a>
                            <ul class="dropdown-menu" style="min-width:13rem; padding:0;">
                                
                                <li class="d-flex flex-row justify-content-between"
                                    style="border-bottom:2px solid #aeaeb0; padding:0px 0.5rem; margin:1rem 0px;">
                                    <p>Terima Barang</p>
                                    @if($taskTerima > 0)
                                    <p class="badge rounded-pill text-bg-danger">{{$taskTerima}}</p>
                                    @else
                                    <p class="badge rounded-pill text-bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                            <path
                                                d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                        </svg>
                                    </p>
                                    @endif
                                </li>
                                <li class="p-2 text-center task__detail"><a href="{{url('/task_todo')}}"
                                        class="text-decoration-none text-light">Lihat selengkapnya</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-dark text-decoration-none" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> &nbsp; {{auth()->user()->name}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassword"><i class="bi bi-gear-fill"></i>&nbsp; &nbsp;Ganti Password</a></li>
                                <li><a class="dropdown-item" href="{{url('/logout') }}"><i class="bi bi-box-arrow-left"></i> &nbsp; Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-content">
                @yield("konten")
            </div>
        </div>
    </div>


<!-- modalnya -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePassword" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('changepw') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password" required name="password">
                <input type="hidden" name="email" value="{{auth() ->user()->email}}" >
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="showpw" onclick="tampilpassword()">
                <label class="form-check-label" for="flexCheckDefault">
                   Tampilkan password
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
            </svg>    
            Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function tampilpassword (){
    const showpw = document.getElementById("showpw");
    const pw = document.getElementById("password");

    if(showpw.checked){
        pw.type="text";
    }else{
        pw.type="password";
    }}
</script>



    <!-- sampe sini -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <!-- datatable -->
    <script src="{{asset('/1plugin/DataTables /datatables.js')}}" type="text/javascript"></script>
    <script src="{{asset('/1plugin/DataTables /datatables.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/dataTables.buttons.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/buttons.html5.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/buttons.print.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('/1plugin/DataTables /JSZip-2.5.0/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/1plugin/DataTables /pdfmake-0.1.36/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/1plugin/DataTables /pdfmake-0.1.36/vfs_fonts.js')}}" type="text/javascript"></script>
</body>

</html>