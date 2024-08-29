@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier une Facture</h6>
                        <form method="POST" action="{{ route('update.facture', $facture->id) }}" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="numero_facture" class="form-label">Numéro de Facture</label>
                                <input type="text" name="numero_facture" class="form-control @error('numero_facture') is-invalid @enderror" id="numero_facture" value="{{ $facture->numero_facture }}">
                                @error('numero_facture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_emission" class="form-label">Date d'Émission</label>
                                <input type="date" name="date_emission" class="form-control @error('date_emission') is-invalid @enderror" id="date_emission" value="{{ $facture->date_emission }}">
                                @error('date_emission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_echeance" class="form-label">Date d'Échéance</label>
                                <input type="date" name="date_echeance" class="form-control @error('date_echeance') is-invalid @enderror" id="date_echeance" value="{{ $facture->date_echeance }}">
                                @error('date_echeance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="montant_total" class="form-label">Montant Total</label>
                                <input type="text" name="montant_total" class="form-control @error('montant_total') is-invalid @enderror" id="montant_total" value="{{ $facture->montant_total }}">
                                @error('montant_total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ $facture->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="paiement_id" class="form-label">Paiement</label>
                                <select name="paiement_id" class="form-control @error('paiement_id') is-invalid @enderror" id="paiement_id">
                                    @foreach($paiements as $paiement)
                                        <option value="{{ $paiement->id }}" {{ $paiement->id == $facture->paiement_id ? 'selected' : '' }}>{{ $paiement->id }} - {{ $paiement->montant }}</option>
                                    @endforeach
                                </select>
                                @error('paiement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
                            <a href="{{ route('all.facture') }}" class="btn btn-light">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
