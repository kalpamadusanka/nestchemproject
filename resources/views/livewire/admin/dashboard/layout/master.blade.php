<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Nestchem
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.8/lottie.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('admin/assets/demo/demo.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery and Daterangepicker Script -->
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>



    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">



    @livewireStyles
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    CT
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Creative Tim
                </a>
            </div>
            <div class="sidebar-wrapper ps ps--active-y" id="sidebar-wrapper">

                <div class="user">

                    <div class="info">

                        <div class="clearfix"></div>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini-icon">MP</span>
                                        <span class="sidebar-normal">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini-icon">EP</span>
                                        <span class="sidebar-normal">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sidebar-mini-icon">S</span>
                                        <span class="sidebar-normal">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <ul class="nav">
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" wire:navigate>
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#pagesExamples" class="collapsed" aria-expanded="false">
                            <i class="now-ui-icons design_image"></i>
                            <p>
                                System User
                            </p>
                        </a>

                        <div class="collapse" id="pagesExamples" style="">
                            <ul class="nav">

                                <li class="{{ request()->routeIs('admin.systemuser.manage') ? 'active' : '' }}">
                                    <a href="{{ route('admin.systemuser.manage') }}" wire:navigate>

                                        <span class="sidebar-normal"> Admin Management </span>
                                    </a>
                                </li>


                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#componentsExamples">

                            <i class="now-ui-icons education_atom"></i>

                            <p>
                                Section <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="componentsExamples">
                            <ul class="nav">
                                <li
                                    class="{{ request()->routeIs('admin.dashboard.dep.accounts.dashboard') || request()->routeIs('neo.payment.account.history') || request()->routeIs('admin.dashboard.accounts.do.receiving') ? 'active' : '' }}">
                                    <a href="{{ route('admin.dashboard.dep.accounts.dashboard') }}" wire:navigate>

                                        <span class="sidebar-normal"> Accounting </span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->routeIs('admin.dashboard.dep.production') || request()->routeIs('admin.dashboard.dep.production.material.dashboard') || request()->routeIs('admin.dashboard.dep.production.po.dashboard') || request()->routeIs('admin.dashboard.dep.production.po.create.po') || request()->routeIs('neo.material.stock.adjustment') || request()->routeIs('admin.dashboard.dep.production.material.request.list') || request()->routeIs('admin.dashboard.dep.production.supplier.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('admin.dashboard.dep.production') }}" wire:navigate>

                                        <span class="sidebar-normal"> Material </span>
                                    </a>
                                </li>
                                <li
                                class="{{ request()->routeIs('admin.dashboard.dep.manufacture') || request()->routeIs('admin.dashboard.dep.manufacture.material.request.dashboard') || request()->routeIs('admin.dashboard.material.add.request') || request()->routeIs('admin.dashboard.dep.manufacture.creating.manufacture.dashboard') || request()->routeIs('admin.dashboard.creating.new.manufacture.order') ? 'active' : '' }}">
                                <a href="{{ route('admin.dashboard.dep.manufacture') }}" wire:navigate>

                                    <span class="sidebar-normal"> Manufacture </span>
                                </a>
                            </li>
                            <li
                            class="{{ request()->routeIs('admin.dashboard.dep.product') || request()->routeIs('admin.dashboard.dep.manufacture.product.dashboard') || request()->routeIs('admin.dashboard.dep.manufacture.add.product') || request()->routeIs('admin.dashboard.stock.view') ||  request()->routeIs('admin.dashboard.dep.product.shelf.dashboard') || request()->routeIs('admin.dashboard.dep.product.adjustment')   ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard.dep.product') }}" wire:navigate>

                                <span class="sidebar-normal"> Product </span>
                            </a>
                        </li>
                        <li
                        class="{{ request()->routeIs('admin.dashboard.dep.sale') || request()->routeIs('admin.dashboard.dep.sale.do') || request()->routeIs('admin.dashboard.dep.sale.do.load') || request()->routeIs('admin.sale.do.load') || request()->routeIs('admin.dashboard.sale.customer.register') || request()->routeIs('admin.dashboard.dep.sale.distribute') || request()->routeIs('admin.sale.do.orders') || request()->routeIs('admin.sale.do.add.order') || request()->routeIs('admin.dashboard.dep.sale.unload') || request()->routeIs('admin.sale.do.order.payments')  ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.dep.sale') }}" wire:navigate>

                            <span class="sidebar-normal"> Sales </span>
                        </a>
                    </li>
                                <li
                                    class="{{ request()->routeIs('admin.dashboard.dep.human.resource') ||request()->routeIs('admin.dashboard.dep.human.resource.employee.addemployee') ||request()->routeIs('neo.existing.employee.view') ||request()->routeIs('neo.existing.employee.view.document') ||request()->routeIs('admin.dashboard.dep.human.resource.tickets.alltickets') ||request()->routeIs('admin.dashboard.dep.human.resource.tickets.view.alltickets') ||request()->routeIs('admin.dashboard.dep.human.resource.employee.attendence') ||request()->routeIs('neo.existing.employee.view.profile') ||request()->routeIs('admin.dashboard.dep.human.resource.employee.worksheet') ||request()->routeIs('admin.dashboard.dep.human.resource.worksheet.holiday') ||request()->routeIs('admin.dashboard.dep.human.resource.worksheet.workday') ||request()->routeIs('admin.dashboard.humanresource.attendence.attendencemonitor') ||request()->routeIs('admin.dashboard.dep.human.resource.company.assets') ||request()->routeIs('admin.dashboard.dep.human.resource.company.assets.add.types') ||request()->routeIs('admin.dashboard.dep.human.resource.company.assets.add.department') ||request()->routeIs('admin.dashboard.dep.human.resource.company.expenses') ||request()->routeIs('admin.dashboard.humanresource.expenses.expensecategory.dashboard') ||request()->routeIs('admin.dashboard.humanresource.expenses.payment.methods.dashboard') ||request()->routeIs('admin.dashboard.dep.human.resource.data.collection') ||request()->routeIs('admin.dashboard.dep.human.resource.datacollection.collection')? 'active': '' }}">
                                    <a href="{{ route('admin.dashboard.dep.human.resource') }}" wire:navigate>

                                        <span class="sidebar-normal"> HRM </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/components/grid.html">
                                        <span class="sidebar-normal"> Marketing Dep </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/components/panels.html">
                                        <span class="sidebar-normal"> IT Dep </span>
                                    </a>
                                </li>


                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#formsExamples">

                            <i class="now-ui-icons files_single-copy-04"></i>

                            <p>
                                Forms <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="formsExamples">
                            <ul class="nav">

                                <li>
                                    <a href="../examples/forms/regular.html">
                                        <span class="sidebar-mini-icon">RF</span>
                                        <span class="sidebar-normal"> Regular Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/forms/extended.html">
                                        <span class="sidebar-mini-icon">EF</span>
                                        <span class="sidebar-normal"> Extended Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/forms/validation.html">
                                        <span class="sidebar-mini-icon">V</span>
                                        <span class="sidebar-normal"> Validation Forms </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/forms/wizard.html">
                                        <span class="sidebar-mini-icon">W</span>
                                        <span class="sidebar-normal"> Wizard </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#tablesExamples">

                            <i class="now-ui-icons design_bullet-list-67"></i>

                            <p>
                                Tables <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="tablesExamples">
                            <ul class="nav">

                                <li>
                                    <a href="../examples/tables/regular.html">
                                        <span class="sidebar-mini-icon">RT</span>
                                        <span class="sidebar-normal"> Regular Tables </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/tables/extended.html">
                                        <span class="sidebar-mini-icon">ET</span>
                                        <span class="sidebar-normal"> Extended Tables </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/tables/datatables.net.html">
                                        <span class="sidebar-mini-icon">DT</span>
                                        <span class="sidebar-normal"> DataTables.net </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a data-toggle="collapse" href="#mapsExamples">

                            <i class="now-ui-icons location_pin"></i>

                            <p>
                                Maps <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse " id="mapsExamples">
                            <ul class="nav">

                                <li>
                                    <a href="../examples/maps/google.html">
                                        <span class="sidebar-mini-icon">GM</span>
                                        <span class="sidebar-normal"> Google Maps </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/maps/fullscreen.html">
                                        <span class="sidebar-mini-icon">FM</span>
                                        <span class="sidebar-normal"> Full Screen Map </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="../examples/maps/vector.html">
                                        <span class="sidebar-mini-icon">VM</span>
                                        <span class="sidebar-normal"> Vector Map </span>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </li>

                    <li>


                        <a href="../examples/widgets.html">

                            <i class="now-ui-icons objects_diamond"></i>

                            <p>Widgets</p>
                        </a>

                    </li>

                    <li>


                        <a href="../examples/charts.html">

                            <i class="now-ui-icons business_chart-pie-36"></i>

                            <p>Charts</p>
                        </a>

                    </li>

                    <li>


                        <a href="../examples/calendar.html">

                            <i class="now-ui-icons media-1_album"></i>

                            <p>Calendar</p>
                        </a>

                    </li>



                </ul>
                <div class="ps__rail-x" style="left: 0px; bottom: -132px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 132px; height: 162px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 18px; height: 23px;"></div>
                </div>
            </div>
        </div>
        {{ $slot }}
        @livewireScripts
    </div>
    <!--   Core JS Files   -->

    <script src="{{ asset('admin/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('admin/assets/js/plugins/bootstrap-notify.js') }}"></script>

    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/assets/js/now-ui-dashboard.min.js?v=1.5.0') }}"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('admin/assets/demo/demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
</body>

</html>
