@extends('layouts.tpl_login')
@section('title')
Informasi & Pengumuman | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card text-center">

                <div class="card-body">
                    <h4 class="card-title">Pengumuman</h4>

                </div>

            </div>
            <!-- Card -->
        </div>
    </div>
    <div class="row">
        <div class="col-8">

            @foreach($pengumuman as $d)


            <div class="card">

                <div class="card-body" >
                    <h3 class="title" style="color: black"><i class="fa fa-exclamation-triangle"></i> <?= $d->judul ?></h3>                         
                    <span class="" style="color: black"><?= $d->isi_pengumuman ?></span>

                </div>

            </div>
            <!-- Card -->
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">INFORMASI TERAKHIR</h5>
                    <div class="message-box">
                        <div class="message-widget message-scroll">
                            <!-- Message -->
                            @foreach($pengumuman_list as $d)
                            <a href="<?= url('informasi/' . Crypt::encrypt($d->id) . '/detail') ?>">
                                <div class="mail-contnet">
                                    <h5><?= $d->judul ?></h5> <span class="mail-desc">Diposting tanggal </span> <span class="time"><?= $d->created_at ?></span> </div>
                            </a>
                            @endforeach
                            <!-- Message -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Row -->  

@endsection
