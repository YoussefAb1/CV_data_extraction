@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Editer une Permission</h6>
                        <form method="POST" action="{{ route('update.permission') }}" class="forms-sample">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permissions->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la Permission</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $permissions->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="group_name" class="form-label">Nom du Groupe</label>
                                <select name="group_name" class="form-control @error('group_name') is-invalid @enderror" id="group_name">
                                    <option disabled="">Sélectionner un groupe</option>
                                    <option value="residence" {{ $permissions->group_name == 'residence' ? 'selected' : '' }}>Residence</option>
                                    <option value="immeuble" {{ $permissions->group_name == 'immeuble' ? 'selected' : '' }}>Immeuble</option>
                                    <option value="appartement" {{ $permissions->group_name == 'appartement' ? 'selected' : '' }}>Appartement</option>
                                    <option value="charge" {{ $permissions->group_name == 'charge' ? 'selected' : '' }}>Charge</option>
                                    <option value="cotisation" {{ $permissions->group_name == 'cotisation' ? 'selected' : '' }}>Cotisation</option>
                                    <option value="depense" {{ $permissions->group_name == 'depense' ? 'selected' : '' }}>Dépense</option>
                                    <option value="facture" {{ $permissions->group_name == 'facture' ? 'selected' : '' }}>Facture</option>
                                    <option value="role" {{ $permissions->group_name == 'role' ? 'selected' : '' }}>Role</option>
                                </select>
                                @error('group_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="roles" class="form-label">Rôles Associés</label>
                                <select name="roles[]" class="form-control @error('roles') is-invalid @enderror" id="roles" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id, $permissionRoles) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
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
