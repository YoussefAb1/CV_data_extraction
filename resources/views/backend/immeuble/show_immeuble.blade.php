@extends('admin.admin_dashboard')

@section('admin')

<div class="container">
    <h1>Historique des Syndics pour l'Immeuble {{ $immeuble->nom_immeuble }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom du Syndic</th>
                <th>Date de début</th>
                <th>Date de fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($immeuble->syndics as $syndic)
                <tr>
                    <td>{{ $syndic->user->name }}</td>
                    <td>{{ $syndic->pivot->start_date }}</td>
                    <td>{{ $syndic->pivot->end_date ?? 'En cours' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
