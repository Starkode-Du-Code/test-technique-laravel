@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Articles</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-4">Créer un nouvel article</a>
    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('posts.show', $post->id) }}" class="fw-bold">{{ $post->title }}</a>
                    <p class="mb-0">{{ $post->likes }} Likes</p>
                </div>
                <span class="badge bg-primary rounded-pill">Voir</span>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
