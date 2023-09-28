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
                            <li class="breadcrumb-item active">Dashboard</li>
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
                </div>


                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                    @php
                                    $perhari ="Rp " . number_format($penghasilan_perhari,0,',','.');
                                    @endphp

                                    <h3 style="font-size: 24px">{{$perhari}}</h3>
                                    <p>Pendapatan Hari Ini</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success">
                                <div class="inner">
                                    @php
                                    $perbulan ="Rp " . number_format($penghasilan_perbulan,0,',','.');
                                    @endphp
                                    <h3 style="font-size: 24px">{{$perbulan}}<sup style="font-size: 20px"></sup></h3>
                                    <p>Pendapatan Bulan Ini</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>




                        <!-- /.card-footer-->

                        <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

</x-app-layout>