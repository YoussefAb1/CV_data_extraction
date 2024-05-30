@extends('admin.admin_dashboard')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Modifier le copropriétaire</h2>
                <form action="{{ route('update.memberCoproprietaire', $coproprietaire->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Utilisateur</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $coproprietaire->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cin">CIN</label>
                        <input type="text" name="cin" id="cin" class="form-control" value="{{ $coproprietaire->cin }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $coproprietaire->name }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="promoteur" {{ $coproprietaire->type == 'promoteur' ? 'selected' : '' }}>Promoteur</option>
                            <option value="proprietaire" {{ $coproprietaire->type == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                            <option value="locataire" {{ $coproprietaire->type == 'locataire' ? 'selected' : '' }}>Locataire</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
