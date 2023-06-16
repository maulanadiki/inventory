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
</head>
<style>
    .bg-cards{
        background-color:#E8ECFC;
    }
    .jdl{
        text-decoration:none;
        
    }
    .buttons-copy{
    /* background-color:#0d6efd;
    padding:5px 30px;
    border-radius:10px;
    color:white; */
    display:none;
}
.buttons-csv{
    background-color:#198754;
    padding:5px 30px;
    border-radius:10px;
    color:white;
    border:1px solid #198754;
}
.buttons-csv:hover{
    background-color:white;
    color:black;
    border:1px solid #198754;
}
.buttons-excel{
    background-color:#198754;
    padding:5px 30px;
    border-radius:10px;
    color:white;
    border:1px solid #198754;
}
.buttons-excel:hover{
    background-color:white;
    color:black;
    border:1px solid #198754;
}
.buttons-pdf{
    background-color:#dc3545;
    padding:5px 30px;
    border-radius:10px;
    color:white;
    border:1px solid #dc3545;
}
.buttons-pdf:hover{
    background-color:white;
    color:black;
    border:1px solid #dc3545;
}
.buttons-print{
    background-color:#0d6efd;
    padding:5px 30px;
    border-radius:10px;
    color:white;
    border:1px solid #0d6efd;
}   
.buttons-print:hover{
    background-color:white;
    color:black;
    border:1px solid #0d6efd;
}   
    
</style>
<body style="background-color:#fcf8e8;">
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-2 d-block sidebarnya p-0" style="height:49rem; padding:0; overflow:auto;">
            @include('layout.sidebar')
        </div>

        <div class="col-md-10">
           <div class="row">
            <div class="col-md-12 shadow-sm sidebarnya text-end align-middle" style="height:4rem;">
            <div class="dropdown mt-3">
                <a class="dropdown-toggle text-light text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i> &nbsp; {{auth()->user()->name}}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url('/logout') }}">Logout</a></li>
                </ul>
            </div>
            
            <p class="text-light" > </p></div>
            <div class="col-md-12">
                @yield("konten")
            </div>

           </div>
        </div>
    </div>
    </div>

<!-- javascrip bootstraps -->
<!-- <script type="text/javascript" src="{{asset('/1plugin/bootstraps5.3/js/bootstrap.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('/1plugin/bootstraps5.3/js/bootstrap.bundle.min.js')}}"></script> -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="{{asset('/1plugin/bootstraps5.3/js/popper.min.js')}}"></script> -->



<!-- datatable -->
<script src="{{asset('/1plugin/DataTables /datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /datatables.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/buttons.html5.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /Buttons-2.3.4/js/buttons.print.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /JSZip-2.5.0/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /pdfmake-0.1.36/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/1plugin/DataTables /pdfmake-0.1.36/vfs_fonts.js')}}" type="text/javascript"></script>


<!-- https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js -->
</body>
</html>