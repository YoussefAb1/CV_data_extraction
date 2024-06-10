@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('syndic.all.memberCoproprietaire') }}" class="btn btn-inverse-primary">Retour</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Modifier un Copropriétaire</h6>
                    <form action="{{ route('syndic.update.memberCoproprietaire', $coproprietaire->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Utilisateur</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $coproprietaire->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cin">CIN</label>
                            <input type="text" name="cin" id="cin" class="form-control" value="{{ $coproprietaire->cin }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $coproprietaire->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="promoteur" {{ $coproprietaire->type == 'promoteur' ? 'selected' : '' }}>Promoteur</option>
                                <option value="proprietaire" {{ $coproprietaire->type == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                                <option value="locataire" {{ $coproprietaire->type == 'locataire' ? 'selected' : '' }}>Locataire</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="immeuble_id">Immeuble</label>
                            <input type="text" id="immeuble_id" class="form-control" value="{{ $immeuble_id }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="residence_id">Résidence</label>
                            <input type="text" id="residence_id" class="form-control" value="{{ $residence_id }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
