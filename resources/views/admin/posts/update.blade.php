@extends('layouts.admin')

@section('page-title', 'Modifica')

@section('content')

    <form action="{{ route('admin.posts.update', ['post' => $post->slug]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $post->title) }}">

            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description">
                {{ old('description', $post->description) }}
            </textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>



    </form>

@endsection
