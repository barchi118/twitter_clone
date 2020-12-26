@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('tweets.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-12">
        <div class="float-left mt-2 pt-1">
            <a href="{{ route('tweets.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
        <button type="submit" class="btn btn-primary  float-right btn-sm m-2"
        style="font-weight:bold;">
            ツイートする
        </button>
    </div>


    <div class="container border" style=" clear: both;">
    <div class="row pt-3 pb-1">
      <div class="col-2">
     <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">

      </div>
    <div class="col-10 ">
        <textarea class="form-control @error('text') is-invalid @enderror" name="text" 
        style="border:none;resize: none;" autocomplete="text" rows="4" placeholder="今なにしてる？"></textarea>
        <label style="background-color:skyblue;  
   color: black;   
   float:right;
   font-weight:bold;           
   border: 2px solid skyblue;  
   border-radius: 3em;        
   padding: 12px 9px;         
   display: inline-block;   ">
         <span class="filelabel" title="ファイルを選択">
            <span id="selectednum">画像を選択</span>
         </span>
         <input type="file" style="display: none;" class="" id="" aria-describedby="" name="text_image">
      </label>
    </div>
    <div>


    </div>
    </div>
    </div>

</form>
<!-- 
 <input type="file" class="custom-file-input d-block"  id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="text_image">
    <label class="custom-file-label " for="inputGroupFile03">Choose file</label> -->

@endsection
