@extends('layouts.backend.main')

@section('content')
@php
$locale = config('app.locale');
@endphp


<div class="col-sm-12">
    <form class="row g-3 needs-validation custom-input" method="POST" action="{{route('settings.update',$edit_setting->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>{{__('message.Header Section')}}</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 position-relative">
                    <strong>Header Logo</strong>
                    <input class="form-control" id="validationTooltip01" type="file" name="header_logo">
                    <img src="{{url('images' .'/'. $edit_setting->header_logo)}}" height="100px" width="100px">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Footer Section</h4>
            </div>
            <div class="card-body">

                <div class="col-md-12 position-relative">
                    <strong>Footer Logo</strong>
                    <input class="form-control" id="validationTooltip01" type="file" name="footer_logo">
                    <img src="{{url('images' .'/'. $edit_setting->footer_logo)}}" height="100px" width="100px">
                </div>
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <strong>Footer Title1:(In English)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_title1_en}}" name="footer_title1_en">
                    </div>
                    <div class="col-md-6 position-relative">
                        <strong>Footer Title1:(In French)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_title1_fr}}" name="footer_title1_fr">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 position-relative">
                        <strong>Footer Title2:(In English)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_title2_en}}" name="footer_title2_en">
                    </div>

                    <div class="col-md-6 position-relative">
                        <strong>Footer Title2:(In French)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_title2_fr}}" name="footer_title2_fr">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <strong>Footer content:(In English)</strong>
                        <textarea class="form-control" id="validationTooltip01" type="text" value="" name="footer_content_en">{{$edit_setting->footer_content_en}}</textarea>
                    </div>

                    <div class="col-md-6 position-relative">
                        <strong>Footer content:(In French)</strong>
                        <textarea class="form-control" id="validationTooltip01" type="text" value="" name="footer_content_fr">{{$edit_setting->footer_content_fr}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <strong>Footer Address:(In French)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_address_en}}" name="footer_address_en">
                    </div>

                    <div class="col-md-6 position-relative">
                        <strong>Footer Address:(In English)</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_address_fr}}" name="footer_address_fr">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 position-relative">
                        <strong>Footer number1:</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_number1}}" name="footer_number1">
                    </div>

                    <div class="col-md-6 position-relative">
                        <strong>Footer number2:</strong>
                        <input class="form-control" id="validationTooltip01" type="text" value="{{$edit_setting->footer_number2}}" name="footer_number2">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 position-relative">
                        <strong>Footer link1:</strong>
                        <input class="form-control" id="validationTooltip01" type="url" value="{{$edit_setting->footer_number1}}" name="footer_number1">
                    </div>

                    <div class="col-md-6 position-relative">
                        <strong>Footer link2:</strong>
                        <input class="form-control" id="validationTooltip01" type="url" value="{{$edit_setting->footer_number2}}" name="footer_number2">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" style=" display: flex;justify-content: center;">
            <button class="btn btn-primary setting_btn" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection