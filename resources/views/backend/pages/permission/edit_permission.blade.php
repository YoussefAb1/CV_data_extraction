@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Editer une Permission</h6>
                        <form method="POST" action="{{route('update.permission')}}" class="forms-sample">
                            @csrf

                            <input type="hidden" name="id" value="{{$permissions->id}}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la Permission</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$permissions->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="group_name" class="form-label">Nom du Groupe</label>
                                <select name="group_name" class="form-control @error('group_name') is-invalid @enderror" id="groupe_name">

                                    <option selected="" disabled="">Sélectionner un groupe</option>
                                    <option value="residence">Residence</option>
                                    <option value="immeuble">Immeuble</option>
                                    <option value="appartement">Appartement</option>
                                    <option value="cotisation">Cotisation</option>
                                    <option value="depense">Depense</option>
                                    <option value="charge">Charge</option>
                                    <option value="facture">Facture</option>

                                </select>
                                @error('group_name')
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


