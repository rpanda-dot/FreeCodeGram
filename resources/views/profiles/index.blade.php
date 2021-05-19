@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img height="100" src="{{ $user->profile->get_profile_image() }}" class="rounded-circle w-100 h-100">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-item-baseline">
                    <div class="d-flex align-item-center mb-3">
                        <div class="h4">
                            {{ $user->username }}
                        </div>
                        <follow-button user-id="{{ $user->id }}"></follow-button>
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan

                </div>
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan

                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $user->posts()->count() }}</strong>Posts</div>
                    <div class="pr-5"><strong>23k</strong>Followers</div>
                    <div class="pr-5"><strong>212</strong>Following</div>
                </div>
                <div class="pt-4">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="http://{{ $user->profile->url }}">{{ $user->profile->url }}</a></div>
            </div>
        </div>
        <div class="row pt-3">
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                </div>
            @endforeach


        </div>
    </div>
@endsection
