@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6>Ajouter un Copropriétaire à l'Immeuble {{ $appartement->nom_appartement }}</h6>
                        <br>
                        <form action="{{ route('store.coproprietaire_to_appartement', $appartement->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="coproprietaire_id">Copropriétaire</label>
                            <select class="form-control" id="coproprietaire_id" name="coproprietaire_id">
                                @foreach($coproprietaires as $coproprietaire)
                                <option value="{{ $coproprietaire->id }}">{{ $coproprietaire->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_date">Date de Début</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Associer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
