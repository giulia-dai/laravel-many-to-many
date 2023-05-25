@extends('layouts.admin')

@section('page-title', $post->title)

@section('content')

    <h1>{{ $post->title }}</h1>
    <h6>Slug: {{ $post->slug }}</h6>

    <h6>Type: {{ $post->type ? $post->type->name : 'Nessuna categoria selezionata' }}</h6>

    @if ($post->cover_img)
        <img class="img-thumbnail" src="{{ $post->cover_img }}" alt="{{ $post->title }}">
    @endif
    <p>{{ $post->description }}</p>

    <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Back</a>

@endsection
