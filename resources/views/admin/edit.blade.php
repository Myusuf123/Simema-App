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
                    <form action="{{ route('menu.update', $foods->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Makanan <i><small class="required-label"></small></i>
                                        </label>
                                        <input type="text" class="form-control" name="food_name" value="{{ $foods->food_name }}">
                                        <div class="valid-feedback">

                                        </div>
                                        <div class="invalid-feedback">
                                            <i>Input nama pendidikan wajib diisi.</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Jenis</label>
                                        <select name="jenis" id="jenis" class="select2 form-control">

                                            <option selected disabled>-- Pilih Jenis Makanan --
                                            </option>
                                            <option value="Makanan" @if ($foods->food_jenis=='Makanan') selected @endif>Makanan</option>
                                            <option value="Minuman" @if ($foods->food_jenis=='Minuman') selected @endif>Minuman</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control @error('deskripsi') is-invalid  @enderror" name="deskripsi" value="{{ $foods->deskripsi }}">
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
                                        @if ($foods->foto!=null)
                                        <img id="edit-image" src="{{ asset('img/'.$foods->foto)}}" alt="Selected Image" class="img-fluid mb-1 col-6" style="display: show;">
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('image') is-invalid  @enderror" id="image" name="image" value="{{$foods->foto}}">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{ $foods->harga }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Status</label>
                                        <select name="status" id="status" class="select2 form-control">

                                            <option selected disabled>-- Pilih Jenis Status --
                                            </option>
                                            <option value="Ready" @if ($foods->status=='Ready') selected @endif>Ready</option>
                                            <option value="Habis" @if ($foods->status=='Habis') selected @endif>Habis</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>

                <div class="card-footer">
                    Edit data makanan dan minuman @Dapur_Rempong
                </div>
            </div>
        </div>
    </div>

    @push('js-spesific')

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
                    $('#edit-image').hide();

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