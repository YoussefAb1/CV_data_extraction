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
                                <input type="text" name="nom_immeuble" class="form-control @error('nom_immeuble') is-invalid @enderror" id="nom_immeuble">
                                @error('nom_immeuble')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nombre_etages" class="form-label">Nombre d'Étages</label>
                                <input type="text" name="nombre_etages" class="form-control @error('nombre_etages') is-invalid @enderror" id="nombre_etages">
                                @error('nombre_etages')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Nom de la Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id">
                                    <option value="">Sélectionner une résidence</option>
                                    @foreach($residences as $residence)
                                        <option value="{{ $residence->id }}">{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_syndic_id" class="form-label">Syndic</label>
                                <select name="member_syndic_id" class="form-control @error('member_syndic_id') is-invalid @enderror" id="member_syndic_id">
                                    <option value="">Sélectionner un syndic</option>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}">{{ $syndic->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_syndic_id')
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
