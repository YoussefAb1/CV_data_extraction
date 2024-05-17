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
                                <label for="numero_facture" class="form-label">Numéro de la Facture</label>
                                <input type="text" name="numero_facture" class="form-control @error('numero_facture') is-invalid @enderror" id="numero_facture">
                                @error('numero_facture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_emission" class="form-label">Date d'Emission</label>
                                <input type="date" name="date_emission" class="form-control @error('date_emission') is-invalid @enderror" id="date_emission">
                                @error('date_emission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_echeance" class="form-label">Date d'Echéance</label>
                                <input type="date" name="date_echeance" class="form-control @error('date_echeance') is-invalid @enderror" id="date_echeance">
                                @error('date_echeance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="montant_total" class="form-label">Montant Total</label>
                                <input type="text" name="montant_total" class="form-control @error('montant_total') is-invalid @enderror" id="montant_total">
                                @error('montant_total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_appartement" class="form-label">Nom de l'Appartement</label>
                                <select name="id_appartement" class="form-control @error('id_appartement') is-invalid @enderror">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach ($appartements as $appartement)
                                        <option value="{{ $appartement->id }}" @if(old('id_appartement') == $appartement->id) selected @endif>{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                                @error('id_appartement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_charge" class="form-label">Charge</label>
                                <select name="id_charge" class="form-control @error('id_charge') is-invalid @enderror">
                                    <option value="">Sélectionner la Charge</option>
                                    @foreach ($charges as $charge)
                                        <option value="{{ $charge->id }}">{{ $charge->designation }}</option>
                                    @endforeach
                                </select>
                                @error('id_charge')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="etat" class="form-label">Etat de Facture</label>
                                <select name="etat" class="form-control @error('etat') is-invalid @enderror">
                                    <option value="">Sélectionner l'état de Facture</option>
                                    @foreach (['Payée', 'Partiellement payée', 'En attente de paiement', 'Annulée'] as $etat)
                                        <option value="{{ $etat }}">{{ $etat }}</option>
                                    @endforeach
                                </select>
                                @error('etat')
                                    <div class="text-danger">{{ $message }}</div>
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
