@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter un Rôle</h6>
                        <form method="POST" action="{{ route('store.role') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Rôle</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefault" onClick="toggle(this)">
                                <label class="form-check-label" for="checkDefault">Sélectionner Tout</label>
                            </div>

                            <hr>

                            @foreach ($permission_groups as $group)
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input group-checkbox" id="group{{ $loop->index }}" onClick="toggleGroup({{ $loop->index }})">
                                        <label class="form-check-label" for="group{{ $loop->index }}">{{ $group->group_name }}</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @foreach ($permissions->where('group_name', $group->group_name) as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input permission-checkbox group{{ $loop->parent->index }}" name="permissions[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                        <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <button type="submit" name="submit" class="btn btn-primary me-2">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggle(source) {
        checkboxes = document.querySelectorAll('.form-check-input');
        for(var i = 0; i < checkboxes.length; i++) {
            if(checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    function toggleGroup(index) {
        checkboxes = document.querySelectorAll('.group' + index);
        for(var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = document.getElementById('group' + index).checked;
        }
    }
</script>
@endsection
