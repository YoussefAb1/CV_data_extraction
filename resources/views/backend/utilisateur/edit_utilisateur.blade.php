@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Editer un Utilisateur</h6>
                        <form method="POST" action="{{route('update.utilisateur')}}" class="forms-sample">
                            @csrf

                            <input type="hidden" name="id" value="{{$utilisateurs->id}}">

                            <div class="mb-3">
                                <label for="username" class="form-label">Username de l'Utilisateur</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <button type="submit" name="submit" class="btn btn-primary me-2">Enregistrer modifications</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


