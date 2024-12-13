@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Réinitialiser le mot de passe</h1>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe :</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe :</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Réinitialiser</button>
    </form>
</div>
@endsection
