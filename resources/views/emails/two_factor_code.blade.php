@extends('layouts.app')

@section('content')
<div style="text-align: center; padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="font-size: 24px; color: #333;">Double authentification</h1>
    <p style="font-size: 16px; color: #555;">Voici votre code :</p>
    <p style="font-size: 32px; font-weight: bold; color: #000;">{{ $code }}</p>
    <p style="font-size: 14px; color: #999;">Ce code expire dans 10 minutes.</p>
</div>
@endsection
