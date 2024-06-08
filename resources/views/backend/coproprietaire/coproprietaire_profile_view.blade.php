@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')
<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        {{-- PROFILE PHOTO --}}
                        <div>
                            <img class="wd-100 rounded-circle" src="{{ (!empty($dataProfile->photo)) ? url('upload/admin_images/'.$dataProfile->photo) : url('upload/no_image.jpg') }}" alt="profile">
                            <span class="h4 ms-3">{{$dataProfile->username}}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name :</label>
                        <p class="text-muted">{{$dataProfile->name}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email :</label>
                        <p class="text-muted">{{$dataProfile->email}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone :</label>
                        <p class="text-muted">{{$dataProfile->phone}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">{{$dataProfile->address}}</p>
                    </div>
                    <div class="mt-3 d-flex social-links">
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="github"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Update Admin Profile</h6>
                        <form method="POST" action="{{route('coproprietaire.profile.store')}}" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username" autocomplete="off" value="{{$dataProfile->username}}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{$dataProfile->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" autocomplete="off" value="{{$dataProfile->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" autocomplete="off" value="{{$dataProfile->phone}}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address" autocomplete="off" value="{{$dataProfile->address}}">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" name="photo" class="form-control" id="photo" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"></label>
                                <img id="showimage" class="wd-100 rounded-circle" src="{{ (!empty($dataProfile->photo)) ? url('upload/admin_images/'.$dataProfile->photo) : url('upload/no_image.jpg') }}" alt="profile">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary me-2">Save Changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#photo').on('change', function(e){
            $('#showimage').attr('src', URL.createObjectURL(e.target.files[0]));
        });
    });
</script>

@endsection
