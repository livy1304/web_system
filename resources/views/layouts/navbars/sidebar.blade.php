<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse"
         data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            {{-- <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="..."> --}}
            {{Auth::user()->name}}
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="not found" 
                        src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-chart-pie-35" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Register') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('officers') }}">
                                    {{ __('Officers') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('funds') }}">
                                    {{ __('Funds') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                


                <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                    <i class="ni ni-chart-pie-35"" style="color: #f4645f;"></i>
                    <span class="nav-link-text" style="color: #f4645f;">{{ __('CHARTS') }}</span>
                </a>

                <div class="collapse show" id="navbar-examples">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("graphs") }}">
                                {{ __('Donations') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hierarchical') }}">
                                {{ __('HierachicalChart') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route("payments") }}">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __('Payment') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("patients") }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Patients') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("promoted") }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Promotions') }}
                    </a>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("waiting") }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('WaitingList') }}
                    </a>
                </li>
                
                </li>
            </ul>
        </div>
    </div>
</nav>
