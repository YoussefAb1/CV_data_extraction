@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Utilisateur</h6>
                        <form method="POST" action="{{route('store.utilisateur')}}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="role">Rôle de l'utilisateur</label>
                                    <select name="role" id="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="syndic">Syndic</option>
                                <option value="coproprietaire">Copropriétaire</option>
                                    </select>
                            </div>
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
                                <label for="name" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div id="admin-fields" style="display: none;">

                            </div>

                            <!-- Champs spécifiques au rôle de syndic -->
                            <div class="mb-3">

                            <div id="syndic-fields" style="display: none;">

                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin">
                                @error('cin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                                <div class="mb-3">

                            <label for="dateaffectation" class="form-label">La Date d'Affectation</label>
                            <input type="date" name="dateaffectation" class="form-control @error('dateaffectation') is-invalid @enderror" id="dateaffectation">
                            @error('dateaffectation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                            <div class="mb-3">

                            <label for="datefin" class="form-label">La Date de Fin</label>
                            <input type="date" name="datefin" class="form-control @error('datefin') is-invalid @enderror" id="datefin">
                            @error('datefin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                            <div class="mb-3">

                            <label for="id_immeuble" class="form-label">Affecté à l'Immeuble</label>
                                <input type="text" name="id_immeuble" class="form-control @error('id_immeuble') is-invalid @enderror" id="id_immeuble">
                                @error('id_immeuble')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            </div>
                            <!-- Champs spécifiques au rôle de copropriétaire -->
                            <div id="coproprietaire-fields" style="display: none;">
                                <!-- Ajoutez ici les champs spécifiques pour les copropriétaires -->
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" id="cin">
                                @error('cin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="type">Choisir le type du Copropriétaire</label>
                                    <select name="type" id="type" class="form-control">
                                <option value="promoteur">Promoteur</option>
                                <option value="proprietaire">Propriétaire</option>
                                <option value="locatire">Locataire</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

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
    document.getElementById('role').addEventListener('change', function() {
        var role = this.value;
        document.getElementById('admin-fields').style.display = role === 'admin' ? 'block' : 'none';
        document.getElementById('syndic-fields').style.display = role === 'syndic' ? 'block' : 'none';
        document.getElementById('coproprietaire-fields').style.display = role === 'coproprietaire' ? 'block' : 'none';
    });
</script>




@endsection


