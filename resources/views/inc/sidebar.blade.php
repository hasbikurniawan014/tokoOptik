<nav id="sidebar">
    <div class="sidebar-header text-center">
            <div class="row mb-1">
                <div class="col-sm">
                    <div class="badge badge-light">
                        <i class="fa fa-circle text-success"></i>
                        @if(auth()->user()->akses==1)
                            Kepala Toko
                        @else
                            Karyawan
                        @endif
                  </div>
                </div>
                <div class="col-sm">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="badge  btn text-light ">
                            <i class="fa fa-power-off mr-2 text-danger"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @if(auth()->user()->foto)
                @if(auth()->user()->akses == 1)
                    <img src="{{url('gambar/profil/kepToko/'.auth()->user()->foto)}}" alt="" class="w-50">
                @elseif(auth()->user()->akses == 2)
                    <img src="{{url('gambar/profil/karyawan/'.auth()->user()->foto)}}" alt="" class="w-50">
                @endif
            @else
                <p><i class="fa fa-user fa-5x text-light "></i></p>
            @endif
            <br>
            <span>
                {{auth()->user()->nama}} <br>
                <span>{{auth()->user()->username}}</span>
            </span>
            <br>
            <a href="{{route('home.ubah')}}" class="badge  "><i class="fa fa-cog mr-2 text-warning"></i>Ubah password</a>
        </div>

    <ul class="list-unstyled components">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-dashboard mr-2"></i> Halaman Utama</a>
        </li>
         @can('ketoko')
          <li>
            <a href="#pengguna" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users mr-2"></i> Daftar Pengguna</a>
            <ul class="collapse list-unstyled" id="pengguna">
                <li>
                    <a href="{{route('karyawan.index')}}">Daftar Karyawan</a>
                </li>
                <li>
                    <a href="{{route('kepToko.index')}}">Daftar Kepala Toko</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#produk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-th mr-2"></i> Daftar Produk</a>
            <ul class="collapse list-unstyled" id="produk">
                <li>
                    <a href="{{route('frame.index')}}">Produk Frame</a>
                </li>
                <li>
                    <a href="{{route('softlens.index')}}">Produk softlens</a>
                </li>
                <li>
                    <a href="{{route('cleaner.index')}}">Produk Pembersih</a>
                </li>
            </ul>
        </li>
       <li>
            <a href="#lensasv" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-eye mr-2"></i> Daftar Lensa</a>
            <ul class="collapse list-unstyled" id="lensasv">
                <li>
                    <a href="{{route('lensaSv.index')}}">Produk Single Vision</a>
                </li>
                <li>
                    <a href="{{route('lensaBf.index')}}">Produk Bifokal</a>
                </li>
                <li>
                    <a href="{{route('type.index')}}">Type & kategori Lensa</a>
                </li>
            </ul>
        </li>
       <li>
           <a href="{{route('jasa.index')}}"><i class="fa fa-user mr-2"></i>Daftar Jasa</a>
        </li>
         @endcan
        {{-- <p class="text-center">Sistem Monitoring Inventori Aksesosris Kacamata</p> --}}
    </ul>
</nav>