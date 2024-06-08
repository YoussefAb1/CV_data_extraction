@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Immeuble</h6>
                        <form method="POST" action="{{ route('store.immeuble') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="nom_immeuble" class="form-label">Nom de l'Immeuble</label>
                                <input type="text" name="nom_immeuble" class="form-control @error('nom_immeuble') is-invalid @enderror" id="nom_immeuble" value="{{ old('nom_immeuble') }}">
                                @error('nom_immeuble')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nombre_etages" class="form-label">Nombre d'étages</label>
                                <input type="number" name="nombre_etages" class="form-control @error('nombre_etages') is-invalid @enderror" id="nombre_etages" value="{{ old('nombre_etages') }}">
                                @error('nombre_etages')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Nom de la Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id">
                                    <option value="">Sélectionner une résidence</option>
                                    @foreach ($residences as $residence)
                                        <option value="{{ $residence->id }}">{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
