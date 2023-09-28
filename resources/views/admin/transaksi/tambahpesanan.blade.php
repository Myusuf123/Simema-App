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

                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Makanan</button>


                </div>


                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>

                                <th class="text-center">Jenis Makanan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_pembelians as $tr_pembelian)
                            <tr>
                                <td style="width: 5%">{{$loop->iteration}}</td>
                                <td style="width: 15%">{{$tr_pembelian->foodmenu->food_name}}</td>
                                <td style="width: 15%">{{$tr_pembelian->jumlah_pesanan}}</td>

                                <td style="width: 15%">{{$tr_pembelian->totalharga}}</td>



                                <td style="width: 25%">
                                    <x-button-delete action="{{ route('superadmin.transaksiPembelian.destroy', $tr_pembelian->id)}}">
                                    </x-button-delete>
                                </td>
                            </tr>
                            @endforeach



                    </table>
                    <form action="{{ route('superadmin.transaksi_update', $transaksi->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-3 float-right pt-2">
                                <label>Jumlah Uang
                                </label>
                                <input type="text" class="form-control " name="jumlah_bayar" id="jumlah_uang">

                            </div>
                            <div class="form-group col-md-3 float-right pt-2">
                                <label>Total bayar
                                </label>
                                <input type="text" class="form-control " id="total_bayar" value="{{$total_bayar}}" readonly name="total_bayar">

                            </div>
                            <div class="form-group col-md-3 float-right pt-2">
                                <label>Kembalian
                                </label>
                                <input type="text" class="form-control " id="hasil" disabled>


                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin Simpan?')">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>

    </div>

    <!-- /.card-footer-->

    <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Makanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('superadmin.transaksi_menu')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control " name="kode_transaksi_id" value="{{ $transaksi->kode_transaksi }}">
                        <input type="hidden" class="form-control " name="transaksi_id" value="{{ $transaksi->id}}">



                        <div class="form-group ">
                            <label>Makanan</label>
                            <select class="form-control select2" style="width: 100%;" name="foodmenu_id" required>


                                <option disabled selected>-- Pilih Jenis Makanan --
                                </option>
                                @foreach ($makanans as $makanan)
                                @php
                                $hasil_rupiah = "Rp " . number_format($makanan->harga,2,',','.');
                                @endphp
                                <option value="{{$makanan->id}}">{{$makanan->food_name}} -- Rp. {{$hasil_rupiah}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jumlah
                            </label>
                            <input type="number" class="form-control " name="jumlah" required>

                            <div class="invalid-feedback">
                                <i>Input nama pendidikan wajib diisi.</i>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    @push('js-spesific')

    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                dropdownParent: $('#exampleModal')
            })



            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>



    <!-- <script type="text/javascript">
        hargasatuan = document.formD.harga.value;
        document.formD.txtDisplay.value = hargasatuan;
        jumlah = document.formD.jmlpsn.value;
        document.formD.txtDisplay.value = jumlah;

        function OnChange(value) {
            hargasatuan = document.formD.harga.value;
            jumlah = document.formD.jmlpsn.value;
            total = hargasatuan * jumlah;
            document.formD.txtDisplay.value = total;
        }
    </script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#jumlah_uang ").keyup(function() {
                var jumlah_uang = parseInt($("#jumlah_uang").val());
                var total_bayar = parseInt($("#total_bayar").val());
                var hasil = jumlah_uang - total_bayar;
                $("#hasil").val(hasil);
            });
        });
    </script>

    {{-- alert --}}
    @include('sweetalert::alert')

    @endpush

</x-app-layout>