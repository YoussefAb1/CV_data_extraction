@extends('backend.syndic.syndic_dashboard')

@section('syndic')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('syndic.all.appartement') }}" class="btn btn-inverse-primary">Retour à la liste des appartements</a></li>
        </ol>
    </nav>

    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Appartement</h6>
                        <form method="POST" action="{{ route('syndic.update.appartement', $appartement->id) }}" class="forms-sample">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nom_appartement">Nom de l'Appartement</label>
                                <input type="text" class="form-control" id="nom_appartement" name="nom_appartement" value="{{ $appartement->nom_appartement }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="etage">Étage</label>
                                <input type="text" class="form-control" id="etage" name="etage" value="{{ $appartement->etage }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="surface">Surface</label>
                                <input type="text" class="form-control" id="surface" name="surface" value="{{ $appartement->surface }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="immeuble_id">Immeuble</label>
                                <select name="immeuble_id" class="form-control" disabled>
                                    <option value="{{ $immeuble->id }}" selected>{{ $immeuble->nom_immeuble }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="residence_id">Résidence</label>
                                <select name="residence_id" class="form-control" disabled>
                                    <option value="{{ $residence->id }}" selected>{{ $residence->nom_residence }}</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
