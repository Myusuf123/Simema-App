<x-customer-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Minuman</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <section class="content">

            <!-- Default box -->
            <div class="container-fluid py-2">
                <h1 class="text-center">
                    {{$title}}
                </h1>

                <div class="row row-cols-1 row-cols-md-3 g-4 py-3">
                    @foreach ($foods as $food)
                    @php
                    $hasil_rupiah = "Rp " . number_format($food->harga,2,',','.');
                    @endphp
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('img/'.$food->foto)}}" alt="" class="card-img-top" height="400" width="200">
                            <div class="card-body">
                                <h2>
                                    {{$food->food_name}}
                                </h2>
                                <p class="card-text">
                                    {{$food->deskripsi}}
                                </p>
                            </div>
                            <div class="d-flex justify-content-around mb-5">

                                <h3>
                                    {{$hasil_rupiah}}
                                </h3>
                                <button class="btn btn-{{ $food->status == 'Ready' ? 'success' : 'danger' }}">
                                    {{$food->status}}
                                </button>
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

            <!-- /.card-footer-->

            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data {{ $title ?? ''}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('menu.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Makanan <i><small class="required-label"></small></i>
                            </label>
                            <input type="text" class="form-control" name="food_name" required="">
                            <div class="valid-feedback">

                            </div>
                            <div class="invalid-feedback">
                                <i>Input nama pendidikan wajib diisi.</i>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Jenis</label>



                            <select name="jenis" id="jenis" class="select2 form-control">




                                <option selected disabled>-- Pilih Jenis Makanan --
                                </option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>

                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Foto Makanan</label>
                            <img id="selected-image" src="" alt="Selected Image" class="img-fluid mb-1 col-6" style="display: none;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="harga" required="">
                        </div>
                        <div class="form-group ">
                            <label>Status</label>
                            <select name="status" id="status" class="select2 form-control">

                                <option selected disabled>-- Pilih Jenis Status --
                                </option>
                                <option value="Ready">Ready</option>
                                <option value="Habis">Habis</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="buttonAdd" class="btn btn-primary" disabled>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

</x-customer-layout>