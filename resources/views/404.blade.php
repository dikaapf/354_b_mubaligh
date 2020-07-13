@extends('layouts.lte')

@section('content')
<section class="content">

    <div class="error-page">
        <h2 class="headline">500</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Halaman tidak ditemukan.</h3>
            <p>
                Hal ini dikarenakan url tidak ditemukan, atau salah satu server dalam keadaan non aktif
                <br>Silahkan kembali lagi
            </p>
            <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="Search"/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div><!-- /.input-group -->
            </form>
        </div>
    </div><!-- /.error-page -->

</section><!-- /.content -->

@endsection