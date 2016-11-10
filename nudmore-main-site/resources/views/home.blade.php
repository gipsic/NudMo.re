@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>

                    @if ($current_user->isPatient())
                    <div>
                    <h4>Patient menu</h4>
                        <p><a href="/profile">Profile</a></p>
                        <p><a href="/appointment/patient">Appointment List</a></p>
                        <p><a href="/record/patient">Record History</a></p>
                        <p><a href="/prescription/patient">Prescription History</a></p>
                    </div>
                    @endif
                    @if ($current_user->isAdministrator())
                    <div>
                    <h4>Administrator menu</h4>
                        <p><a href="/profile/list">User List</a></p>
                        <p><a href="/schedule/staff">Schedule List</a></p>
                        <p><a href="/appointment/staff">Appointment List</a></p>
                        <p><a href="/record/staff">Record History</a></p>
                        <p><a href="/medicine">Medicine List</a></p>
                        <p><a href="/prescription">Prescription History</a></p>
                    </div>
                    @endif
                    @if ($current_user->isStaff())
                    <div>
                    <h4>Staff menu</h4>
                        <p><a href="/profile/list">User List</a></p>
                        <p><a href="/schedule/staff">Schedule List</a></p>
                        <p><a href="/appointment/staff">Appointment List</a></p>
                        <p><a href="/record/staff">Record History</a></p>
                        <p><a href="/prescription">Prescription History</a></p>
                    </div>
                    @endif
                    @if ($current_user->isDoctor())
                    <div>
                    <h4>Doctor menu</h4>
                        <p><a href="/profile/list">User List</a></p>
                        <p><a href="/schedule/doctor">Schedule List</a></p>
                        <p><a href="/appointment/doctor">Appointment List</a></p>
                        <p><a href="/record/staff">Record History</a></p>
                        <p><a href="/prescription/doctor">Prescription History</a></p>
                    </div>
                    @endif
                    @if ($current_user->isNurse())
                    <div>
                    <h4>Nurse menu</h4>
                        <p><a href="/profile/list">User List</a></p>
                        <p><a href="/record/staff">Record History</a></p>
                        <p><a href="/prescription">Prescription History</a></p>
                    </div>
                    @endif
                    @if ($current_user->isPharmacist())
                    <div>
                    <h4>Pharmacist menu</h4>
                        <p><a href="/profile/list">User List</a></p>
                        <p><a href="/record/staff">Record History</a></p>
                        <p><a href="/medicine">Medicine List</a></p>
                        <p><a href="/prescription">Prescription History</a></p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
