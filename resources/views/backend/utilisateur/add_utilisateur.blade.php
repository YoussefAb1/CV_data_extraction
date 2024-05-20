@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Utilisateur</h6>
                        <form method="POST" action="{{ route('store.utilisateur') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom d'Utilisateur</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username de l'Utilisateur</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role">Rôle de l'utilisateur</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="syndic">Syndic</option>
                                    <option value="coproprietaire">Copropriétaire</option>
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="actif">Actif</option>
                                    <option value="inactif">Inactif</option>
                                    <option value="En attente">En attente</option>
                                    <option value="Bloqué">Bloqué</option>
                                    <option value="Supprimé">Supprimé</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Champs spécifiques aux rôles -->
                            <div id="syndic-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin">
                                    @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date_affectation" class="form-label">Date d'Affectation</label>
                                    <input type="date" name="date_affectation" class="form-control @error('date_affectation') is-invalid @enderror" id="date_affectation">
                                    @error('date_affectation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">Date de Fin</label>
                                    <input type="date" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin">
                                    @error('date_fin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="immeuble_id" class="form-label">Immeuble</label>
                                    <input type="text" name="immeuble_id" class="form-control @error('immeuble_id') is-invalid @enderror" id="immeuble_id">
                                    @error('immeuble_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div id="coproprietaire-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin">
                                    @error('cin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type de Copropriétaire</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="promoteur">Promoteur</option>
                                        <option value="proprietaire">Propriétaire</option>
                                        <option value="locataire">Locataire</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary me-2">Valider</button>
                        </form>

                        <script>
                            document.getElementById('role').addEventListener('change', function() {
                                var role = this.value;
                                document.getElementById('syndic-fields').style.display = role === 'syndic' ? 'block' : 'none';
                                document.getElementById('coproprietaire-fields').style.display = role === 'coproprietaire' ? 'block' : 'none';
                            });
                        </script>
                        @endsection

