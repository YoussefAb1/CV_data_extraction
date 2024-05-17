@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="row profile-body">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Editer un Role</h6>
                        <form method="POST" action="{{route('update.role')}}" class="forms-sample">
                            @csrf

                            <input type="hidden" name="id" value="{{$roles->id}}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Role</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$roles->name}}">
                                @error('name')
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


