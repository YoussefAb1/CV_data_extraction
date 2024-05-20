@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Éditer un Immeuble</h6>
                        <form method="POST" action="{{ route('update.immeuble') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $immeuble->id }}">

                            <div class="mb-3">
                                <label for="nom_immeuble" class="form-label">Nom de l'Immeuble</label>
                                <input type="text" name="nom_immeuble" class="form-control @error('nom_immeuble') is-invalid @enderror" id="nom_immeuble" value="{{ $immeuble->nom_immeuble }}">
                                @error('nom_immeuble')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nombre_etages" class="form-label">Nombre d'Étages</label>
                                <input type="text" name="nombre_etages" class="form-control @error('nombre_etages') is-invalid @enderror" id="nombre_etages" value="{{ $immeuble->nombre_etages }}">
                                @error('nombre_etages')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Nom de la Résidence</label>
                                <select name="residence_id" class="form-control @error('residence_id') is-invalid @enderror" id="residence_id">
                                    @foreach ($residences as $residence)
                                        <option value="{{ $residence->id }}" {{ $immeuble->residence_id == $residence->id ? 'selected' : '' }}>
                                            {{ $residence->nom_residence }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_syndic_id" class="form-label">Syndic</label>
                                <select name="member_syndic_id" class="form-control @error('member_syndic_id') is-invalid @enderror" id="member_syndic_id">
                                    @foreach ($syndics as $syndic)
                                        <option value="{{ $syndic->id }}" {{ $immeuble->member_syndic_id == $syndic->id ? 'selected' : '' }}>
                                            {{ $syndic->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('member_syndic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary me-2">Enregistrer modifications</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
