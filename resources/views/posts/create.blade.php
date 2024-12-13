@extends('layouts.app')

@section('title', 'Créer un nouvel article')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Créer un nouvel article</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre :</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Entrez le titre de l'article" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu :</label>
            <textarea class="form-control" name="content" id="content" rows="5" placeholder="Écrivez le contenu ici..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
