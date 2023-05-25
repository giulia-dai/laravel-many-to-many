@extends('layouts.admin')

@section('page-title', 'Elenco tipi')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Numero di progetti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->slug }}</td>
                    <td>{{ count($type->posts) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
