@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('all.memberSyndic') }}" class="btn btn-inverse-primary">Retour à la liste des Syndics</a></li>
        </ol>
    </nav>
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Syndic</h6>
                        <form method="POST" action="{{ route('store.memberSyndic') }}" class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="user_id" class="form-label">Utilisateur</label>
                                <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                    <option value="">Sélectionner un utilisateur</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin" value="{{ old('cin') }}">
                                @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
