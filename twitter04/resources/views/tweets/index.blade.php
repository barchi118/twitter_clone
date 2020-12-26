@extends('layouts.app')

@section('content')
<div class="container border">
<!-- nav -->
  @php
  $message = "Home";
  @endphp
  <x-nav :message="$message" />
  <!-- ツイートする -->
  <div class="row border-bottom pt-3 pb-1">
          <div class="col-1 ">
            <a href="{{ url('users/'.auth()->user()->id) }}" class="">
              <img src="{{ asset('storage/profile_image/'.auth()->user()->profile_image) }}"
              class="rounded-circle " width="50" height="50">
            </a>
          </div>
          <div class="col-md-10 pl-5">
          <form method="POST" action="{{ route('tweets.store') }}" enctype="multipart/form-data">
    @csrf
        <textarea class="form-control @error('text') is-invalid @enderror" name="text" 
        style="border:none;resize: none;" autocomplete="text" rows="4" placeholder="今なにしてる？"></textarea>
        <label style="background-color:skyblue;  
   color: black;   

   font-weight:bold;           
   border: 2px solid skyblue;  
   border-radius: 3em;        
   padding: 5px 5px;         
   display: inline-block;   ">
         <span class="filelabel" title="ファイルを選択">
            <span id="selectednum">画像を選択</span>
         </span>
         <input type="file" style="display: none;" class="" id="" aria-describedby="" name="text_image">
      </label>
      <button type="submit" class="btn btn-primary  float-right btn-sm m-2"
        style="font-weight:bold;">
            ツイートする
        </button>
        </form>
    </div>
        </div>

  <!-- タイムライン -->
  <x-tweet-article />
</div>
@endsection
