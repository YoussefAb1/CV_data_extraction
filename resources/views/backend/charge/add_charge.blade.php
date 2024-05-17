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
                                <label for="date" class="form-label">Date </label>
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
                                <label for="type" class="form-label">Type</label>
                                <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="statut" class="form-label">Statut</label>
                                <select name="statut" class="form-control @error('statut') is-invalid @enderror">
                                    <option value="">Sélectionner le statut de la Charge</option>
                                    @foreach (['Payée', 'Partiellement payée', 'En attente de paiement', 'En retard'] as $statut)
                                        <option value="{{ $statut }}">{{ $statut }}</option>
                                    @endforeach
                                </select>
                                @error('statut')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="id_appartement" class="form-label">Nom de l'Appartement</label>
                                <select name="id_appartement" class="form-control @error('id_appartement') is-invalid @enderror" id="id_appartement">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}">{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                                @error('id_appartement')
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
