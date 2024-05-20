@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier une Cotisation</h6>
                        <form method="POST" action="{{ route('update.cotisation', $cotisation->id) }}" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror" id="montant" value="{{ old('montant', $cotisation->montant) }}">
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_cotisation" class="form-label">Date de Cotisation</label>
                                <input type="date" name="date_cotisation" class="form-control @error('date_cotisation') is-invalid @enderror" id="date_cotisation" value="{{ old('date_cotisation', $cotisation->date_cotisation) }}">
                                @error('date_cotisation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $cotisation->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select name="appartement_id" class="form-control @error('appartement_id') is-invalid @enderror" id="appartement_id">
                                    <option value="">Sélectionner un Appartement</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}" {{ old('appartement_id', $cotisation->appartement_id) == $appartement->id ? 'selected' : '' }}>{{ $appartement->name }}</option>
                                    @endforeach
                                </select>
                                @error('appartement_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_coproprietaire_id" class="form-label">Propriétaire</label>
                                <select name="member_coproprietaire_id" class="form-control @error('member_coproprietaire_id') is-invalid @enderror" id="member_coproprietaire_id">
                                    <option value="">Sélectionner un Propriétaire</option>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}" {{ old('member_coproprietaire_id', $cotisation->member_coproprietaire_id) == $coproprietaire->id ? 'selected' : '' }}>{{ $coproprietaire->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_coproprietaire_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="member_syndic_id" class="form-label">Syndic</label>
                                <select name="member_syndic_id" class="form-control @error('member_syndic_id') is-invalid @enderror" id="member_syndic_id">
                                    <option value="">Sélectionner un Syndic</option>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}" {{ old('member_syndic_id', $cotisation->member_syndic_id) == $syndic->id ? 'selected' : '' }}>{{ $syndic->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_syndic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
