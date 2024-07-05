@extends('layouts.backend.main')

@section('content')
@php
$locale = config('app.locale');
@endphp
<div class="container-fluhjhjid">
    <div class="page-title">
        <!-- <div class="row">
            <div class="col-6">
                <h4>Change password</h4>
            </div>
            <div class="col-6">
                <div class="list-product-header">
                    <a id="AddUserModal" class="btn btn-primary" data-ajax-popup="false" href="javascript:void(0);" data-url="{{route('users.create')}}"><i class="fa fa-plus"></i>Add User</a>
                </div>
            </div>
        </div> -->
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Change Password</h4>

                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" action="{{route('postChangePassword')}}" method="post" novalidate="">
                        @csrf
                        <div class="col-md-4 position-relative">
                            <strong >Current password</strong>
                            <input type="password" class="form-control" id="current_password" name="password">
                        </div>

                        <div class="col-md-4 position-relative">
                        <strong>New Password</strong>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="col-md-4 position-relative">
                        <strong>Confirm New Password</strong>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection