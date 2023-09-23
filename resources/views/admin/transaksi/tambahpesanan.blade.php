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

                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Transaksi</button>


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

                    <div class="form-group ">
                        <label>Makanan</label>
                        <select class="form-control select2" style="width: 100%;">


                            <option>-- Pilih Jenis Makanan --
                            </option>
                            @foreach ($makanans as $makanan)
                            <option value="{{$makanan->id}}">{{$makanan->food_name}} || Rp. {{$makanan->harga}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah
                        </label>
                        <input type="text" class="form-control " name="food_name" value="{{old('food_name')}}">

                        <div class="invalid-feedback">
                            <i>Input nama pendidikan wajib diisi.</i>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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

    {{-- alert --}}
    @include('sweetalert::alert')

    @endpush

</x-app-layout>