@extends('layouts.admin')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@push('script-page')
    <script>
        var today = new Date()
        var curHr = today.getHours()
        var target = document.getElementById("greetings")

        if (curHr < 12) {
            target.innerHTML = "{{ __('Good Morning,') }}";
        } else if (curHr < 17) {
            target.innerHTML = "{{ __('Good Afternoon,') }}";
        } else {
            target.innerHTML = "{{ __('Good Evening,') }}";
        }
    </script>
@endpush
@section('content')
    @php
        // $logo = asset(Storage::url('uploads/logo/'));
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        $company_logo = \App\Models\Utility::getValByName('company_logo');
        $profile = \App\Models\Utility::get_file('uploads/profile/');
        $logo1 = \App\Models\Utility::get_file('uploads/is_cover_image/');
        $users = Auth::user();
    @endphp
    <!-- [ Main Content ] start -->
    @if (\Auth::user()->type == 'super admin')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Store') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Paid Store') }}</h6>
                                    <h3 class="mb-0">{{ $user['total_paid_user'] }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Orders') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_orders }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Total Order Amount') }}</h6>
                                    <h3 class="mb-0">
                                        {{ env('CURRENCY_SYMBOL') . $user['total_orders_price'] }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Plans') }}</h6>
                                        <h3 class="mb-0">{{ $user['total_plan'] }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Most Purchase Plan') }}</h6>
                                    <h3 class="mb-0">
                                        {{ !empty($user['most_purchese_plan']) ? $user['most_purchese_plan'] : '-' }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Recent Order') }}</h5>
                            </div>
                            <div class="card-body">
                                <div id="plan_order" data-color="primary" data-height="230"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    @else
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row mb-5 gy-4">
                    <div class="col-lg-4">
                        <div class="welcome-card border bg-light-primary p-3 border-primary rounded text-dark h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-2">
                                    <img src="{{ !empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . 'avatar.png' }}"
                                        alt="" class="theme-avtar">
                                </div>
                                <div>
                                    <h5 class="mb-0 text-dark">
                                        <span class="d-block" id="greetings"></span>
                                        <b class="f-w-700">{{ __(Auth::user()->name) }}</b>
                                    </h5>
                                </div>
                            </div>
                            <p class="mb-0"><b
                                    class="f-w-500">{{ __('Have a nice day!') }}</b>{{ __('Did you know that you can quickly
                                                                                                                                                                                                                                                                                                                                                            add your favorite product or category to the store?') }}
                            </p>
                            <div class="btn-group mt-4">
                                <button class="btn  btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="plus" class="me-2"></i>
                                    {{ __('Quick add') }}</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('product.create') }}">{{ __('Add new product') }}</a>
                                    <a class="dropdown-item" href="#!" data-size="md"
                                        data-url="{{ route('product_tax.create') }}" data-ajax-popup="true"
                                        data-title="{{ __('Create New Product Tax') }}">{{ __('Add new product tax') }}</a>
                                    <a class="dropdown-item" href="#!" data-size="md"
                                        data-url="{{ route('product_categorie.create') }}" data-ajax-popup="true"
                                        data-title="{{ __('Create New Product Category') }}">{{ __('Add new product category') }}</a>
                                    <a class="dropdown-item" href="#!" data-size="md"
                                        data-url="{{ route('product-coupon.create') }}" data-ajax-popup="true"
                                        data-title="{{ __('Create New Product Coupon') }}">{{ __('Add new product coupon') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row gy-4">
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body border rounded  p-3">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ $store_id->name }}</h6>
                                            <span>
                                                <i data-feather="arrow-up-right"></i>
                                            </span>
                                        </div>
                                        <div class="mb-4" style="text-align: center">
                                            {!! QrCode::generate($store_id['store_url']) !!}
                                        </div>
                                        <a href="#!" class="btn btn-light-primary w-100 cp_link"
                                            data-link="{{ $store_id['store_url'] }}"
                                            data-original-title="{{ __('Click to copy link') }}">{{ __('Store Link') }}<i
                                                class="ms-3" data-feather="copy"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body border rounded  p-3">
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ __('Total Products') }}</h6>
                                            <span>
                                                <i data-feather="arrow-up-right"></i>
                                            </span>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <span class="f-30 f-w-600">{{ $newproduct }}</span>
                                            {{-- <span class="badge rounded bg-light-success f-w-600"><i
                                            data-feather="arrow-up"></i>12%</span> --}}
                                        </div>
                                        <div class="chart-wrapper">
                                            <div id="TotalProducts" class="remove-min"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body border rounded  p-3">
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ __('Total Sales') }}</h6>
                                            <span>
                                                <i data-feather="arrow-up-right"></i>
                                            </span>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <span
                                                class="f-30 f-w-600">{{ \App\Models\Utility::priceFormat($totle_sale) }}</span>
                                            {{-- <span class="badge rounded bg-light-success f-w-600"><i
                                            data-feather="arrow-up"></i>12%</span> --}}
                                        </div>
                                        <div class="chart-wrapper">
                                            <div id="TotalSales" class="remove-min"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body border rounded  p-3">
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0">{{ __('Total Orders') }}</h6>
                                            <span>
                                                <i data-feather="arrow-up-right"></i>
                                            </span>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <span class="f-30 f-w-600">{{ $totle_order }}</span>
                                            {{-- <span class="badge rounded bg-light-success f-w-600"><i
                                            data-feather="arrow-up"></i>12%</span> --}}
                                        </div>
                                        <div class="chart-wrapper">
                                            <div id="TotalOrders" class="remove-min"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4>{{ __('Top Products') }}</h4>
                        <div class="card mb-0 shadow-none">
                            <div class="card-body border border-bottom-0 overflow-hidden rounded pb-0 table-border-style">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="bg-transparent" colspan="4"> {{ __('Product') }}</th>
                                                <th class="bg-transparent">{{ __('Quantity') }}</th>
                                                <th class="bg-transparent">{{ __('Price') }}</th>
                                                <th class="bg-transparent"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                @foreach ($item_id as $k => $item)
                                                    @if ($product->id == $item)
                                                        <tr>
                                                            @if (!empty($product->is_cover))
                                                                <td colspan="4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="theme-avtar me-2">
                                                                            <img src="{{ $logo1 . (isset($product->is_cover) && !empty($product->is_cover) ? $product->is_cover : 'default_img.png') }}"
                                                                                alt="" class="wid-30">
                                                                        </div>
                                                                        <a href="{{ $logo1 . (isset($product->is_cover) && !empty($product->is_cover) ? $product->is_cover : 'default_img.png') }}"
                                                                            class=" text-dark f-w-600"
                                                                            target="_blank">{{ $product->name }}</a>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td colspan="4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="theme-avtar me-2">
                                                                            <img src="{{ $logo1 . (isset($product->is_cover) && !empty($product->is_cover) ? $product->is_cover : 'default_img.png') }}"
                                                                                alt="" class="wid-30">
                                                                        </div>
                                                                        <a href="{{ $logo1 . (isset($product->is_cover) && !empty($product->is_cover) ? $product->is_cover : 'default_img.png') }}"
                                                                            class=" text-dark f-w-600"
                                                                            target="_blank">{{ $product->name }}</a>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                            <td>{{ $product->quantity }}</td>
                                                            <td><span
                                                                    class="f-w-700">{{ \App\Models\Utility::priceFormat($product->price) }}</span>
                                                            </td>
                                                            <td><span
                                                                    class="badge rounded p-2 f-10 bg-light-primary">{{ $totle_qty[$k] }}
                                                                    {{ __('Sold') }}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4>{{ __('Order') }}</h4>
                        <div class="card shadow-none mb-0">
                            <div class="card-body p-3 rounded border">
                                <div id="apex-dashborad"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="f-w-900 mb-3">{{ __('Recent Orders') }}</h2>
                    </div>
                    <div class="col-12">
                        <div class="card mb-0 shadow-none">
                            <div class="card-body border border-bottom-0 overflow-hidden rounded pb-0 table-border-style">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="bg-transparent">{{ __('Orders') }}</th>
                                                <th class="bg-transparent">{{ __('Date') }}</th>
                                                <th class="bg-transparent">{{ __('Name') }}</th>
                                                <th class="bg-transparent">{{ __('Value') }}</th>
                                                <th class="bg-transparent">{{ __('Payment Type') }}</th>
                                                <th class="bg-transparent">{{ __('Status') }}</th>
                                                <th class="bg-transparent">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($new_orders))
                                                @foreach ($new_orders as $order)
                                                    @if ($order->status != 'Cancel Order')
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                    class="btn  btn-outline-primary cp_link"
                                                                    data-link="{{ $store_id['store_url'] }}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Click to copy link') }}">{{ $order->order_id }}</a>
                                                            </td>
                                                            <td> {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                            </td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ \App\Models\Utility::priceFormat($order->price) }}</td>
                                                            <td>{{ $order->payment_type }}</td>
                                                            <td>
                                                                @if ($order->status == 'pending')
                                                                    <span
                                                                        class="badge me-2 rounded p-2 bg-light-primary">{{ __('Paid') }}</span>
                                                                    {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                                @else
                                                                    <span
                                                                        class="badge me-2 rounded p-2 bg-light-secondary">{{ __('Delivered') }}</span>
                                                                    {{ \App\Models\Utility::dateFormat($order->updated_at) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                    class="btn btn-sm  btn-icon btn-secondary"
                                                                    data-bs-original-title="{{ __('Details') }}"><i
                                                                        data-feather="eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    @endif
    <!-- [ Main Content ] end -->
@endsection
@push('script-page')
    <script>
        $(document).on('click', '#code-generate', function() {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
    @if (\Auth::user()->type != 'super admin')
        <script>
            $(document).ready(function() {
                $('.cp_link').on('click', function() {
                    var value = $(this).attr('data-link');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    show_toastr('Success', '{{ __('Link copied') }}', 'success')
                });
            });

            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "{{ __('Order') }}",
                        data: {!! json_encode($chartData['data']) !!}
                    }],
                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: {!! json_encode($chartData['label']) !!},
                        title: {
                            text: '{{ __('Days') }}'
                        }
                    },
                    colors: ['#6fd943'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#apex-dashborad"), options);
                chart.render();
            })();
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300
            })
        </script>
    @else
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: [10, 50, 20, 50, 30, 60, 30, 40, 20]
                        // data: [10,20,30,40,50,60,70,40,20,50,60,20,50,70]
                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: ["03-Jun", "04-Jun", "05-Jun", "06-Jun", "07-Jun", "08-Jun", "09-Jun", "10-Jun",
                            "11-Jun"
                        ]
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#plan_order"), options);
                chart.render();
            })();
        </script>
    @endif
@endpush
