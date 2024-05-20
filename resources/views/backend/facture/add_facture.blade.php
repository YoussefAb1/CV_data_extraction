@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Facture</h6>
                        <form method="POST" action="{{ route('store.facture') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="numero_facture" class="form-label">Numéro Facture</label>
                                <input type="text" name="numero_facture" class="form-control @error('numero_facture') is-invalid @enderror" id="numero_facture" value="{{ old('numero_facture') }}">
                                @error('numero_facture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_emission" class="form-label">Date d'émission</label>
                                <input type="date" name="date_emission" class="form-control @error('date_emission') is-invalid @enderror" id="date_emission" value="{{ old('date_emission') }}">
                                @error('date_emission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_echeance" class="form-label">Date d'échéance</label>
                                <input type="date" name="date_echeance" class="form-control @error('date_echeance') is-invalid @enderror" id="date_echeance" value="{{ old('date_echeance') }}">
                                @error('date_echeance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="montant_total" class="form-label">Montant Total</label>
                                <input type="text" name="montant_total" class="form-control @error('montant_total') is-invalid @enderror" id="montant_total" value="{{ old('montant_total') }}">
                                @error('montant_total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="paiement_id" class="form-label">Paiement</label>
                                <select name="paiement_id" class="form-control @error('paiement_id') is-invalid @enderror" id="paiement_id">
                                    <option value="">Sélectionner un Paiement</option>
                                    @foreach($paiements as $paiement)
                                        <option value="{{ $paiement->id }}" {{ old('paiement_id') == $paiement->id ? 'selected' : '' }}>{{ $paiement->id }}</option>
                                    @endforeach
                                </select>
                                @error('paiement_id')
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
                                <label for="member_coproprietaire_id" class="form-label">Propriétaire</label>
                                <select name="member_coproprietaire_id" class="form-control @error('member_coproprietaire_id') is-invalid @enderror" id="member_coproprietaire_id">
                                    <option value="">Sélectionner un Propriétaire</option>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}" {{ old('member_coproprietaire_id') == $coproprietaire->id ? 'selected' : '' }}>{{ $coproprietaire->name }}</option>
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
                                            <option value="{{ $syndic->id }}" {{ old('member_syndic_id') == $syndic->id ? 'selected' : '' }}>{{ $syndic->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('member_syndic_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="charge_id" class="form-label">Charge</label>
                                    <select name="charge_id" class="form-control @error('charge_id') is-invalid @enderror" id="charge_id">
                                        <option value="">Sélectionner une Charge</option>
                                        @foreach($charges as $charge)
                                            <option value="{{ $charge->id }}" {{ old('charge_id') == $charge->id ? 'selected' : '' }}>{{ $charge->designation }}</option>
                                        @endforeach
                                    </select>
                                    @error('charge_id')
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
