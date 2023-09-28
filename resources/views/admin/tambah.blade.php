<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title ?? config('app.name')}} </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Makanan & Minuman</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <div class="container-fluid">

            <div class="card card-default">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('menu.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Makanan <i><small class="required-label"></small></i>
                                        </label>
                                        <input type="text" class="form-control " name="food_name" value="{{old('food_name')}}">

                                        <div class="invalid-feedback">
                                            <i>Input nama pendidikan wajib diisi.</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Jenis</label>

                                        <select name="jenis" id="jenis" class="form-control" style="width: 100%;" value="{{old('jenis')}}">

                                            <option selected disabled>-- Pilih Jenis Makanan --
                                            </option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Minuman">Minuman</option>
                                            <option value="Cemilan">Cemilan</option>
                                            <option value="Catering">Catering</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control @error('deskripsi') is-invalid  @enderror" name="deskripsi" value="{{old('deskripsi')}}" @error('food_name') autofocus @enderror>
                                        @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Foto Makanan</label>
                                        <img id="selected-image" src="" alt="Selected Image" class="img-fluid mb-1 col-6" style="display: none;">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{old('harga')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control" style="width: 100%;">

                                            <option selected disabled>-- Pilih Jenis Status --
                                            </option>
                                            <option value="Ready">Ready</option>
                                            <option value="Habis">Habis</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="buttonAdd" class="btn btn-primary" disabled>Simpan</button>
                        </div>
                    </form>

                </div>

                <div class="card-footer">
                    Tambah data makanan dan minuman @Dapur_Rempong
                </div>
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

</x-app-layout>