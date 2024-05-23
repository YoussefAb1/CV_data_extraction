@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Paiement</h6>
                        <form method="POST" action="{{ route('store.paiement') }}" class="forms-sample">
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
                                <input type="text" name="methode_paiement" class="form-control @error('methode_paiement') is-invalid @enderror" id="methode_paiement" value="{{ old('methode_paiement') }}">
                                @error('methode_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select name="appartement_id" class="form-control @error('appartement_id') is-invalid @enderror" id="appartement_id">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}" {{ old('appartement_id') == $appartement->id ? 'selected' : '' }}>{{ $appartement->name }}</option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="coproprietaire_id" class="form-label">Propriétaire</label>
                                <select name="coproprietaire_id" class="form-control @error('coproprietaire_id') is-invalid @enderror" id="coproprietaire_id">
                                    <option value="">Sélectionner un Propriétaire</option>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}" {{ old('coproprietaire_id') == $coproprietaire->id ? 'selected' : '' }}>{{ $coproprietaire->name }}</option>
                                    @endforeach
                                </select>
                                @error('coproprietaire_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="syndic_id" class="form-label">Syndic</label>
                                <select name="syndic_id" class="form-control @error('syndic_id') is-invalid @enderror" id="syndic_id">
                                    <option value="">Sélectionner un Syndic</option>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}" {{ old('syndic_id') == $syndic->id ? 'selected' : '' }}>{{ $syndic->name }}</option>
                                    @endforeach
                                </select>
                                @error('syndic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cotisation_id" class="form-label">Cotisation</label>
                                <select name="cotisation_id" class="form-control @error('cotisation_id') is-invalid @enderror" id="cotisation_id">
                                    <option value="">Sélectionner une Cotisation</option>
                                    @foreach($cotisations as $cotisation)
                                        <option value="{{ $cotisation->id }}" {{ old('cotisation_id') == $cotisation->id ? 'selected' : '' }}>{{ $cotisation->description }}</option>
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
