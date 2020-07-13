@extends('layouts.tpl_login')
@section('title')
FAQ - Pertanyaan & Jawaban | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card text-center">

                <div class="card-body">
                    <h4 class="card-title"><?= ($instansi->slogan_header != null) ? $instansi->slogan_header : '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>Update slogan header di pengaturan instansi

                                    </div>' ?></h4>
                    <H5><?= ($instansi->nama_dinas != null) ? $instansi->nama_dinas : '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>Update nama dinas di pengaturan instansi

                                    </div>' ?> 
                        <?= ($instansi->nama_kabupaten != null) ? $instansi->nama_kabupaten : '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>Update nama kabupaten di pengaturan instansi

                                    </div>' ?>
                    </H5>
                </div>

            </div>
            <!-- Card -->
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Daftar Pertanyaan</h5>
                            <h6 class="card-subtitle">Berikut adalah daftar pertanyaan yang sering ditanyakan beserta jawabannya </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div id="accordion2" role="tablist" class="minimal-faq" aria-multiselectable="true">
                                        <?php $no = 1 ?>
                                        @foreach($pertanyaan as $dt)

                                        <div class="card m-b-0">
                                            <div class="card-header " role="tab" id="heading<?= $no ?>">
                                                <h5 class="mb-0">
                                                    <a class="collapsed link" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?= $no ?>" aria-expanded="true" aria-controls="collapse<?= $no ?>">
                                                        <span class="card-title text-info"> <?= $no ?>. <?= $dt->pertanyaan ?> ?</span> 
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse<?= $no ?>" class="collapse <?= $no == 1 ? 'show' : '' ?> " role="tabpanel" aria-labelledby="heading<?= $no ?>">
                                                <div class="card-body">
                                                    <?= $dt->jawaban ?>                                            
                                                </div>
                                            </div>
                                        </div>
                                        <?php $no++ ?>
                                        @endforeach



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6">
                        <div class="card text-center bg-dark text-white">
                            <div class="card-body"> <h5>Nomor Whatsapp Hotline</h5>
                                <h4 class="display-6 mb-1 mt-1">0822-4815-3687</h4> 
                                <div>
                                    <a class="btn btn-md btn-success btn-block btn-rounded card-title text-white" target="_blank" href="https://wa.me/6282248153687"><i class="fa fa-whatsapp mr-1" style="font-size: 14px;"></i>Kirim pesan</a>
                                </div>
                                <br/> 

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center bg-dark text-white">
                            <div class="card-body"> 
                                <h5>Alamat Kantor</h5>
                                <address>
                                    <h3> <b class="text-white">Dinas Kependudukan dan Pencatatan Sipil <br>
                                            Kabupaten Jayawijaya</b></h3>
                                    <p class="text-white m-l-5">Jalan Yos Sudarso Wamena, Propinsi Papua - 99501
                                        <br/> email: disdukcapil.jayawijaya@gmail.com,
                                        - website: <a href="http://disdukcapil.jayawijayakab.go.id">http://disdukcapil.jayawijayakab.go.id</a> ,
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->  


@endsection
