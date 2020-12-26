@extends('layouts.app')

@section('content')

<div class="fixed-top col-md-6 bg-white col-xs-9 offset-3 py-1 px-2 border-bottom border-right">
<nav >
Tweet

</nav>
</div>

            <div class="card pt-5">
                <div class="card-header">Create</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" autocomplete="text" rows="4">{{ old('text') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">140文字以内</p>
                                <div class="custom-file text-left">
    <input type="file" class="custom-file-input" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="text_image">
    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
  </div>

                                <button type="submit" class="btn btn-primary  btn-sm m-2">
                                    ツイートする
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


@endsection
