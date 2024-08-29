@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Paiement</h6>

                        {{-- Afficher les erreurs de validation --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('syndic.store.paiement') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" required>
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_paiement" class="form-label">Date de Paiement</label>
                                <input type="date" class="form-control @error('date_paiement') is-invalid @enderror" id="date_paiement" name="date_paiement" required>
                                @error('date_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="methode_paiement" class="form-label">Méthode de Paiement</label>
                                <input type="text" class="form-control @error('methode_paiement') is-invalid @enderror" id="methode_paiement" name="methode_paiement" required>
                                @error('methode_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cotisation_id" class="form-label">Cotisation</label>
                                <select class="form-control @error('cotisation_id') is-invalid @enderror" id="cotisation_id" name="cotisation_id" required>
                                    @foreach($cotisations as $cotisation)
                                        <option value="{{ $cotisation->id }}">{{ $cotisation->description }}</option>
                                    @endforeach
                                </select>
                                @error('cotisation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="coproprietaire_history_id" class="form-label">Copropriétaire</label>
                                <select class="form-control @error('coproprietaire_history_id') is-invalid @enderror" id="coproprietaire_history_id" name="coproprietaire_history_id" required>
                                    @foreach($appartements as $appartement)
                                        @foreach($appartement->coproprietaireHistories as $history)
                                            <option value="{{ $history->id }}">{{ $history->coproprietaire->name }} - {{ $appartement->nom_appartement }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('coproprietaire_history_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="immeuble" class="form-label">Immeuble</label>
                                <input type="text" class="form-control" id="immeuble" name="immeuble" value="{{ $immeuble->nom_immeuble }}" readonly>
                                <input type="hidden" name="immeuble_id" value="{{ $immeuble->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="residence" class="form-label">Résidence</label>
                                <input type="text" class="form-control" id="residence" name="residence" value="{{ $residence->nom_residence }}" readonly>
                                <input type="hidden" name="residence_id" value="{{ $residence->id }}">
                            </div>
                            <input type="hidden" name="syndic_history_id" value="{{ $syndicHistory->id }}">
                            <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
