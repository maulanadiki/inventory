<div class="sidebar-logo text-center justify-content-center">
    <img src="{{ asset('defa/logo.png') }}" width="100" class>
    <div class="sidebar-logo__wording">
        <p class="text-justify" style="color:#fc8c3a;">DEFA</p><span class="text-light"> Shoes</span>
    </div>
</div>

<nav>
<ul class="nav flex-column nav-pills list-group list-group-flush mt-4">
                <!-- dashboard -->
                <li class="nav-item kotak">
                    <a class="nav-link text-light mb-2 {{Request::is('home') ? 'active' : '' }}" style="cursor:pointer;" href="{{url('home') }}" id="dashboard"><i class="bi bi-speedometer2"></i>&nbsp; &nbsp;  Dashboard</a>
                </li>
                <!-- Pembelian Barang -->
                @if(auth()->user()->level == 3 || auth()->user()->level == 1  || auth()->user()->level == 2)
                <li class="nav-item kotak text-light mt-2">
                    <a class="nav-link mb-2 text-light " type="button" data-bs-toggle="collapse" data-bs-target="#belibarang" aria-expanded="{{Request::is('/pembelian') ? 'true' : '' }}">


                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="20" height="20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>&nbsp; &nbsp;  Pembelian Barang</a>
                    <ul class="collapse {{Request::is('pembelian','pembelian/BuatPembelian','penerimaan') ? 'show' : '' }}" id="belibarang">
                        <li>
                            <a class="nav-link text-light mt-1 mb-1 {{Request::is('pembelian','pembelian/BuatPembelian') ? 'active' : '' }}" style="list-style:none;" href="{{url('/pembelian') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; &nbsp; PO Barang</a>
                        </li>
                        <li>
                        <a class="nav-link text-light mt-1 mb-1 {{Request::is('penerimaan') ? 'active' : '' }}" id="terimabarang" href="{{url('/penerimaan') }}"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp; Terima Barang</a>
                        </li>                  
                    </ul>
                    
                </li>
                @endif
                <!-- Penjualan Barang -->
                @if(auth()->user()->level == 4 || auth()->user()->level == 1  || auth()->user()->level == 2)
                <li class="nav-item kotak  mt-2">
                    <a class="nav-link text-light mb-2 {{Request::is('penjualan','penjualan/form') ? 'active' : '' }}" href="{{route('penjualan') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp; &nbsp;  Penjualan Barang</a>
                </li>
                @endif
                <!-- Barang -->
                <li class="nav-item kotak text-light mt-2">
                    <a class="nav-link mb-2 text-light " type="button" data-bs-toggle="collapse" data-bs-target="#barang">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                    </svg>&nbsp; &nbsp; Barang</a>
                    
                    <ul class="collapse {{Request::is('barang','barang/stok','barang/buat') ? 'show' : '' }}" id="barang">
                    @if(auth()->user()->level == 1  || auth()->user()->level == 2)
                        <li>
                            <a class="nav-link text-light mt-1 mb-1 {{Request::is('barang','barang/buat') ? 'active' : '' }} " href="{{route('barang.tabel') }}" id="dfbrg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                            </svg>&nbsp; &nbsp;  Daftar Barang</a>
                        </li>
                    @endif
                        <li>
                        <a class="nav-link text-light mt-1 mb-1 {{Request::is('barang/stok') ? 'active' : '' }}" href="{{route('barang.stok') }}" id="stk">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
                        </svg>&nbsp; &nbsp;  Stok Barang</a>
                        </li>                  
                    </ul>
                    
                </li>
                <!-- Vendor -->
                @if(auth()->user()->level == 3 || auth()->user()->level == 1  || auth()->user()->level == 2)
                <li class="nav-item kotak  mt-2">
                    <a class="nav-link text-light mb-2 {{Request::is('vendors','vendors/form') ? 'active' : '' }}" href="{{route('vendor.table') }}" id="vndr">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                    </svg>&nbsp; &nbsp;  Vendor</a>
                </li>
                @endif
                <!-- Laporan -->
                @if(auth()->user()->level == 1  || auth()->user()->level == 2)
                <li class="nav-item kotak  mt-2">
                    <a class="nav-link text-light mb-2 {{Request::is('report') ? 'active' : '' }}" href="{{route('report') }}" id="lprn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>&nbsp; &nbsp;  Laporan</a>
                </li>
                <!-- Karyawan -->
                <li class="nav-item kotak text-light mt-2">
                    <a class="nav-link mb-2 text-light {{Request::is('karyawan') ? 'active' : '' }}" type="button" href="{{route('karyawan.table') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" width="20" height="20">
                <path fill-rule="evenodd" d="M1 6a3 3 0 013-3h12a3 3 0 013 3v8a3 3 0 01-3 3H4a3 3 0 01-3-3V6zm4 1.5a2 2 0 114 0 2 2 0 01-4 0zm2 3a4 4 0 00-3.665 2.395.75.75 0 00.416 1A8.98 8.98 0 007 14.5a8.98 8.98 0 003.249-.604.75.75 0 00.416-1.001A4.001 4.001 0 007 10.5zm5-3.75a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm0 6.5a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm.75-4a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z" clip-rule="evenodd" />
                </svg>&nbsp; &nbsp; Karyawan</a>
                    
                </li>
                @endif
            </ul>
</nav>