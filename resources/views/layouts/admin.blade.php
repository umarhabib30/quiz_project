<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>@yield('title')</title>
  <!-- CSS files -->
  <link href="{{asset('admin-assets/dist/css/tabler.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-flags.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-payments.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-vendors.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/demo.min.css?1684106062')}}" rel="stylesheet"/>
  <!-- <script defer  src="https://kit.fontawesome.com/f5eb8f10bc.js" crossorigin="anonymous"></script> -->
  <style type="text/css">
        /*-------------------------
   Footer Styles
   -------------------------*/
   .edu-footer {
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 400px;
  }
  /*.footer {
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: auto;
  }*/

  .edu-footer .footer-top {
    position: relative;
    padding: 100px 0 95px;
  }

  .edu-footer .footer-top::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
/*    background-image: url(../images/bg/BG-3.webp);*/
background-repeat: no-repeat;
}

@media only screen and (max-width: 991px) {
  .edu-footer .footer-top::before {
    display: none;
  }
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  .edu-footer .footer-top {
    padding: 80px 0;
  }
}

@media only screen and (max-width: 767px) {
  .edu-footer .footer-top {
    padding: 60px 0;
  }
}

.edu-footer.footer-style-1 {
  background-color: #F0F4F5;
}

.edu-footer.footer-style-1 .footer-top .edu-footer-widget .logo a img.logo-dark {
  display: none;
}

.edu-footer.footer-style-2 {
  background-color: #111212;
}

.edu-footer.footer-style-2 .footer-top .edu-footer-widget .widget-title {
  color: #ffffff;
}

.edu-footer.footer-style-3 {
  background-color: #111212;
}

