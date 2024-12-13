@extends('layouts.app')

@section('title', 'Détails de l\'article')

@section('content')
<div class="container mt-4">
    <h1>{{ $post->title }}</h1>
    <p class="text-muted">{{ $post->content }}</p>
    
    <form action="{{ route('posts.like', $post->id) }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger">❤️ J'aime ({{ $post->likes }})</button>
    </form>
    
    @if(auth()->check() && auth()->user()->role === 'admin')
        <form action="{{ route('posts.destroy.admin', $post->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer cet article</button>
        </form>
    @endif
    
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-4">Retour</a>

    <h2>Ajouter un commentaire</h2>
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="author" class="form-label">Auteur :</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="Votre nom">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu :</label>
            <textarea class="form-control" name="content" id="content" rows="3" placeholder="Votre commentaire"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <h2>Commentaires</h2>
    <ul class="list-group">
        @foreach($post->comments as $comment)
            <li class="list-group-item">
                <strong>{{ $comment->author }}:</strong> {{ $comment->content }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
