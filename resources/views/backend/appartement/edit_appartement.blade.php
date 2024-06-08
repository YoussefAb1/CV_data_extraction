@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Appartement</h6>
                        <form action="{{ route('update.appartement', $appartement->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nom_appartement">Nom de l'Appartement</label>
                            <input type="text" class="form-control @error('nom_appartement') is-invalid @enderror" id="nom_appartement" name="nom_appartement" value="{{ $appartement->nom_appartement }}" required>
                            @error('nom_appartement')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="etage">Étage</label>
                            <input type="text" class="form-control @error('etage') is-invalid @enderror" id="etage" name="etage" value="{{ $appartement->etage }}" required>
                            @error('etage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="surface">Surface</label>
                            <input type="text" class="form-control @error('surface') is-invalid @enderror" id="surface" name="surface" value="{{ $appartement->surface }}" required>
                            @error('surface')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="immeuble_id">Immeuble</label>
                            <select class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id" name="immeuble_id">
                                @foreach($immeubles as $immeuble)
                                    <option value="{{ $immeuble->id }}" {{ $immeuble->id == $appartement->immeuble_id ? 'selected' : '' }}>{{ $immeuble->nom_immeuble }}</option>
                                @endforeach
                            </select>
                            @error('immeuble_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="residence_id">Résidence</label>
                            <select class="form-control @error('residence_id') is-invalid @enderror" id="residence_id" name="residence_id">
                                @foreach($residences as $residence)
                                    <option value="{{ $residence->id }}" {{ $residence->id == $appartement->residence_id ? 'selected' : '' }}>{{ $residence->nom_residence }}</option>
                                @endforeach
                            </select>
                            @error('residence_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
