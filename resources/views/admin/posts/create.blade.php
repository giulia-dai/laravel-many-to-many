@extends('layouts.admin')

@section('page-title', 'Crea nuovo progetto')

@section('content')

    <form action="{{ route('admin.posts.store') }}" method="POST">
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
            <label for="cover_img" class="form-label">URL immagine</label>
            <input type="text" class="form-control @error('cover_img') is-invalid @enderror " id="cover_img"
                name="cover_img" value="{{ old('cover_img') }}">
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

        <button type="submit" class="btn btn-success">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>
    </form>

@endsection
