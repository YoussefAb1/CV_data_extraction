@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Copropriétaire</h6>
                        <form action="{{ route('update.memberCoproprietaire', $coproprietaire->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Utilisateur</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                    <option value="">Sélectionner un utilisateur</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $coproprietaire->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" class="form-control @error('cin') is-invalid @enderror" id="cin" name="cin" value="{{ $coproprietaire->cin }}" required>
                                @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $coproprietaire->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="promoteur" {{ $coproprietaire->type == 'promoteur' ? 'selected' : '' }}>Promoteur</option>
                                    <option value="proprietaire" {{ $coproprietaire->type == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                                    <option value="locataire" {{ $coproprietaire->type == 'locataire' ? 'selected' : '' }}>Locataire</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
