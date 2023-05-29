@extends('layouts.admin')

@section('page-title', 'Crea nuovo progetto')

@section('content')

    <form enctype="multipart/form-data" action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') }}">

            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">

            <label for="cover_img" class="form-label">Seleziona immagine di copertina</label>

            <input type="file" class="form-control @error('cover_img') is-invalid @enderror " id="cover_img"
                name="cover_img">
            @error('cover_img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona la categoria del progetto</label>

            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror ">
                <option @selected(old('type_id') === '') value="">Nessuna categoria</option>
                @foreach ($types as $type)
                    <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description">
                {{ old('description') }}
            </textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <h5>Seleziona tecnologia usata:</h5>
            @foreach ($technologies as $technology)
                <div class="p-1">
                    <input type="checkbox" id="technology_{{ $technology->id }}" name="technologies[]"
                        value="{{ $technology->id }}" @if (in_array($technology->id, old('technologies', []))) checked @endif>

                    <label class="form-lable" for="technology_{{ $technology->id }}">
                        {{ $technology->name }}
                    </label>
                    <br>
                </div>
            @endforeach

            @error('technologies')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>
    </form>

@endsection
