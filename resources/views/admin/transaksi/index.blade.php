<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title ?? config('app.name')}} </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi Harian</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('superadmin.transaksi.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- <x-button-add title="Transaksi" href="{{ route('superadmin.transaksi.store')}}" /> -->
                        <button type="submit" class="btn btn-primary">Tambah Transaksi</button>

                    </form>
                </div>


                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Kode Transaksi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Jumlah Bayar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transaksis as $transaksi)
                            @php
                            $hasil_rupiah = "Rp " . number_format($transaksi->harga,2,',','.');
                            @endphp
                            <tr>
                                <td style="width: 5%">{{$loop->iteration}}</td>
                                <td style="width: 15%">{{$transaksi->kode_transaksi}}</td>
                                <td style="width: 15%">{{$transaksi->tanggal_transaksi}}</td>
                                <td style="width: 15%">{{$transaksi->total_harga}}</td>
                                <td style="width: 15%">{{$transaksi->jumlah_bayar}}</td>
                                <td style="width: 10%">
                                    <div class="btn btn-{{ $transaksi->status == 'Selesai' ? 'success' : 'danger' }} btn-sm">{{$transaksi->status}}</div>
                                </td>

                                <td style="width: 25%">
                                    @if ($transaksi->status == 'Selesai')
                                    <a href="{{ route('superadmin.cetak_struk', $transaksi->id) }}" target="_blank" class="btn btn-warning btn-sm"> <i class="fas fa-print"></i>
                                    </a>

                                    @endif

                                    <x-button-edit-pesanan href="{{ route('superadmin.transaksi.edit', $transaksi->id) }}" />
                                    <x-button-delete-pesanan action="{{ route('superadmin.transaksi.destroy', $transaksi->id)}}">
                                        </x-button-delete>
                                </td>
                            </tr>
                            @endforeach


                    </table>
                </div>
            </div>

    </div>

    <!-- /.card-footer-->

    <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @push('js-spesific')


    {{-- alert --}}
    @include('sweetalert::alert')

    @endpush

</x-app-layout>