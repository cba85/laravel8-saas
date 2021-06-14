@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-sm-8">
    <h1 class="text-center mb-4">Mon compte</h1>

    <a href="{{ auth()->user()->billingPortalUrl(route('account')) }}">Gérer mon abonnement</a>
</div>
</div>
</div>
@endsection
