@extends('layouts.headfront')

@section('content')
<!-- breadcrumb-section -->
	@php 
	$imageban = url('storage/sliders/banner.png');
	@endphp
<div class="breadcrumb-section breadcrumb-bg" style="background-image: url('{{ $imageban }}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>Input Kode Reservasi</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->
<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-5 mb-lg-0">
        <div class="form-title">
          <!-- <h2>Silahkan Reservasi di Bawah</h2> -->
        </div>
        <div id="form_status"></div>
        <div class="contact-form">
          <form action="{{ url('cekreservasi') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
            <center><p>
                <input type="text" placeholder="Input Kode Reservasi" name="tokenkode" id="tokenkode">
              @error('tokenkode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
            </p>
            <input type="hidden" name="token" value="FsWga4&@f6aw" />
            <p><input type="submit" value="Submit"></p></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end contact form -->

@endsection
