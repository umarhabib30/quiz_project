<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>Sign in - Admin</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
  <link href="{{asset('admin-assets/dist/css/tabler.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-flags.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-payments.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/tabler-vendors.min.css?1684106062')}}" rel="stylesheet"/>
  <link href="{{asset('admin-assets/dist/css/demo.min.css?1684106062')}}" rel="stylesheet"/>
  <style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>
<body  class=" d-flex flex-column">
  <script src="{{asset('admin-assets/dist/js/demo-theme.min.js?1684106062')}}"></script>
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('assets/images/logo.png')}}" height="36" alt=""></a>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Login to your account</h2>
          <form action="{{ url('student/authenticate') }}" method="post" autocomplete="off" novalidate>
            @csrf
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
                <span class="form-label-description">
                  <a href="./forgot-password.html">I forgot password</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Libs JS -->
  <script src="{{asset('admin-assets/dist/js/tabler.min.js?1684106062')}}" defer></script>
  <script src="{{asset('admin-assets/dist/js/demo.min.js?1684106062')}}" defer></script>
</body>
</html>