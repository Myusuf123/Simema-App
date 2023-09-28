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
                            <li class="breadcrumb-item active">Daftar Makanan</li>
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