@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Paiment</h6>
                        <form method="POST" action="{{ route('store.paiement') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror" id="montant">
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_paiement" class="form-label">Date Paiement</label>
                                <input type="text" name="date_paiement" class="form-control @error('date_paiement') is-invalid @enderror" id="date_paiement">
                                @error('date_paiement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="mode_paiement" class="form-label">Mode de Paiement</label>
                                <select name="mode_paiement" class="form-control @error('mode_paiement') is-invalid @enderror">
                                    <option value="">Sélectionner le Mode de Paiement</option>
                                    @foreach (['Especes', 'Virement bancaire', 'Cheque'] as $mode_paiement)
                                        <option value="{{ $mode_paiement }}">{{ $mode_paiement }}</option>
                                    @endforeach
                                </select>
                                @error('mode_paiement')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_facture" class="form-label">Numéro de la Facture</label>
                                <select name="id_facture" class="form-control @error('id_facture') is-invalid @enderror" id="id_facture">
                                    <option value="">Sélectionner une facture</option>
                                    @foreach($paiements as $paiement)
                                        <option value="{{ $paiement->id }}">{{ $paiement->numero_facture }}</option>
                                    @endforeach
                                </select>
                                @error('id_facture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary me-2">Valider</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


