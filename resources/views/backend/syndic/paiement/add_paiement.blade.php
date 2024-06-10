@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Paiement</h6>
                        <form method="POST" action="{{ route('syndic.store.paiement') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror" id="montant" value="{{ old('montant') }}">
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_paiement" class="form-label">Date de Paiement</label>
                                <input type="date" name="date_paiement" class="form-control @error('date_paiement') is-invalid @enderror" id="date_paiement" value="{{ old('date_paiement') }}">
                                @error('date_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="methode_paiement" class="form-label">Méthode de Paiement</label>
                                <select name="methode_paiement" class="form-control @error('methode_paiement') is-invalid @enderror" id="methode_paiement">
                                    <option value="">Sélectionner une méthode de paiement</option>
                                    <option value="Espèces" {{ old('methode_paiement') == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                                    <option value="Chèque" {{ old('methode_paiement') == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                                    <option value="Virement Bancaire" {{ old('methode_paiement') == 'Virement Bancaire' ? 'selected' : '' }}>Virement Bancaire</option>
                                </select>
                                @error('methode_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="residence_id" class="form-label">Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id" disabled>
                                    <option value="{{ $user->syndicHistory->immeuble->residence->id }}">{{ $user->syndicHistory->immeuble->residence->nom_residence }}</option>
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="immeuble_id" class="form-label">Immeuble</label>
                                <select name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id" disabled>
                                    <option value="{{ $user->syndicHistory->immeuble->id }}">{{ $user->syndicHistory->immeuble->nom_immeuble }}</option>
                                </select>
                                @error('immeuble_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}


                            <div class="mb-3">
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select name="appartement_id" class="form-control @error('appartement_id') is-invalid @enderror" id="appartement_id">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}" {{ old('appartement_id') == $appartement->id ? 'selected' : '' }}>
                                            {{ $appartement->nom_appartement }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="coproprietaire_history_id" class="form-label">Copropriétaire</label>
                                <select name="coproprietaire_history_id" class="form-control @error('coproprietaire_history_id') is-invalid @enderror" id="coproprietaire_history_id">
                                    <option value="">Sélectionner un Copropriétaire</option>
                                    @foreach($coproprietaireHistories as $history)
                                        <option value="{{ $history->id }}" {{ old('coproprietaire_history_id') == $history->id ? 'selected' : '' }}>
                                            {{ $history->coproprietaire->name }} - {{ $history->appartement->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('coproprietaire_history_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="syndic_history_id" class="form-label">Syndic</label>
                                <select name="syndic_history_id" class="form-control @error('syndic_history_id') is-invalid @enderror" id="syndic_history_id">
                                    <option value="">Sélectionner un Syndic</option>
                                    @foreach($syndicHistories as $history)
                                        <option value="{{ $history->id }}" {{ old('syndic_history_id') == $history->id ? 'selected' : '' }}>
                                            {{ $history->syndic->name }} - {{ $history->immeuble->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('syndic_history_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cotisation_id" class="form-label">Cotisation</label>
                                <select name="cotisation_id" class="form-control @error('cotisation_id') is-invalid @enderror" id="cotisation_id">
                                    <option value="">Sélectionner une Cotisation</option>
                                    @foreach($cotisations as $cotisation)
                                        <option value="{{ $cotisation->id }}" {{ old('cotisation_id') == $cotisation->id ? 'selected' : '' }}>
                                            {{ $cotisation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cotisation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
