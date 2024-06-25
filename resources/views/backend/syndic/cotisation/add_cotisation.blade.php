@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Cotisation</h6>
                        <form action="{{ route('syndic.store.cotisation') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" required>
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_cotisation" class="form-label">Date de Cotisation</label>
                                <input type="date" class="form-control @error('date_cotisation') is-invalid @enderror" id="date_cotisation" name="date_cotisation" required>
                                @error('date_cotisation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select class="form-control @error('appartement_id') is-invalid @enderror" id="appartement_id" name="appartement_id" required>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}">{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
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
