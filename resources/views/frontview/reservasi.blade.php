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
          <h1>Reservasi</h1>
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
      <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="form-title">
          <h2>Silahkan Reservasi di Bawah</h2>
        </div>
        <div id="form_status"></div>
        @php
                  $datenow = date('Y-m-d');
                  if(isset($status)){
                    echo $pesan;
                  }
        @endphp
        <div class="contact-form">
          <form action="{{ url('reservasi/pesan') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
            <p>
              <input type="text" placeholder="Name" name="name" id="name">
              @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
              <input type="email" placeholder="Email" name="email" id="email">
              @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
            </p>
            <p>
              <input type="tel" placeholder="Phone" name="phone" id="phone">
              @error('phone')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
              <input type="number" placeholder="Jumlah Peserta" name="jumlah" id="jumlah" min="{{ $datenow }}" style ="height:55px; width:360px">
              @error('jumlah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
              
            </p>
            <p>
              <input type="date" placeholder="Date" name="date" id="date" min="{{ $datenow }}" style ="height:55px; width:360px">
              @error('date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
              <input type="time" placeholder="Time" name="time" id="time"  style ="height:55px; width:360px">
              @error('time')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror
              
            </p>
            <p>
              <select  name="keperluan" id="keperluan"  style ="height:55px; width:100%">
              <option value="" >Pilih Keperluan</option>
              @forelse ($keperluans as $keperluan)
                <option value="{{ $keperluan->id }}" >{{ $keperluan->keperluan }}</option>
                @empty
                  <div class="alert alert-danger">
                    Data Belum Tersedia
                  </div>
              @endforelse    
              </select>
              @error('date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
              @enderror           
            </p>
            <p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
            <input type="hidden" name="token" value="FsWga4&@f6aw" />
            <p><input type="submit" value="Submit"></p>
          </form>
        </div>
      </div>
      <div class="col-lg-4">
        @forelse ($abouts as $about)
        <div class="contact-form-wrap">
          <div class="contact-form-box">
            <h4><i class="fas fa-map"></i> Booking Address</h4>
            <p>{{ $about->alamat }}</p>
          </div>
          <div class="contact-form-box">
            <h4><i class="far fa-clock"></i> Booking Hours</h4>
            <p>Every Day: 11 to 11 PM</p>
          </div>
          <div class="contact-form-box">
            <h4><i class="fas fa-address-book"></i> Contact</h4>
            <p>{{ '+62'.$about->nomor_hp }}</p>
          </div>
        </div>
        <h4><i class="fas fa-play"></i> Video Tutorial Reservasi</h4>
<iframe src="https://drive.google.com/file/d/1-mzAqr2u9LcpTe8APffBDBpu5s-fLCCs/preview" width="100%" allow="autoplay"></iframe>          @empty
            <div class="alert alert-danger">
              Data Belum Tersedia
            </div>
          @endforelse
      </div>
    </div>
  </div>
</div>
<!-- end contact form -->

@endsection
