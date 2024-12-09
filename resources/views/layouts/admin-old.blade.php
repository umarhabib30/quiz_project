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
  }

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
  <!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script> -->
    <!-- <style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
    .flex.justify-between.flex-1.sm\:hidden {
      display: none;
    }
    .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
      display: flex;
      align-items: center;
      justify-content: end;
      margin-top: 17px;
    }
    p.text-sm.text-gray-700.leading-5{
      display: none;
    }
  </style> -->
</head> 
<body >
  <script src="{{asset('admin-assets/dist/js/demo-theme.min.js?1684106062')}}"></script>
  <div class="page">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md d-print-none" >
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href="{{url('/')}}">
            <!-- <img src="{{asset('assets/images/logo.png')}}" style="height:3rem !important;" alt="Tabler" class="navbar-brand-image"> -->
            <h3 class="navbar-brand-image justify-content-middle">Quiz</h3>
          </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          <div class="d-none d-md-flex" style="margin-right: 10px;">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
            data-bs-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
          data-bs-placement="bottom">
          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
        </a>
      </div>
      <div class="navitem">
        <!-- <a href="{{ url('student/login')}}">Student Login</a> -->
      </div>
      <div class="nav-item dropdown">
        @php
        if (@file_get_contents(asset('/storage/images/'. Auth::user()->image))) {
          $image = asset('/storage/images/'. Auth::user()->image);
        } else {
          $image = url('/admin-assets/static/avatars/images.png');
        }
        @endphp
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url('{{ @$image }}')"></span>
          <div class="d-none d-xl-block ps-2">
            <div>{{ Auth::user()->name}}</div>
            <!-- <div class="mt-1 small text-muted">UI Designer</div> -->
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{url('admin/profile')}}" class="dropdown-item">Profile</a>
          <a href="{{url('admin/settings')}}" class="dropdown-item">Setting</a>
          <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <ul class="navbar-nav">
          @if(Auth()->user()->role == '1')
          {{-- <li class="nav-item @if($active_module == 'home') active @endif"> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/dashboard') }}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'Admins') active @endif">
              <a class="nav-link" href="{{url('admin/users')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Admins
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'teachers') active @endif">
              <a class="nav-link" href="{{url('admin/teachers')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Teachers
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'classes') active @endif">
              <a class="nav-link" href="{{url('admin/classes')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Classes
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'students') active @endif">
              <a class="nav-link" href="{{url('admin/students')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Students
                </span>
              </a>
            </li>
            @endif
            @if(auth()->user()->role == '2')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('instructor/dashboard') }}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'Quiz') active @endif">
              <a class="nav-link" href="{{url('teacher/quiz')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Quiz
                </span>
              </a>
            </li>
            <li class="nav-item dropdown @if($active_module == 'Question') active @endif">
              <a class="nav-link" href="{{url('teacher/quiz')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                </span>
                <span class="nav-link-title">
                  Question
                </span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </header>
  <div class="page-wrapper">

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
                KOI acknowledges the Gadigal people of the Eora Nation, the Boorooberongal people of the Dharug Nation, the Bidiagal people and the Gamaygal people, opon whose ancestral lands KOI stands. We would also like to pay respect to the elders both past and present, acknowledging them as the traditional custodians of the knowledge for these lands.</p>

              </div>
            </div>
            <!-- <div class="col-lg-3 col-sm-6">
               <div class="edu-footer-widget explore-widget">
                <h4 class="widget-title">Pages</h4>
                <div class="inner">
                  <ul class="footer-link link-hover" style="color:black"> -->
                    <!-- <li><a style="color:black; text-decoration:none;"
                      href="{{ url('search?query=') }}">Courses</a></li>
                      <li><a style="color:black; text-decoration:none;"
                        href="{{ url('about') }}">About Us</a></li>
                        <li><a style="color:black; text-decoration:none;"
                          href="{{ url('contact') }}">Contact Us</a></li>
                          <li><a style="color:black; text-decoration:none;"
                            href="{{ url('terms') }}">Terms & Conditions</a></li> -->
                         <!--  </ul>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-lg-2 col-sm-6">
                      <div class="edu-footer-widget quick-link-widget">
                        <h4 class="widget-title">Links</h4>
                        <div class="inner">
                          <ul class="footer-link link-hover">
                            <li><a style="color:black; text-decoration:none;"
                              href="#">Home</a></li>
                              <li><a style="color:black; text-decoration:none;"
                                href="#">Privacy-Policy</a></li>
                                <li><a style="color:black; text-decoration:none;"
                                  href="#">Disclaimer</a></li>
                                  <li><a style="color:black; text-decoration:none;"
                                  href="#">Terms and Conditions</a></li>
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

                                  <li style="text-decoration: none;"><span>Email:</span><a
                                    href="mailto:info@pulsetrainings.com" target="_blank"
                                    style="color:black; text-decoration:none;">ask@koi.edu.au</a>
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
                            <p style="color:#000000 !important;">Copyright 2024 <a
                              href="{{ url('/home') }}">Kings Own Institute</a>. All Rights
                            Reserved</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </footer>
  <!-- <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              Copyright &copy; 2023
              <a href="{{ url('dashboard') }}" class="link-secondary"> Quiz</a>
              All rights reserved
            </li>
            <li class="list-inline-item">
              <a href="" class="link-secondary" rel="noopener">
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer> -->
</div>
</div>

<!-- Libs JS -->
<script defer  src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script defer  src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script defer  src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer  src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script defer  src="{{asset('assets/js/base.js')}}" defer></script>


<script src="{{asset('admin-assets/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/maps/world.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062')}}" defer></script>
<!-- Tabler Core -->
<script defer  src="{{asset('admin-assets/dist/js/tabler.min.js?1684106062')}}" defer></script>
<script defer  src="{{asset('admin-assets/dist/js/demo.min.js?1684106062')}}" defer></script>

<!-- <script type="text/javascript">
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
</script> -->

@yield('script')

</body>
</html>