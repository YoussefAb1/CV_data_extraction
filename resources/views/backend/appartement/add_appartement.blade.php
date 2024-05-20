@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Appartement</h6>
                        <form method="POST" action="{{ route('store.appartement') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="nom_appartement" class="form-label">Nom de l'Appartement</label>
                                <input type="text" name="nom_appartement" class="form-control @error('nom_appartement') is-invalid @enderror" id="nom_appartement">
                                @error('nom_appartement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="etage" class="form-label">Etage</label>
                                <input type="text" name="etage" class="form-control @error('etage') is-invalid @enderror" id="etage">
                                @error('etage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="surface" class="form-label">Surface</label>
                                <input type="text" name="surface" class="form-control @error('surface') is-invalid @enderror" id="surface">
                                @error('surface')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="immeuble_id" class="form-label">Nom de l'Immeuble</label>
                                <select name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror">
                                    <option value="">Sélectionner un immeuble</option>
                                    @foreach ($immeubles as $immeuble)
                                        <option value="{{ $immeuble->id }}">{{ $immeuble->nom_immeuble }}</option>
                                    @endforeach
                                </select>
                                @error('immeuble_id')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Nom de la Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror">
                                    <option value="">Sélectionner une résidence</option>
                                    @foreach ($residences as $residence)
                                        <option value="{{ $residence->id }}">{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_coproprietaire_id" class="form-label">Copropriétaire</label>
                                <select name="member_coproprietaire_id" class="form-control @error('member_coproprietaire_id') is-invalid @enderror">
                                    <option value="">Sélectionner un copropriétaire</option>
                                    @foreach ($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}">{{ $coproprietaire->nom }}</option>
                                    @endforeach
                                </select>
                                @error('member_coproprietaire_id')
                                    <div class="text-danger">{{ $message }}</div>
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


