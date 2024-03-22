{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard | Drops</title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto"
      rel="stylesheet">
    <link href="plugins/material/css/materialdesignicons.min.css"
      rel="stylesheet" />
    <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

    <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />

    <link
      href="plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css"
      rel="stylesheet" />
    <link href="plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet"
      />
    <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="plugins/toaster/toastr.min.css" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="css/style.css" />

    <link href="images/favicon.png" rel="shortcut icon" />

    <script src="plugins/nprogress/nprogress.js"></script>
  </head>


  <body class="navbar-fixed sidebar-fixed" id="body">


    <div class="wrapper">

      <aside class="left-sidebar sidebar-dark" id="left-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
          <div class="app-brand">
            <a href="">
              <img src="images/logo.png" alt="Mono">
              <span class="brand-name">ElPato</span>
            </a>
          </div>
          <div class="sidebar-left" data-simplebar style="height: 100%;">
            <ul class="nav sidebar-inner" id="sidebar-menu">

              <li
                class="active">
                <a class="sidenav-item-link" href="">
                  <i class="mdi mdi-briefcase-account-outline"></i>
                  <span class="nav-text">Business Dashboard</span>
                </a>
              </li>

              <li>
                <a class="sidenav-item-link" href="">
                  <i class="mdi mdi-chart-line"></i>
                  <span class="nav-text">Analytics Dashboard</span>
                </a>
              </li>

            </ul>

          </div>
        </div>
      </aside>

      <div class="page-wrapper">

        <!-- Header -->
        <header class="main-header" id="header">
          <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <button id="sidebar-toggler" class="sidebar-toggle">
              <span class="sr-only">Toggle navigation</span>
            </button>

            <span class="page-title">dashboard</span>

            <div class="navbar-right ">
              <!-- User Account -->
              <ul class="nav navbar-nav">
                <li class="dropdown user-menu">
                  <button class="dropdown-toggle nav-link"
                    data-toggle="dropdown">
                    <img src="images/user/user-xs-01.jpg" class="user-image
                      rounded-circle" alt="User Image" />
                    <span class="d-none d-lg-inline-block">Nome</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a class="dropdown-link-item" href="">
                        <i class="mdi mdi-account-outline"></i>
                        <span class="nav-text">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-link-item"
                        href="">
                        <i class="mdi mdi-settings"></i>
                        <span class="nav-text">Account Setting</span>
                      </a>
                    </li>

                    <li class="dropdown-footer">
                      <a class="dropdown-link-item" href=""> <i
                          class="mdi mdi-logout"></i> Log Out </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>


        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">
            <!-- Top Statistics -->
            <div class="row">
              <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                  <div class="card-header">
                    <h2>$18,699</h2>
                    <div class="dropdown">
                      <a class="dropdown-toggle icon-burger-mini" href="#"
                        role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                      </a>


                    </div>
                    <div class="sub-title">
                      <span class="mr-1">Sales of this year</span> |
                      <span class="mx-1">45%</span>
                      <i class="mdi mdi-arrow-up-bold text-success"></i>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                  <div class="card-header">
                    <h2>$14,500</h2>
                    <div class="dropdown">
                      <a class="dropdown-toggle icon-burger-mini" href="#"
                        role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                      </a>

                    </div>
                    <div class="sub-title">
                      <span class="mr-1">Expense of this year</span> |
                      <span class="mx-1">50%</span>
                      <i class="mdi mdi-arrow-down-bold text-danger"></i>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                  <div class="card-header">
                    <h2>$4199</h2>
                    <div class="dropdown">
                      <a class="dropdown-toggle icon-burger-mini" href="#"
                        role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                      </a>


                    </div>
                    <div class="sub-title">
                      <span class="mr-1">Profit of this year</span> |
                      <span class="mx-1">20%</span>
                      <i class="mdi mdi-arrow-down-bold text-danger"></i>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                  <div class="card-header">
                    <h2>$20,199</h2>
                    <div class="dropdown">
                      <a class="dropdown-toggle icon-burger-mini" href="#"
                        role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                      </a>

                    </div>
                    <div class="sub-title">
                      <span class="mr-1">Revenue of this year</span> |
                      <span class="mx-1">35%</span>
                      <i class="mdi mdi-arrow-up-bold text-success"></i>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer mt-auto">
          <div class="copyright bg-white">
            <p>
              &copy; <span id="copy-year"></span> Copyright Dashboard by ElPato
            </p>
          </div>
          <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
        </footer>

      </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/simplebar/simplebar.min.js"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="plugins/apexcharts/apexcharts.js"></script>

    <script
      src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="plugins/daterangepicker/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script>
                      jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
                    </script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="plugins/toaster/toastr.min.js"></script>

    <script src="js/mono.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/map.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>
