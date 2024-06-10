@extends('backend.syndic.syndic_dashboard')

@section('syndic')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('syndic.all.cotisation') }}" class="btn btn-inverse-primary">Retour à la liste des cotisations</a></li>
        </ol>
    </nav>

    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une Cotisation</h6>
                        <form method="POST" action="{{ route('syndic.store.cotisation') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="montant">Montant</label>
                                <input type="number" class="form-control" id="montant" name="montant" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_cotisation">Date de la cotisation</label>
                                <input type="date" class="form-control" id="date_cotisation" name="date_cotisation" required>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="appartement_id">Appartement</label>
                                <select class="form-control" id="appartement_id" name="appartement_id" required>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}">{{ $appartement->nom_appartement }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="member_coproprietaire_id">Copropriétaire</label>
                                <select class="form-control" id="member_coproprietaire_id" name="member_coproprietaire_id" required>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}">{{ $coproprietaire->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="member_syndic_id">Syndic</label>
                                <select class="form-control" id="member_syndic_id" name="member_syndic_id" required>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}">{{ $syndic->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="immeuble_id">Immeuble</label>
                                <input type="text" class="form-control" id="immeuble_id" name="immeuble_id" value="{{ $immeuble->nom_immeuble }}" disabled>
                                <input type="hidden" name="immeuble_id" value="{{ $immeuble->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="residence_id">Résidence</label>
                                <input type="text" class="form-control" id="residence_id" name="residence_id" value="{{ $residence->nom_residence }}" disabled>
                                <input type="hidden" name="residence_id" value="{{ $residence->id }}">
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
