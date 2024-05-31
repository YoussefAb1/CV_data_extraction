@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Charge</h6>
                        <form method="POST" action="{{ route('store.charge') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="designation" class="form-label">Désignation</label>
                                <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" id="designation">
                                @error('designation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror" id="montant">
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="appartement_id" class="form-label">Nom de l'Appartement</label>
                                <select name="appartement_id" class="form-control @error('appartement_id') is-invalid @enderror" id="appartement_id">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}">{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="immeuble_id" class="form-label">Nom de l'Immeuble</label>
                                <select name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id">
                                    <option value="">Sélectionner un Immeuble</option>
                                    @foreach($immeubles as $immeuble)
                                        <option value="{{ $immeuble->id }}">{{ $immeuble->nom_immeuble }}</option>
                                    @endforeach
                                </select>
                                @error('immeuble_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Nom de la Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id">
                                    <option value="">Sélectionner une Résidence</option>
                                    @foreach($residences as $residence)
                                        <option value="{{ $residence->id }}">{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="statut" class="form-label">Statut</label>
                                <select name="statut" class="form-control @error('statut') is-invalid @enderror" id="statut">
                                    <option value="">Sélectionner un Statut</option>
                                    <option value="Payée">Payée</option>
                                    <option value="Partiellement Payée">Partiellement Payée</option>
                                    <option value="En Attente de Paiement">En Attente de Paiement</option>
                                    <option value="En Retard">En Retard</option>
                                </select>
                                @error('statut')
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
