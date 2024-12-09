
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
    <script src="https://kit.fontawesome.com/f5eb8f10bc.js" crossorigin="anonymous"></script>
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <style>
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
  </style>
</head> 
<body >
  <script src="{{asset('admin-assets/dist/js/demo-theme.min.js?1684106062')}}"></script>
  <div class="page">
    <!-- Navbar -->
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
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div class="d-none d-xl-block ps-2">
                <div>{{ Auth::user()->name}}</div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <a href="{{url('student/profile')}}" class="dropdown-item">Profile</a>
              <a href="{{url('admin/settings')}}" class="dropdown-item">Settings</a>
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
          {{-- <li class="nav-item @if($active_module == 'home') active @endif"> --}}
            <li class="nav-item">
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
        </ul>
      </div>
    </div>
  </div>
</header>
<div class="page-wrapper">

  @yield('content')
  
  <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <!--  -->
        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              Copyright &copy; 2024
              <a href="{{ url('dashboard') }}" class="link-secondary"> Quiz</a>
              All rights reserved
            </li>
            <li class="list-inline-item">
              <a href="" class="link-secondary" rel="noopener">
                <!-- v1.0.0-beta19 -->
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
</div>

<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="{{asset('assets/js/base.js')}}" defer></script>


<script src="{{asset('admin-assets/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/maps/world.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062')}}" defer></script>
<!-- Tabler Core -->
<script src="{{asset('admin-assets/dist/js/tabler.min.js?1684106062')}}" defer></script>
<script src="{{asset('admin-assets/dist/js/demo.min.js?1684106062')}}" defer></script>
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
          tooltip: {
            theme: 'dark'
          },
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
          colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("green", 0.8)],
          legend: {
            show: false,
          },
        })).render();
      });
      // @formatter:on
    </script>
    <script>
      // @formatter:on
      document.addEventListener("DOMContentLoaded", function() {
        const map = new jsVectorMap({
          selector: '#map-world',
          map: 'world',
          backgroundColor: 'transparent',
          regionStyle: {
            initial: {
              fill: tabler.getColor('body-bg'),
              stroke: tabler.getColor('border-color'),
              strokeWidth: 2,
            }
          },
          zoomOnScroll: false,
          zoomButtons: false,
            // -------- Series --------
            visualizeData: {
              scale: [tabler.getColor('bg-surface'), tabler.getColor('primary')],
              values: { "AF": 16, "AL": 11, "DZ": 158, "AO": 85, "AG": 1, "AR": 351, "AM": 8, "AU": 1219, "AT": 366, "AZ": 52, "BS": 7, "BH": 21, "BD": 105, "BB": 3, "BY": 52, "BE": 461, "BZ": 1, "BJ": 6, "BT": 1, "BO": 19, "BA": 16, "BW": 12, "BR": 2023, "BN": 11, "BG": 44, "BF": 8, "BI": 1, "KH": 11, "CM": 21, "CA": 1563, "CV": 1, "CF": 2, "TD": 7, "CL": 199, "CN": 5745, "CO": 283, "KM": 0, "CD": 12, "CG": 11, "CR": 35, "CI": 22, "HR": 59, "CY": 22, "CZ": 195, "DK": 304, "DJ": 1, "DM": 0, "DO": 50, "EC": 61, "EG": 216, "SV": 21, "GQ": 14, "ER": 2, "EE": 19, "ET": 30, "FJ": 3, "FI": 231, "FR": 2555, "GA": 12, "GM": 1, "GE": 11, "DE": 3305, "GH": 18, "GR": 305, "GD": 0, "GT": 40, "GN": 4, "GW": 0, "GY": 2, "HT": 6, "HN": 15, "HK": 226, "HU": 132, "IS": 12, "IN": 1430, "ID": 695, "IR": 337, "IQ": 84, "IE": 204, "IL": 201, "IT": 2036, "JM": 13, "JP": 5390, "JO": 27, "KZ": 129, "KE": 32, "KI": 0, "KR": 986, "KW": 117, "KG": 4, "LA": 6, "LV": 23, "LB": 39, "LS": 1, "LR": 0, "LY": 77, "LT": 35, "LU": 52, "MK": 9, "MG": 8, "MW": 5, "MY": 218, "MV": 1, "ML": 9, "MT": 7, "MR": 3, "MU": 9, "MX": 1004, "MD": 5, "MN": 5, "ME": 3, "MA": 91, "MZ": 10, "MM": 35, "NA": 11, "NP": 15, "NL": 770, "NZ": 138, "NI": 6, "NE": 5, "NG": 206, "NO": 413, "OM": 53, "PK": 174, "PA": 27, "PG": 8, "PY": 17, "PE": 153, "PH": 189, "PL": 438, "PT": 223, "QA": 126, "RO": 158, "RU": 1476, "RW": 5, "WS": 0, "ST": 0, "SA": 434, "SN": 12, "RS": 38, "SC": 0, "SL": 1, "SG": 217, "SK": 86, "SI": 46, "SB": 0, "ZA": 354, "ES": 1374, "LK": 48, "KN": 0, "LC": 1, "VC": 0, "SD": 65, "SR": 3, "SZ": 3, "SE": 444, "CH": 522, "SY": 59, "TW": 426, "TJ": 5, "TZ": 22, "TH": 312, "TL": 0, "TG": 3, "TO": 0, "TT": 21, "TN": 43, "TR": 729, "TM": 0, "UG": 17, "UA": 136, "AE": 239, "GB": 2258, "US": 4624, "UY": 40, "UZ": 37, "VU": 0, "VE": 285, "VN": 101, "YE": 30, "ZM": 15, "ZW": 5 },
            },
          });
        window.addEventListener("resize", () => {
          map.updateSize();
        });
      });
      // @formatter:off
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
       baseJS.init(
       {
         "site_url": "{{url('/')}}",
         "current_url":"{{URL::current()}}",
         "lang": "en",
         "notif": {"type":"toastr", "options":[]},
         "inputMasking": "YES",
       }
       );

     })
   </script>

   @yield('script')

 </body>
 </html>