.edu-footer.footer-style-7 .footer-top::before {
  display: none;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .logo a img.logo-dark {
  display: none;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .description {
  color: #181818;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .widget-title {
  font-weight: 700;
  margin-top: 12px;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner {
  margin-top: 30px;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner .footer-link a {
  color: #181818;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner .footer-link a:hover {
  color: #2c0984;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner .widget-information ul li {
  color: #181818;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner .widget-information ul li a {
  color: #181818;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .inner .widget-information ul li a:hover {
  color: #2c0984;
}

.edu-footer.footer-style-7 .footer-top .edu-footer-widget .social-share {
  margin-top: 20px;
}

.edu-footer.footer-style-7 .footer-top .shape-group li.shape-1 {
  left: 100px;
  bottom: 45px;
}

.edu-footer.footer-style-7 .footer-top .shape-group li.shape-2 {
  right: 100px;
  bottom: -2px;
}

.edu-footer.footer-style-7 .copyright-area {
  border-top: 1px solid #e5e5e5;
}

.edu-footer.footer-style-7 .copyright-area a {
  color: #181818;
}

.edu-footer .description {
  margin-top: 20px;
  margin-bottom: 20px;
}

.edu-footer .information-list li {
  margin-top: 0;
  margin-bottom: 0;
}

.edu-footer .information-list li span {
  font-weight: 500;
  margin-right: 5px;
}

.edu-footer .information-list li a {
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.edu-footer .information-list li+li {
  margin-top: 5px;
}

.edu-footer .information-list li:hover a {
  color: #2c0984;
}

.edu-footer .edu-footer-widget {
  position: relative;
  z-index: 1;
}

.edu-footer .edu-footer-widget .logo a img.logo-light {
  display: inline-block;
}

.edu-footer .edu-footer-widget .inner {
  margin-top: 36px;
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  .edu-footer .edu-footer-widget .inner {
    margin-top: 20px;
  }
}

@media only screen and (max-width: 767px) {
  .edu-footer .edu-footer-widget .inner {
    margin-top: 20px;
  }
}

.edu-footer .edu-footer-widget .footer-link {
  list-style: none;
  padding: 0;
  margin-bottom: 0;
}

.edu-footer .edu-footer-widget .footer-link li {
  margin-top: 0;
  margin-bottom: 0;
}

.edu-footer .edu-footer-widget .footer-link li a {
  display: block;
  line-height: 26px;
}

.edu-footer .edu-footer-widget .footer-link li+li {
  margin-top: 11px;
}

.edu-footer .edu-footer-widget .footer-link li:hover a {
  color: #2c0984;
}

.edu-footer .edu-footer-widget .input-group {
  margin-bottom: 35px;
}

.edu-footer .edu-footer-widget .input-group .form-control {
  background-color: #ffffff;
  border-radius: 5px !important;
  font-size: 15px;
  font-weight: 400;
  border: none;
  height: auto;
  padding: 0 15px;
}

.edu-footer .edu-footer-widget .input-group button {
  margin-left: 10px !important;
  border-radius: 5px !important;
}

.edu-footer .edu-footer-widget.explore-widget {
  margin-left: 65px;
}

@media only screen and (min-width: 992px) and (max-width: 1199px) {
  .edu-footer .edu-footer-widget.explore-widget {
    margin-left: 0;
  }
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  .edu-footer .edu-footer-widget.explore-widget {
    margin-left: 0;
  }
}

@media only screen and (max-width: 767px) {
  .edu-footer .edu-footer-widget.explore-widget {
    margin-left: 0;
  }
}

@media only screen and (max-width: 479px) {
  .edu-footer .edu-footer-widget .input-group.footer-subscription-form {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
  }
}

@media only screen and (max-width: 479px) {
  .edu-footer .edu-footer-widget .input-group.footer-subscription-form .form-control {
    width: 100%;
    height: 50px;
    margin-bottom: 20px;
  }
}

@media only screen and (max-width: 479px) {
  .edu-footer .edu-footer-widget .input-group.footer-subscription-form button {
    margin-left: 0px !important;
  }
}

.edu-footer.footer-dark .widget-title {
  color: #ffffff;
}

.edu-footer.footer-dark p {
  color: #bababa;
}

.edu-footer.footer-dark li {
  color: #bababa;
}

.edu-footer.footer-dark a {
  color: #bababa;
}

.edu-footer.footer-lighten .widget-title {
  font-weight: 700;
}

.edu-footer.footer-lighten p {
  color: #181818;
}

.edu-footer.footer-lighten li {
  color: #181818;
}

.edu-footer.footer-lighten a {
  color: #181818;
}

.edu-footer.footer-light p {
  color: #181818;
}

.edu-footer.footer-light li {
  color: #181818;
}

.edu-footer.footer-light a {
  color: #181818;
}

.edu-footer.footer-light .edu-footer-widget .input-group .form-control {
  background-color: #f7f5f2;
}

.edu-footer.footer-kindergarten {
  background-color: #111212;
}

.edu-footer.footer-kindergarten .footer-top {
  padding: 100px 0 40px;
}

.edu-footer.footer-kindergarten .footer-top::before {
  display: none;
}

.edu-footer.footer-kindergarten .edu-footer-widget .widget-information {
  margin-bottom: 24px;
}

.edu-footer.footer-kindergarten .widget-title {
  color: #ffffff;
}

.edu-footer.footer-kindergarten p {
  color: #bababa;
}

.edu-footer.footer-kindergarten li {
  color: #bababa;
}

.edu-footer.footer-kindergarten a {
  color: #bababa;
}

.edu-footer.footer-kindergarten .copyright-area {
  position: relative;
  z-index: 1;
}

.edu-footer.footer-kindergarten .copyright-area::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
/*    background-image: url(../images/bg/bg-image-3.svg);*/
background-size: cover;
background-repeat: no-repeat;
z-index: -1;
}

.edu-footer.footer-for-kitchen .footer-top::before {
  display: none;
}

.edu-footer.footer-for-kitchen .shape-group li.shape-1 {
  top: 45px;
  left: 6%;
}

@media only screen and (max-width: 1650px),
only screen and (min-width: 1401px) and (max-width: 1750px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-1 {
    left: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-1 {
    left: -80px;
  }
}

.edu-footer.footer-for-kitchen .shape-group li.shape-2 {
  bottom: 30px;
  left: 40px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-2 {
    left: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-2 {
    left: -80px;
  }
}

.edu-footer.footer-for-kitchen .shape-group li.shape-3 {
  bottom: -50px;
  left: 46%;
}

.edu-footer.footer-for-kitchen .shape-group li.shape-4 {
  bottom: -10px;
  right: 40px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-4 {
    right: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-4 {
    right: -50px;
  }
}

.edu-footer.footer-for-kitchen .shape-group li.shape-5 {
  top: 50px;
  right: 6%;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-5 {
    right: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-kitchen .shape-group li.shape-5 {
    right: -50px;
  }
}

.edu-footer.footer-for-yoga .footer-top::before {
  display: none;
}

.edu-footer.footer-for-yoga .shape-group li img {
  opacity: .3;
}

.edu-footer.footer-for-yoga .shape-group li.shape-1 {
  top: 45px;
  left: 6%;
}

@media only screen and (max-width: 1650px),
only screen and (min-width: 1401px) and (max-width: 1750px) {
  .edu-footer.footer-for-yoga .shape-group li.shape-1 {
    left: 0;
  }
}

.edu-footer.footer-for-yoga .shape-group li.shape-2 {
  bottom: 30px;
  left: 40px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-yoga .shape-group li.shape-2 {
    left: 0;
  }
}

.edu-footer.footer-for-yoga .shape-group li.shape-2 img {
  opacity: .2;
}

.edu-footer.footer-for-yoga .shape-group li.shape-3 {
  bottom: -83px;
  left: 46%;
}

.edu-footer.footer-for-yoga .shape-group li.shape-3 img {
  opacity: .7;
}

.edu-footer.footer-for-yoga .shape-group li.shape-4 {
  bottom: -10px;
  right: 40px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-yoga .shape-group li.shape-4 {
    right: 0;
  }
}

.edu-footer.footer-for-yoga .shape-group li.shape-4 img {
  opacity: .2;
}

.edu-footer.footer-for-yoga .shape-group li.shape-5 {
  top: 50px;
  right: 6%;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-yoga .shape-group li.shape-5 {
    right: 0;
  }
}

.edu-footer.footer-for-photography .footer-top::before {
  display: none;
}

.edu-footer.footer-for-photography .shape-group li.shape-1 {
  top: 65px;
  left: 200px;
}

@media only screen and (max-width: 1650px),
only screen and (min-width: 1401px) and (max-width: 1750px) {
  .edu-footer.footer-for-photography .shape-group li.shape-1 {
    left: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-photography .shape-group li.shape-1 {
    left: -80px;
  }
}

.edu-footer.footer-for-photography .shape-group li.shape-2 {
  bottom: 50px;
  left: 75px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-photography .shape-group li.shape-2 {
    left: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-photography .shape-group li.shape-2 {
    left: -80px;
  }
}

.edu-footer.footer-for-photography .shape-group li.shape-3 {
  bottom: -13px;
  left: 46%;
}

.edu-footer.footer-for-photography .shape-group li.shape-4 {
  bottom: 40px;
  right: 100px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-photography .shape-group li.shape-4 {
    right: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-photography .shape-group li.shape-4 {
    right: -50px;
  }
}

.edu-footer.footer-for-photography .shape-group li.shape-5 {
  top: 70px;
  right: 253px;
}

@media only screen and (max-width: 1650px) {
  .edu-footer.footer-for-photography .shape-group li.shape-5 {
    right: 0;
  }
}

@media only screen and (min-width: 1200px) and (max-width: 1450px) {
  .edu-footer.footer-for-photography .shape-group li.shape-5 {
    right: -50px;
  }
}

.edu-footer .copyright-area a {
  color: #2c0984;
  -webkit-transition: background 0.2s linear;
  transition: background 0.2s linear;
}

.edu-footer .copyright-area a:hover {
  background: linear-gradient(-90deg, #aa1eca 0%, #2c0984 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

a.edu-btn,
button.edu-btn {
  text-align: center;
  border-radius: 5px;
  display: inline-block;
  height: 60px;
  line-height: 62px;
  color: #ffffff;
  background: #2c0984;
  padding: 0 30px;
  font-size: 15px;
  font-weight: 500;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  font-family: 'Spartan', sans-serif;
  border: 0 none;
  overflow: hidden;
  position: relative;
  z-index: 1;
}

[type=submit],
[type=reset],
button,
html [type=button] {
  -webkit-appearance: button;
}

        /*-------------------------
    Copyright Styles
    --------------------------*/
    .copyright-area {
      padding: 32px 0;
    }

    .copyright-area p {
      margin-bottom: 0;
    }

    .footer-dark .copyright-area {
      border-top: 1px solid #1f2020;
    }

    .footer-lighten .copyright-area {
      background-color: #ebeff0;
    }

    .footer-lighten .copyright-area p {
      color: #000000;
    }

    .footer-light .copyright-area {
      background-color: #ffffff;
      border-top: 1px solid #e5e5e5;
    }

    .footer-light .copyright-area p {
      color: #181818;
    }

    .footer-kindergarten .copyright-area {
      padding: 105px 0 50px;
    }

    .edu-footer .edu-footer-widget .input-group .form-control {
      background-color: #ffff;
      border-radius: 5px !important;
      font-size: 15px;
      font-weight: 400;
      border: none;
      height: auto;
      padding: 0 15px;
    }

    .edu-footer .edu-footer-widget .input-group button {
      margin-left: 10px !important;
      border-radius: 5px !important;
    }

    a.edu-btn.btn-medium,
    button.edu-btn.btn-medium {
      height: 50px;
      line-height: 51px;
      padding: 0 25px;
    }

    .edu-footer .description {
      margin-top: 20px !important;
      margin-bottom: 20px !important;
    }

    .edu-footer .description p {
      font-size: 15px !important;
      line-height: 1.73 !important;
      font-weight: 400 !important;
      margin: 0 0 30px !important;
    }

    .edu-footer.footer-lighten p {
      color: #181818 !important;
    }

    .edu-footer .information-list li span {
      font-weight: 500 !important;
      margin-right: 5px !important;
    }

    ul {
      padding-left: 0px;
    }

    ul li {
      font-size: 15px !important;
      line-height: 1.37 !important;
      margin-top: 10px !important;
      margin-bottom: 10px !important;
      color: #181818 !important;
      list-style: none !important;
    }
  </style>
</head>
<body >
  <div class="wrapper">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href="{{url('/home')}}">
            Quiz
          </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
              <span class="avatar avatar-sm" style="background-image: url('{{ asset('storage/images/' . Auth::user()->image) }}')"></span>
              <div class="d-none d-xl-block ps-2">
                <div>{{ Auth::user()->name}}</div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <a href="{{url('user/profile')}}" class="dropdown-item">Profile</a>
              <a href="{{url('user/settings')}}" class="dropdown-item">Settings</a>
              <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
          <div class="container-xl">
            <ul class="navbar-nav">
              @if(Auth()->user()->role == '1' || Auth()->user()->role == '0')
              <li class="nav-item @if($active_module == 'home') active @endif">
                <a class="nav-link" href="{{ url('admin/dashboard') }}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Home
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown @if($active_module == 'Admins') active @endif">
                <a class="nav-link " href="{{url('admin/users')}}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Admins
                  </span>
                </a>
              </li>
              <li class="nav-item @if($active_module == 'teachers') active @endif">
                <a class="nav-link" href="{{url('admin/teachers')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 11 12 14 20 6" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Teachers
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown @if($active_module == 'classes') active @endif">
                <a class="nav-link " href="{{url('admin/classes')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Classes
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown @if($active_module == 'students') active @endif">
                <a class="nav-link " href="{{url('admin/students')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Students
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown @if($active_module == 'Enrollment') active @endif">
                <a class="nav-link " href="{{url('admin/enrollment')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Enrollment
                  </span>
                </a>
              </li>
              @endif
              @if(auth()->user()->role == '2')
              <li class="nav-item @if(@$active_module == 'home') active @endif">
                <a class="nav-link" href="{{ url('admin/dashboard') }}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Home
                  </span>
                </a>
              </li>
              <li class="nav-item @if(@$active_module == 'Quiz') active @endif">
                <a class="nav-link" href="{{url('teacher/quiz')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Quiz
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown @if(@$active_module == 'Question') active @endif">
                <a class="nav-link" href="{{url('teacher/quiz')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Question
                  </span>
                </a>
              </li>
               <li class="nav-item dropdown @if(@$active_module == 'Answer') active @endif">
                <a class="nav-link" href="#" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Answer
                  </span>
                </a>
              </li>
              @endif
              @if(auth()->user()->role == '3')
              <li class="nav-item @if($active_module == 'home') active @endif"> 
                <!-- <li class="nav-item"> -->
                  <a class="nav-link" href="{{ url('/home') }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('student/quiz') }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Quiz
                    </span>
                  </a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              <!-- Page title actions -->
            </div>
          </div>
        </div>
        @yield('content')

        <footer class="edu-footer bg-image footer-style-1 footer footer-transparent p-0">
          <div class="footer-top">
            <div class="container">
              <div class="row g-5">
                <div class="col-lg-5">
                  <div class="edu-footer-widget">
                    <div class="logo">
                      <a href="{{ url('/') }}">
                        <h2>Quiz</h2>
                      </a>
                    </div>
                    <p class="description" style="color: #181818 !important;line-height: 1.73;">
                      KOI acknowledges the Gadigal people of the Eora Nation, the Boorooberongal people of the Dharug Nation, the Bidiagal people and the Gamaygal people, opon whose ancestral lands KOI stands. We would also like to pay respect to the elders both past and present, acknowledging them as the traditional custodians of the knowledge for these lands.
                    </p>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <div class="edu-footer-widget quick-link-widget">
                    <h4 class="widget-title">Links</h4>
                    <div class="inner">
                      <ul class="footer-link link-hover">
                        <li><a style="color:black; text-decoration:none;" href="#">Home</a></li>
                        <li><a style="color:black; text-decoration:none;" href="#">Privacy-Policy</a></li>
                        <li><a style="color:black; text-decoration:none;" href="#">Disclaimer</a></li>
                        <li><a style="color:black; text-decoration:none;" href="#">Terms and Conditions</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="edu-footer-widget">
                    <h4 class="widget-title">Contacts</h4>
                    <div class="inner">
                      <div class="widget-information">
                        <ul class="information-list">
                          <li style="text-decoration: none;"><span>Phone:</span>(02) 9283 3583</li>
                          <li style="text-decoration: none;"><span>Email:</span>
                            <a href="mailto:info@pulsetrainings.com" target="_blank" style="color:black; text-decoration:none;">ask@koi.edu.au</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="copyright-area" style="background-color: #ebeff0;">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="inner text-center">
                    <p style="color:#000000 !important;">Copyright 2024 <a href="{{ url('/home') }}">Kings Own Institute</a>. All Rights Reserved</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="{{asset('admin-assets/dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <!-- Tabler Core -->
    <script src="{{asset('admin-assets/dist/js/tabler.min.js')}}"></script>
    <script src="{{asset('admin-assets/dist/js/demo.min.js')}}"></script>
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
       window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
        chart: {
         type: "area",
         fontFamily: 'inherit',
         height: 40.0,
         sparkline: {
          enabled: true
        },
        animations: {
          enabled: false
        },
      },
      dataLabels: {
       enabled: false,
     },
     fill: {
       opacity: .16,
       type: 'solid'
     },
     stroke: {
       width: 2,
       lineCap: "round",
       curve: "smooth",
     },
     series: [{
       name: "Profits",
       data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
     }],
     grid: {
       strokeDashArray: 4,
     },
     xaxis: {
       labels: {
        padding: 0,
      },
      tooltip: {
        enabled: false
      },
      axisBorder: {
        show: false,
      },
      type: 'datetime',
    },
    yaxis: {
     labels: {
      padding: 4
    },
  },
  labels: [
   '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
   ],
  colors: ["#206bc4"],
  legend: {
   show: false,
 },
})).render();
     });
      // @formatter:on
   </script>
   <script>
      // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
     window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
      chart: {
       type: "line",
       fontFamily: 'inherit',
       height: 40.0,
       sparkline: {
        enabled: true
      },
      animations: {
        enabled: false
      },
    },
    fill: {
     opacity: 1,
   },
   stroke: {
     width: [2, 1],
     dashArray: [0, 3],
     lineCap: "round",
     curve: "smooth",
   },
   series: [{
     name: "May",
     data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
   },{
     name: "April",
     data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
   }],
   grid: {
     strokeDashArray: 4,
   },
   xaxis: {
     labels: {
      padding: 0,
    },
    tooltip: {
      enabled: false
    },
    type: 'datetime',
  },
  yaxis: {
   labels: {
    padding: 4
  },
},
labels: [
 '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
 ],
colors: ["#206bc4", "#a8aeb7"],
legend: {
 show: false,
},
})).render();
   });
      // @formatter:on
 </script>
 <script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
    chart: {
     type: "bar",
     fontFamily: 'inherit',
     height: 40.0,
     sparkline: {
      enabled: true
    },
    animations: {
      enabled: false
    },
  },
  plotOptions: {
   bar: {
    columnWidth: '50%',
  }
},
dataLabels: {
 enabled: false,
},
fill: {
 opacity: 1,
},
series: [{
 name: "Profits",
 data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
}],
grid: {
 strokeDashArray: 4,
},
xaxis: {
 labels: {
  padding: 0,
},
tooltip: {
  enabled: false
},
axisBorder: {
  show: false,
},
type: 'datetime',
},
yaxis: {
 labels: {
  padding: 4
},
},
labels: [
 '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
 ],
colors: ["#206bc4"],
legend: {
 show: false,
},
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
    chart: {
     type: "bar",
     fontFamily: 'inherit',
     height: 240,
     parentHeightOffset: 0,
     toolbar: {
      show: false,
    },
    animations: {
      enabled: false
    },
    stacked: true,
  },
  plotOptions: {
   bar: {
    columnWidth: '50%',
  }
},
dataLabels: {
 enabled: false,
},
fill: {
 opacity: 1,
},
series: [{
 name: "Web",
 data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
},{
 name: "Social",
 data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
},{
 name: "Other",
 data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
}],
grid: {
 padding: {
  top: -20,
  right: 0,
  left: -4,
  bottom: -4
},
strokeDashArray: 4,
xaxis: {
  lines: {
   show: true
 }
},
},
xaxis: {
 labels: {
  padding: 0,
},
tooltip: {
  enabled: false
},
axisBorder: {
  show: false,
},
type: 'datetime',
},
yaxis: {
 labels: {
  padding: 4
},
},
labels: [
 '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
 ],
colors: ["#206bc4", "#79a6dc", "#bfe399"],
legend: {
 show: false,
},
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-activity'), {
    chart: {
     type: "radialBar",
     fontFamily: 'inherit',
     height: 40,
     width: 40,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 plotOptions: {
   radialBar: {
    hollow: {
     margin: 0,
     size: '75%'
   },
   track: {
     margin: 0
   },
   dataLabels: {
     show: false
   }
 }
},
colors: ["#206bc4"],
series: [35],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
    chart: {
     type: "area",
     fontFamily: 'inherit',
     height: 192,
     sparkline: {
      enabled: true
    },
    animations: {
      enabled: false
    },
  },
  dataLabels: {
   enabled: false,
 },
 fill: {
   opacity: .16,
   type: 'solid'
 },
 stroke: {
   width: 2,
   lineCap: "round",
   curve: "smooth",
 },
 series: [{
   name: "Purchases",
   data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
 }],
 grid: {
   strokeDashArray: 4,
 },
 xaxis: {
   labels: {
    padding: 0,
  },
  tooltip: {
    enabled: false
  },
  axisBorder: {
    show: false,
  },
  type: 'datetime',
},
yaxis: {
 labels: {
  padding: 4
},
},
labels: [
 '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
 ],
colors: ["#206bc4"],
legend: {
 show: false,
},
point: {
 show: false
},
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-1'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [17, 24, 20, 10, 5, 1, 4, 18, 13]
 }],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-2'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [13, 11, 19, 22, 12, 7, 14, 3, 21]
 }],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-3'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [10, 13, 10, 4, 17, 3, 23, 22, 19]
 }],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-4'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [6, 15, 13, 13, 5, 7, 17, 20, 19]
 }],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-5'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [2, 11, 15, 14, 21, 20, 8, 23, 18, 14]
 }],
})).render();
 });
      // @formatter:on
</script>
<script>
      // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
   window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-6'), {
    chart: {
     type: "line",
     fontFamily: 'inherit',
     height: 24,
     animations: {
      enabled: false
    },
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
   enabled: false,
 },
 stroke: {
   width: 2,
   lineCap: "round",
 },
 series: [{
   color: "#206bc4",
   data: [22, 12, 7, 14, 3, 21, 8, 23, 18, 14]
 }],
})).render();
 });
      // @formatter:on
</script>
<script type="text/javascript">
  $(document).ready(function(){
   baseJS.init(
   {
     "site_url": "{{url('/')}}",
     "current_url":"{{URL::current()}}",
     "notif": {"type":"toastr", "options":[]},
     "inputMasking": "YES",
   }
   );

 })
</script>
<script defer  src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script defer  src="{{asset('assets/js/base.js')}}" defer></script>
<script defer  src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script defer  src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer  src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>
</html>