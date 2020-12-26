@extends('layouts.app')

@section('content')


      <div class="container border">
      @php
  $message = "Guests";
  @endphp
  <x-nav :message="$message" />
        @foreach ($tweets as $tweet)
        <div class="row border-bottom pt-3 pb-1">
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
        @endforeach
      </div>

@endsection
