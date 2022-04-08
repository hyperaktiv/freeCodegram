@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->caption }}">
        </div>

        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    
                    <div>
                        <a href="/profile/{{ $post->user->id }}" class="text-decoration-none text-dark"><strong>{{ $post->user->name }}</strong></a>
                        
                        <a href="#" class="ps-3 text-decoration-none">Follow</a>
                    </div>
                    
                </div>

                <hr>

                <p>
                    <strong>
                        <a href="/profile/{{ $post->user->id }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                    </strong> {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
