@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6>Ajouter un Syndic à l'Immeuble {{ $immeuble->nom_immeuble }}</h6>
                        <br>
                        <form action="{{ route('store.syndic_to_immeuble', $immeuble->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="member_syndic_id">Sélectionner un Syndic</label>
                                <select class="form-control" id="member_syndic_id" name="member_syndic_id" required>
                                    @foreach($syndics as $syndic)
                                        <option value="{{ $syndic->id }}">{{ $syndic->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="start_date">Date de début</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>

                           
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
