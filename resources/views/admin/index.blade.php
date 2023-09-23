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
                            <li class="breadcrumb-item active">Daftar Makanan & Minuman</li>
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
                    <x-button-add title="Menu" href="{{ route('superadmin.menu.create')}}" />

                </div>


                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Makanan</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($foods as $food)
                            @php
                            $hasil_rupiah = "Rp " . number_format($food->harga,2,',','.');
                            @endphp
                            <tr>
                                <td style="width: 10%">{{$loop->iteration}}</td>
                                <td style="width: 25%">{{$food->food_name}}</td>
                                <td style="width: 25%">{{$food->food_jenis}}</td>
                                <td style="width: 25%">{{$food->deskripsi}}</td>
                                <td style="width: 25%">
                                    <img src="{{ asset('img/'.$food->foto)}}" style="width: 200px">
                                </td>
                                <td style="width: 20%">{{$hasil_rupiah}}</td>
                                <td style="width: 20%">
                                    <div class="btn btn-{{ $food->status == 'Ready' ? 'success' : 'danger' }} btn-sm">{{$food->status}}</div>
                                </td>
                                <td style="width: 25%">
                                    <x-button-edit href="{{ route('superadmin.menu.edit', $food->id) }}" />
                                    <x-button-delete action="{{ route('menu.destroy', $food->id)}}">
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
    <script>
        $(document).ready(function() {
            // Event listener untuk input change
            $('input[name="food_name"]').on('input', function() {
                var nameInput = $(this);
                var name = nameInput.val();

                if (name.trim() === '') {
                    nameInput.removeClass('is-valid').addClass('is-invalid');
                    $('#buttonAdd').prop('disabled', true);
                    $('#buttonUpdate').prop('disabled', true);
                } else {
                    nameInput.removeClass('is-invalid').addClass('is-valid');
                    $('#buttonAdd').prop('disabled', false);
                    $('#buttonUpdate').prop('disabled', false);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ketika input file berubah
            $('#image').change(function() {
                var file = $(this).prop('files')[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Tampilkan gambar yang dipilih di elemen <img>
                    $('#selected-image').attr('src', e.target.result);
                    $('#selected-image').show();

                    // Tampilkan nama file di label custom-file-label
                    $('.custom-file-label').text(file.name);
                }

                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>

    {{-- alert --}}
    @include('sweetalert::alert')

    @endpush

</x-app-layout>