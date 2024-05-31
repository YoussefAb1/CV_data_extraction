@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Cotisation</h6>
                        <form method="POST" action="{{ route('store.cotisation') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="montant">Montant</label>
                                <input type="number" name="montant" id="montant" class="form-control" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_cotisation">Date de Cotisation</label>
                                <input type="date" name="date_cotisation" id="date_cotisation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="appartement_id">Nom de l'Appartement</label>
                                <select name="appartement_id" id="appartement_id" class="form-control" required>
                                    @foreach ($appartements as $appartement)
                                        <option value="{{ $appartement->id }}">{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="member_coproprietaire_id">Nom du Copropriétaire</label>
                                <select name="member_coproprietaire_id" id="member_coproprietaire_id" class="form-control" required>
                                    @foreach ($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}">{{ $coproprietaire->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="member_syndic_id">Nom du Syndic</label>
                                <select name="member_syndic_id" id="member_syndic_id" class="form-control" required>
                                    @foreach ($syndics as $syndic)
                                        <option value="{{ $syndic->id }}">{{ $syndic->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
