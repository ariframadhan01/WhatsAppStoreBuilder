@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection

@php
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
@endphp


@push('script-page')
    <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/tinymce.min.js') }}" referrerpolicy="origin">
    </script>

    <script>
        tinymce.init({
            selector: '#mytextarea',
            menubar: '',
        });
    </script>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection
@section('action-btn')
<ul class="nav nav-pills cust-nav   rounded  mb-3" id="pills-tab" role="tablist">
    @include('landingpage::layouts.tab')
</ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                    {{--  Start for all settings tab --}}
                    {{ Form::model(null, ['route' => ['landingpage.store'], 'method' => 'POST']) }}
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="mb-2">{{ __('Top Bar') }}</h5>
                                </div>
                                <div class="col switch-width text-end">
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary"
                                                class="" name="topbar_status" id="topbar_status"
                                                {{ $settings['topbar_status'] == 'on' ? 'checked="checked"' : '' }}>
                                            <label class="custom-control-label" for="topbar_status"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-12">
                                    {{ Form::label('content', __('Message'), ['class' => 'col-form-label text-dark']) }}
                                    {{ Form::textarea('topbar_notification_msg', $settings['topbar_notification_msg'], ['class' => 'summernote-simple form-control', 'required' => 'required', 'id' => 'mytextarea']) }}
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                value="{{ __('Save Changes') }}">
                        </div>
                    </div>
                    {{ Form::close() }}

                    {{--  End for all settings tab --}}
                </div>
            </div>
    </div>
@endsection
