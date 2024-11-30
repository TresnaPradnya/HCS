@extends('layouts.index')
@section('title')
    <strong>
        Profile
    </strong>
@endsection


@section('content')
    <div class="col-12">
        <div class="card card-danger card-outline">
            <div class="card-body box-profile">


                <h3 class="profile-username text-center"><strong>{{ $profile->name }}</strong></h3>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username</b> <a class="float-right">{{ $profile->username }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $profile->email}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Phone</b> <a class="float-right">{{ $profile->phone}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Commuting Method</b> <a class="float-right">{{ $profile->userDetail->commutingMethod->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Energy Source</b> <a class="float-right">{{ $profile->userDetail->energySource->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Dietary Preference</b> <a class="float-right">{{ $profile->userDetail->dietaryPreference->name }}</a>
                    </li>
                </ul>


                <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-danger btn-block"><b>Edit</b></a>
            </div>
        </div>

    </div>
@endsection
