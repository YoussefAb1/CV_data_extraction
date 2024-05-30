@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Syndic</h6>
                        <form action="{{ route('update.memberSyndic', $syndic->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $syndic->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" class="form-control @error('cin') is-invalid @enderror" id="cin" name="cin" value="{{ $syndic->cin }}" required>
                                @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="immeuble_id" class="form-label">Immeuble</label>
                                <select class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id" name="immeuble_id" required>
                                    <option value="">Sélectionner un immeuble</option>
                                    @foreach($immeubles as $immeuble)
                                        <option value="{{ $immeuble->id }}" {{ $syndic->histories->last()->immeuble_id == $immeuble->id ? 'selected' : '' }}>{{ $immeuble->name }}</option>
                                    @endforeach
                                </select>
                                @error('immeuble_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Date de début</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ $syndic->histories->last()->start_date }}" required>
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Date de fin</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ $syndic->histories->last()->end_date }}">
                                @error('end_date')
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
