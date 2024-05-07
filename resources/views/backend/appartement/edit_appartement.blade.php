@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Editer un Appartement</h6>
                        <form method="POST" action="{{route('update.appartement')}}" class="forms-sample">
                            @csrf

                            <input type="hidden" name="id" value="{{$appartements->id}}">

                            <div class="mb-3">
                                <label for="nom_appartement" class="form-label">Nom de l'Appartement</label>
                                <input type="text" name="nom_appartement" class="form-control @error('nom_appartement') is-invalid @enderror" id="nom_appartement" value="{{$appartements->nom_appartement}}">
                                @error('nom_appartement')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="etage" class="form-label">Etage </label>
                                <input type="text" name="etage" class="form-control @error('etage') is-invalid @enderror" id="etage" value="{{$appartements->etage}}">
                                @error('etage')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="surface" class="form-label">Surface </label>
                                <input type="text" name="surface" class="form-control @error('surface') is-invalid @enderror" id="surface" value="{{$appartements->surface}}">
                                @error('surface')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_immeuble" class="form-label">Sélectionner l'Immeuble</label>
                                <select name="id_immeuble" class="form-control @error('id_immeuble') is-invalid @enderror">
                                    <option value="">Sélectionner un immeuble</option>
                                    @foreach ($immeubles as $immeuble)
                                        <option value="{{ $immeuble->id }}" {{ $immeuble->id == $appartements->id_immeuble ? 'selected' : '' }}>{{ $immeuble->nom_immeuble }}</option>
                                    @endforeach
                                </select>
                                @error('id_immeuble')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_residence" class="form-label">Sélectionner la Résidence</label>
                                <select name="id_residence" class="form-control @error('id_residence') is-invalid @enderror">
                                    <option value="">Sélectionner une résidence</option>
                                    @foreach ($residences as $residence)
                                        <option value="{{ $residence->id }}" {{ $residence->id == $appartements->id_residence ? 'selected' : '' }}>{{ $residence->nom_residence }}</option>
                                    @endforeach
                                </select>
                                @error('id_residence')
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


