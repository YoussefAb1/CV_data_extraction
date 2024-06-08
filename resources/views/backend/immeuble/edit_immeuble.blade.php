@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Immeuble</h6>
                        <form action="{{ route('update.immeuble', $immeuble->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            
                            <div class="mb-3">
                                <label for="nom_immeuble" class="form-label">Nom de l'Immeuble</label>
                                <input type="text" class="form-control @error('nom_immeuble') is-invalid @enderror" id="nom_immeuble" name="nom_immeuble" value="{{ $immeuble->nom_immeuble }}" required>
                                @error('nom_immeuble')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nombre_etages" class="form-label">Nombre d'étages</label>
                                <input type="number" class="form-control @error('nombre_etages') is-invalid @enderror" id="nombre_etages" name="nombre_etages" value="{{ $immeuble->nombre_etages }}" required>
                                @error('nombre_etages')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="residence_id" class="form-label">Résidence</label>
                                <select class="form-control @error('residence_id') is-invalid @enderror" id="residence_id" name="residence_id" required>
                                    @foreach($residences as $residence)
                                        <option value="{{ $residence->id }}" {{ $immeuble->residence_id == $residence->id ? 'selected' : '' }}>{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('residence_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_syndic_id" class="form-label">Syndic</label>
                                <select class="form-control @error('member_syndic_id') is-invalid @enderror" id="member_syndic_id" name="member_syndic_id">
                                    <option value="">Sélectionner un syndic</option>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}" {{ optional($immeuble->currentSyndic)->syndic_id == $syndic->id ? 'selected' : '' }}>{{ $syndic->user->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_syndic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
