@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('all.appartement') }}" class="btn btn-inverse-primary">Retour à la liste des appartements</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Editer un Appartement</h6>
                    <form class="forms-sample" method="POST" action="{{ route('update.appartement', $appartement->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="nom_appartement">Nom de l'Appartement</label>
                            <input type="text" class="form-control" id="nom_appartement" name="nom_appartement" value="{{ $appartement->nom_appartement }}" required>
                        </div>
                        <div class="form-group">
                            <label for="etage">Étage</label>
                            <input type="text" class="form-control" id="etage" name="etage" value="{{ $appartement->etage }}" required>
                        </div>
                        <div class="form-group">
                            <label for="surface">Surface</label>
                            <input type="text" class="form-control" id="surface" name="surface" value="{{ $appartement->surface }}" required>
                        </div>
                        <div class="form-group">
                            <label for="immeuble_id">Immeuble</label>
                            <select class="form-control" id="immeuble_id" name="immeuble_id">
                                @foreach($immeubles as $immeuble)
                                <option value="{{ $immeuble->id }}" {{ $immeuble->id == $appartement->immeuble_id ? 'selected' : '' }}>{{ $immeuble->nom_immeuble }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="residence_id">Résidence</label>
                            <select class="form-control" id="residence_id" name="residence_id">
                                @foreach($residences as $residence)
                                <option value="{{ $residence->id }}" {{ $residence->id == $appartement->residence_id ? 'selected' : '' }}>{{ $residence->nom_residence }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
