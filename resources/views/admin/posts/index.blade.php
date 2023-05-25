@extends('layouts.admin')
@section('page-title', 'Elenco progetti')
@section('content')
    <a href="{{ route('admin.posts.create') }}" class="btn-primary btn">Crea nuovo progetto</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Categoria</th>
                <th scope="col">Azioni</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->type?->name }}</td>

                    <td>
                        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success">See More</a>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-warning">Edit</a>


                        <form class="form_delete_post" action="{{ route('admin.posts.destroy', ['post' => $post->slug]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger mt-2"> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal --}}
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma l'eliminazione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Confermi di voler eliminare l'elemento selezionato?
                    <h6>L'azione sarà irreversibile</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
