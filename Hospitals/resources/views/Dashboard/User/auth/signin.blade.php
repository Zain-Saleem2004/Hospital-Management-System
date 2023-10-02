@extends('Dashboard.layouts.master2')
@section('css')
    <style>
        .loginform {
            display: none;
        }
    </style>

    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('Dashboard/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{ trans('Dashboard/login_trans.Welcome_back') }}</h2>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label
                                                    for="exampleFormControlSelect1">{{ trans('Dashboard/login_trans.Entry') }}</label>
                                                <select class="form-control" id="sectionchooser">
                                                    <option value="" selected disabled>{{ trans('Dashboard/login_trans.Entry') }}</option>
                                                    <option value="patient">{{trans('Dashboard/login_trans.Patient')}}</option>
                                                    <option value="admin"> {{trans('Dashboard/login_trans.Admin')}} </option>
                                                    <option value="doctor"> {{trans('Dashboard/login_trans.Doctor')}} </option>
                                                    <option value="ray_employee"> موظف أشعة </option>
                                                    <option value="laboratorie_employee"> موظف مختبر </option>
                                                </select>
                                            </div>
                                            {{-- form user --}}
                                            <div class="loginform" id="patient">
                                                <h5 class="font-weight-semibold mb-4">الدخول كمريض</h5>
                                                <form method="POST" action="{{ route('login.patient') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control"
                                                            placeholder="Enter your email" type="email" name="email"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            name="password" required autocomplete="current-password">
                                                    </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                                   
                                                </form>
                                                
                                            </div>




                                            {{-- form admin --}}
                                            <div class="loginform" id="admin">
                                                <h5 class="font-weight-semibold mb-4">الدخول ادمن</h5>
                                                <form method="POST" action="{{ route('login.admin') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control"
                                                            placeholder="Enter your email" type="email" name="email"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            name="password" required autocomplete="current-password">
                                                    </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>

                                            {{-- form doctor --}}
                                            <div class="loginform" id="doctor">
                                                <h5 class="font-weight-semibold mb-4">الدخول دكتور</h5>
                                                <form method="POST" action="{{ route('login.doctor') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control"
                                                            placeholder="Enter your email" type="email" name="email"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            name="password" required autocomplete="current-password">
                                                    </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>

                                            {{-- form RayEmployee --}}
                                            <div class="loginform" id="ray_employee">
                                                <h5 class="font-weight-semibold mb-4">الدخول موظف أشعة</h5>
                                                <form method="POST" action="{{ route('login.ray_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control"
                                                            placeholder="Enter your email" type="email" name="email"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            name="password" required autocomplete="current-password">
                                                    </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>

                                              {{-- form LaboratorieEmployee --}}
                                              <div class="loginform" id="laboratorie_employee">
                                                <h5 class="font-weight-semibold mb-4">الدخول موظف مختبر</h5>
                                                <form method="POST" action="{{ route('login.laboratorie_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control"
                                                            placeholder="Enter your email" type="email" name="email"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            name="password" required autocomplete="current-password">
                                                    </div><button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                            




                                             

                                             
                                          
                                       
                                        
                                        



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->
    </div>
    </div>
@endsection
@section('js')
    <script>
        $('#sectionchooser').change(function() {
            var myId = $(this).val();
            $('.loginform').each(function() {
                myId === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection
