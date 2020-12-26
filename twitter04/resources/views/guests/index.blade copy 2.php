@extends('layouts.app')

@section('content')
<div class=" col-lg-9 col-md-10 col-xl-6  col-sm-10  pl-0">
  <!-- ヘッダー -->
  <div>
    <div>
      <div class="container  ">
        <div class="row ">
          <div class="col-12 bg-white border py-3  ">
            <h2　style="font-weight:bold;"><strong>
              Guests</strong></h2>
              <i class="far fa-star float-right"></i>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- タイムライン -->
    <div class=" " id="top">
      @foreach ($tweets as $tweet)
      <div class="container border">
        <div class="row pt-3 pb-1">
          <div class="col-1">
            <a href="" class="">
              <img src="{{ asset('storage/profile_image/' .$all_users->find($tweet->user_id)->profile_image) }}"
              class="rounded-circle " width="50" height="50">
            </a>
          </div>
          <div class="col-md-11 pl-4">
            <p class="mb-0" style="font-weight:bold;">{{$all_users->find($tweet->user_id)->screen_name}}
              <small class="text-secondary">{{'@'.$all_users->find($tweet->user_id)->name}}</small>
              <small class="text-secondary">{{$tweet->created_at->format('Y/m/d')}}</small>
            </p>
            @if($tweet->text == null)
            @else
            <p class="text-left">{!! nl2br(e($tweet->text)) !!}</p>
            @endif
            @if($tweet->text_image == null)
            @else
            <div class="">
              <a href="{{ asset('storage/text_images/' .$tweet->text_image) }}" data-lightbox="group">
                <img src="{{ asset('storage/text_images/' .$tweet->text_image) }}"
                class="rounded " style=" object-fit: cover;width:100%;height:200px;" alt="">
              </a>
            </div>
            @endif

          </div>
        </div>
      </div>

      @endforeach

    </div>
    @endsection
