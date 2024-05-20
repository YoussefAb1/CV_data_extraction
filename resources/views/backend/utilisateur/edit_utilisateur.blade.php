@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un Utilisateur</h6>
                        <form method="POST" action="{{ route('update.utilisateur', $utilisateur->id) }}" class="forms-sample">
                            @csrf
                            {{-- <input type="hidden" name="_method" value="PUT"> --}}
                            <div class="mb-3">
                                <label for="role">Rôle de l'utilisateur</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin" {{ $utilisateur->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="syndic" {{ $utilisateur->role == 'syndic' ? 'selected' : '' }}>Syndic</option>
                                    <option value="coproprietaire" {{ $utilisateur->role == 'coproprietaire' ? 'selected' : '' }}>Copropriétaire</option>
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom d'Utilisateur</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $utilisateur->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username de l'Utilisateur</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ $utilisateur->username }}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $utilisateur->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status">Statut</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="actif" {{ $utilisateur->status == 'actif' ? 'selected' : '' }}>Actif</option>
                                    <option value="inactif" {{ $utilisateur->status == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                    <option value="En attente" {{ $utilisateur->status == 'En attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="Bloqué" {{ $utilisateur->status == 'Bloqué' ? 'selected' : '' }}>Bloqué</option>
                                    <option value="Supprimé" {{ $utilisateur->status == 'Supprimé' ? 'selected' : '' }}>Supprimé</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Champs spécifiques au rôle de syndic -->
                            <div id="syndic-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin" value="{{ $utilisateur->cin }}">
                                    @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date_affectation" class="form-label">Date d'Affectation</label>
                                    <input type="date" name="date_affectation" class="form-control @error('date_affectation') is-invalid @enderror" id="date_affectation" value="{{ $utilisateur->date_affectation }}">
                                    @error('date_affectation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">Date de Fin</label>
                                    <input type="date" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin" value="{{ $utilisateur->date_fin }}">
                                    @error('date_fin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="immeuble_id" class="form-label">Immeuble</label>
                                    <input type="text" name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id" value="{{ $utilisateur->immeuble_id }}">
                                    @error('immeuble_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champs spécifiques au rôle de copropriétaire -->
                            <div id="coproprietaire-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin" value="{{ $utilisateur->cin }}">
                                    @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type de Copropriétaire</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="promoteur" {{ $utilisateur->type == 'promoteur' ? 'selected' : '' }}>Promoteur</option>
                                        <option value="proprietaire" {{ $utilisateur->type == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                                        <option value="locataire" {{ $utilisateur->type == 'locataire' ? 'selected' : '' }}>Locataire</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary me-2">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var role = document.getElementById('role').value;
        toggleRoleFields(role);
        document.getElementById('role').addEventListener('change', function() {
            toggleRoleFields(this.value);
        });
    });

    function toggleRoleFields(role) {
        document.getElementById('syndic-fields').style.display = role === 'syndic' ? 'block' : 'none';
        document.getElementById('coproprietaire-fields').style.display = role === 'coproprietaire' ? 'block' : 'none';
    }
</script>
@endsection
