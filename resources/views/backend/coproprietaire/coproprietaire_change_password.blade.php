@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')
<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@php

$id = Auth::user()-> id;
        $dataProfile = App\Models\User::find($id);

            @endphp

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

                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Change Admin Password</h6>
                        <form method="POST" action="{{route('coproprietaire.update.password')}}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="oldpassword" class="form-label">Old Password</label>
                                <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword" autocomplete="off">
                                @error('oldpassword')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="newpassword" class="form-label">New Password</label>
                                <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword" autocomplete="off">
                                @error('newpassword')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="newpassword_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="newpassword_confirmation" class="form-control" id="newpassword_confirmation" autocomplete="off">

                                @error('newpassword_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>





                            <button type="submit" name="submit" class="btn btn-primary me-2">Save Changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
