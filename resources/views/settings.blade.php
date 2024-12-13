@extends('layouts.app')

@section('title', 'Paramètres')

@section('content')
    <h1>Paramètres</h1>
    <form>
        <!-- Exemple de paramètre -->
        <div class="mb-3">
            <label for="emailNotification" class="form-label">Activer les notifications par email</label>
            <input type="checkbox" id="emailNotification" class="form-check-input">
        </div>
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
    </form>
@endsection
