@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier une Facture</h6>
                        <form action="{{ route('syndic.update.facture', $facture->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="numero_facture" class="form-label">Numéro de Facture</label>
                                <input type="text" class="form-control @error('numero_facture') is-invalid @enderror" id="numero_facture" name="numero_facture" value="{{ $facture->numero_facture }}" required>
                                @error('numero_facture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_emission" class="form-label">Date d'Émission</label>
                                <input type="date" class="form-control @error('date_emission') is-invalid @enderror" id="date_emission" name="date_emission" value="{{ $facture->date_emission }}" required>
                                @error('date_emission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_echeance" class="form-label">Date d'Échéance</label>
                                <input type="date" class="form-control @error('date_echeance') is-invalid @enderror" id="date_echeance" name="date_echeance" value="{{ $facture->date_echeance }}" required>
                                @error('date_echeance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="montant_total" class="form-label">Montant Total</label>
                                <input type="number" step="0.01" class="form-control @error('montant_total') is-invalid @enderror" id="montant_total" name="montant_total" value="{{ $facture->montant_total }}" required>
                                @error('montant_total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $facture->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="paiement_id" class="form-label">Paiement</label>
                                <select class="form-control @error('paiement_id') is-invalid @enderror" id="paiement_id" name="paiement_id" required>
                                    @foreach($paiements as $paiement)
                                        <option value="{{ $paiement->id }}" @if($facture->paiement_id == $paiement->id) selected @endif>{{ $paiement->id }} - {{ $paiement->montant }}</option>
                                    @endforeach
                                </select>
                                @error('paiement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

