@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Résidence</h6>
                        <form method="POST" action="{{route('store.residence')}}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_residence" class="form-label">Nom de la Résidence</label>
                                <input type="text" name="nom_residence" class="form-control @error('nom_residence') is-invalid @enderror" id="nom_residence">
                                @error('nom_residence')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="adresse_residence" class="form-label">Adresse de la Résidence </label>
                                <input type="text" name="adresse_residence" class="form-control @error('adresse_residence') is-invalid @enderror" id="adresse_residence">
                                @error('adresse_residence')
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


