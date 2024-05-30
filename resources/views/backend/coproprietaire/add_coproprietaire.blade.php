@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Copropriétaire</h6>
                        <form method="POST" action="{{ route('store.memberCoproprietaire') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id">Utilisateur</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cin">CIN</label>
                        <input type="text" name="cin" id="cin" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="promoteur">Promoteur</option>
                            <option value="proprietaire">Propriétaire</option>
                            <option value="locataire">Locataire</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
