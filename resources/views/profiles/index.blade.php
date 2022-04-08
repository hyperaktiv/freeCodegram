@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-3 p-5">
            <img class="rounded-circle w-100" src="{{ $user->profile->profileImage() }}" alt="{{ $user->name }} avt">
        </div>

        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                
                <div class="d-flex align-items -center pb-4">
                    <div class="h3">{{ $user->name }}</div>
                    
                    @if (auth()->user()->id != $user->id)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endif
                    
                </div>

                @can('update', $user->profile)
                    <a href="/post/create">Add a new post</a>
                @endcan

            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
                <div class="pe-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pe-5"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
                <div class="pe-5"><strong>{{ $user->following->count() }}</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>

        </div>
    </div>

    <div class="row mt-5">
        @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/post/{{ $post->id }}">
                    <img class="w-100" src="/storage/{{ $post->image }}" alt="">
                </a>
            </div>
        @endforeach
       
    </div>
</div>
@endsection
