@extends('layout.frontend.home.main')
@section('judul_hal','Home')
@push('css')
@endpush
@push('scripts')
@endpush
@section('home1')
<section class="clean-block clean-hero" style="background-image:url('{{url('img/tech/image4.jpg')}}');color:rgba(9, 162, 255, 0.85);">
    <div class="text">
        <h2>eAssetSMK</h2>
        <p>Adalah Aplikasi Pengelolaan, Pencatatan, Pengorganisasian, Pelaporan, Pengecakan, dan Pelabelan dalam QrCode Inventaris/Aset Sekolah</p><a href="https://github.com/ozonerik/eAssetSMK" class="btn btn-outline-light btn-lg" type="button">Learn More</a>
    </div>
</section>
@endsection