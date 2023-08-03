@php
    $setting = App\Models\Utility::settings();
@endphp
{{ Form::open(['url' => 'store-resource', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6 text-end">
            @if ($setting['enable_chatgpt'] == 'on')
                <a class="btn btn-sm btn-primary" href="#" data-size="lg" data-ajax-popup-over="true"
                    data-url="{{ route('generate', ['store']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ __('Generate') }}" data-title="{{ __('Generate With AI') }}">
                    <i class="fas fa-robot"></i>
                    {{ __('Generate With AI') }}
                </a>
            @endif
        </div>
        <div class="col-12">
            <div class="form-group">
                <h6>{{ __('Store Name') }}</h6>
                {{ Form::text('store_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Store Name'), 'required' => 'required']) }}
            </div>
        </div>
        @if (\Auth::user()->type == 'super admin')
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('email', __('Email'), ['class' => 'col-form-label']) }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email'), 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('password', __('Password'), ['class' => 'col-form-label']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password'), 'required' => 'required']) }}
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex mb-3 align-items-center justify-content-between">
        <h6>{{ __('Theme Settings') }}</h6>
        {{ Form::hidden('themefile', null, ['id' => 'themefile']) }}
        <input type="hidden" id='themefile'>
        {{-- <button type="submit" class="btn  btn-primary"> <i data-feather="check-circle" class="me-2"></i>
            {{ __('Save changes') }}</button> --}}
    </div>
    <div class="border border-primary rounded p-3">
        <div class="row gy-4 ">
            @foreach (\App\Models\Utility::themeOne() as $key => $v)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="theme-card selected border-primary">
                        <div class="theme-card-inner">
                            <div class="theme-image border  rounded">
                                <img src="{{ asset(Storage::url('uploads/store_theme/' . $key . '/Home.png')) }}"
                                    class="color1 img-center pro_max_width pro_max_height {{ $key }}_img"
                                    data-id="{{ $key }}" alt="">
                            </div>
                            <div class="theme-content mt-3">
                                <div class="d-flex mt-2 align-items-center" id="{{ $key }}">
                                    <div class="color-inputs">
                                        @foreach ($v as $css => $val)
                                            <label class="colorinput">
                                                <input name="theme_color" type="radio" id="color1-theme4"
                                                    value="{{ $css }}" data-theme="{{ $key }}"
                                                    data-imgpath="{{ $val['img_path'] }}"
                                                    class="colorinput-input color-{{ $loop->index++ }}"
                                                    {{ isset($store_settings['store_theme']) && $store_settings['store_theme'] == $css && $store_settings['theme_dir'] == $key ? 'checked' : '' }}>
                                                <span class="border-box">
                                                    <span class="colorinput-color"
                                                        style="background:#{{ $val['color'] }}"></span>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn  btn-primary">{{ __('Save') }}</button>
    </div>
    <script>
        $('body').on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            $('#themefile').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });
        $('body').ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });
        $(".color1").click(function() {
            var dataId = $(this).attr("data-id");
            $('#' + dataId).trigger('click');
            var first_check = $('#' + dataId).find('.color-0').trigger("click");
        });
    </script>
</div>


{{ Form::close() }}
