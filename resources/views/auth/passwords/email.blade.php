@extends('layouts.app')

@section('title', 'Envoyer le lien de réinitialisation')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Réinitialiser le mot de passe</h1>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer un lien de réinitialisation</button>
    </form>
</div>
@endsection
