@extends('layouts.tpl_login')
@section('title')
Beranda | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Informasi </h5>
                            <h6 class="card-subtitle">Informasi dan pemberitahuan mengenai layanan online dukcapil </h6>
                        </div>

                    </div>

                    <div class="row">
                        <div class="card-body p-t-0">
                            <div class="card b-all shadow-none">

                                <div>
                                    <hr class="m-t-0">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex m-b-40">

                                        <div class="p-l-10">
                                            <h4 class="m-b-0">Dikirim oleh : <?= $informasi[0]->created_user ?></h4>
                                            <small class="text-muted">tanggal:  <?= $informasi[0]->created_at ?></small>
                                        </div>
                                    </div>
                                    <p><b>Yth. pengguna</b></p>
                                    <?= $informasi[0]->isi_pesan
                                    ?>                      
                                </div>
                                <div>
                                    <hr class="m-t-0">
                                </div>
                                <div class="card-body">
                                    <h4> Terima kasih telah menggunakan layanan kami</h4>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>

    </div>
    @endsection
