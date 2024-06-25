@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Appartement</h6>
                        <form action="{{ route('syndic.store.appartement') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_appartement" class="form-label">Nom Appartement</label>
                                <input type="text" class="form-control @error('nom_appartement') is-invalid @enderror" id="nom_appartement" name="nom_appartement" required>
                                @error('nom_appartement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="etage" class="form-label">Étage</label>
                                <input type="text" class="form-control @error('etage') is-invalid @enderror" id="etage" name="etage" required>
                                @error('etage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="surface" class="form-label">Surface</label>
                                <input type="text" class="form-control @error('surface') is-invalid @enderror" id="surface" name="surface" required>
                                @error('surface')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="immeuble" class="form-label">Immeuble</label>
                                <input type="text" class="form-control" id="immeuble" name="immeuble" value="{{ $immeuble->nom_immeuble }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="residence" class="form-label">Résidence</label>
                                <input type="text" class="form-control" id="residence" name="residence" value="{{ $residence->nom_residence }}" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
