<!-- add_appartement.blade.php -->
@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('all.appartement') }}" class="btn btn-inverse-primary">Retour à la liste des appartements</a></li>
        </ol>
    </nav>

    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Appartement</h6>
                        <form method="POST" action="{{ route('store.appartement') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_appartement">Nom de l'Appartement</label>
                            <input type="text" class="form-control" id="nom_appartement" name="nom_appartement" required>
                        </div>
                        <div class="mb-3">
                            <label for="etage">Étage</label>
                            <input type="text" class="form-control" id="etage" name="etage" required>
                        </div>
                        <div class="mb-3">
                            <label for="surface">Surface</label>
                            <input type="text" class="form-control" id="surface" name="surface" required>
                        </div>
                        <div class="mb-3">
                            <label for="immeuble_id">Immeuble</label>
                            <select class="form-control" id="immeuble_id" name="immeuble_id">
                                @foreach($immeubles as $immeuble)
                                <option value="{{ $immeuble->id }}">{{ $immeuble->nom_immeuble }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="residence_id">Résidence</label>
                            <select class="form-control" id="residence_id" name="residence_id">
                                @foreach($residences as $residence)
                                <option value="{{ $residence->id }}">{{ $residence->nom_residence }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
