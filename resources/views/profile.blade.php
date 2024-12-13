@extends('layouts.app') 

@section('title', 'Mon Profil')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Mon Profil</span>
            @if($user->role === 'admin')
                <span class="badge bg-danger">Admin</span>
            @else
                <span class="badge bg-secondary">User</span>
            @endif
        </div>
        <div class="card-body">
            <h5 class="card-title">Bonjour, {{ $user->name }} !</h5>
            <p class="card-text"><strong>Email : </strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Inscrit le : </strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <a href="#" class="btn btn-primary">Modifier mon profil</a>
        </div>
    </div>
@endsection
