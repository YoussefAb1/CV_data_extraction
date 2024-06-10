@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Paiement</h6>
                        <form method="POST" action="{{ route('syndic.update.paiement', $paiement->id) }}" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror" id="montant" value="{{ old('montant', $paiement->montant) }}">
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_paiement" class="form-label">Date de Paiement</label>
                                <input type="date" name="date_paiement" class="form-control @error('date_paiement') is-invalid @enderror" id="date_paiement" value="{{ old('date_paiement', $paiement->date_paiement) }}">
                                @error('date_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="methode_paiement" class="form-label">Méthode de Paiement</label>
                                <input type="text" name="methode_paiement" class="form-control @error('methode_paiement') is-invalid @enderror" id="methode_paiement" value="{{ old('methode_paiement', $paiement->methode_paiement) }}">
                                @error('methode_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="residence_id" class="form-label">Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id" disabled>
                                    <option value="{{ $paiement->syndicHistory->immeuble->residence->id }}">{{ $paiement->syndicHistory->immeuble->residence->nom_residence }}</option>
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="immeuble_id" class="form-label">Immeuble</label>
                                <select name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id" disabled>
                                    <option value="{{ $paiement->syndicHistory->immeuble->id }}">{{ $paiement->syndicHistory->immeuble->nom_immeuble }}</option>
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
                                        <option value="{{ $appartement->id }}" {{ old('appartement_id', $paiement->appartement_id) == $appartement->id ? 'selected' : '' }}>{{ $appartement->name }}</option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_coproprietaire_id" class="form-label">Propriétaire</label>
                                <select name="member_coproprietaire_id" class="form-control @error('member_coproprietaire_id') is-invalid @enderror" id="member_coproprietaire_id">
                                    <option value="">Sélectionner un Propriétaire</option>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}" {{ old('member_coproprietaire_id', $paiement->member_coproprietaire_id) == $coproprietaire->id ? 'selected' : '' }}>{{ $coproprietaire->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_coproprietaire_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_syndic_id" class="form-label">Syndic</label>
                                <select name="member_syndic_id" class="form-control @error('member_syndic_id') is-invalid @enderror" id="member_syndic_id">
                                    <option value="">Sélectionner un Syndic</option>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}" {{ old('member_syndic_id', $paiement->member_syndic_id) == $syndic->id ? 'selected' : '' }}>{{ $syndic->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_syndic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cotisation_id" class="form-label">Cotisation</label>
                                <select name="cotisation_id" class="form-control @error('cotisation_id') is-invalid @enderror" id="cotisation_id">
                                    <option value="">Sélectionner une Cotisation</option>
                                    @foreach($cotisations as $cotisation)
                                        <option value="{{ $cotisation->id }}" {{ old('cotisation_id', $paiement->cotisation_id) == $cotisation->id ? 'selected' : '' }}>{{ $cotisation->description }}</option>
                                    @endforeach
                                </select>
                                @error('cotisation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
