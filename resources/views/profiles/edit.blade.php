@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit Profile</h1>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" caption="title" value="{{ old('title')  ?? $user->profile->title }}" autocomplete="title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <input id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" caption="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description" autofocus>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                    <div class="col-md-6">
                        <input id="url" name="url" type="text" class="form-control @error('url') is-invalid @enderror" caption="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url" autofocus>

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label text-md-right">Profile Image</label>

                    <div class="col-md-6">
                        <input type="file" name="image" id="image">

                        @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class=" row">
                    <div class="col-md-6">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection