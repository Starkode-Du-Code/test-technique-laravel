@extends('layouts.app')

@section('title', 'Vérification 2FA')

@section('content')
<div class="container mt-4">
    <h1>Vérification 2FA</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('verify.2fa') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" name="code" id="code" required>
        </div>
        <button type="submit" class="btn btn-primary">Vérifier</button>
    </form>
</div>
@endsection
