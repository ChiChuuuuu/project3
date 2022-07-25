<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard PRO by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="{{ asset('assets') }}/css/light-bootstrap-dashboard.css?v=1.4.1" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets') }}/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>

    <div class="sidebar" data-color="black" data-image="{{ asset('assets') }}/img/background.jpg">
        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                Ct
            </a>

            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                Creative Tim
            </a>
        </div>

        <div class="sidebar-wrapper">


            <ul class="nav">
                <li>
                    <a href="{{ url('/online') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        @yield('main')
    </div>

</body>
<!--   Core JS Files  -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="{{ asset('assets') }}/js/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>



<!--  Forms Validations Plugin -->
<script src="{{ asset('assets') }}/js/jquery.validate.min.js"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ asset('assets') }}/js/moment.min.js"></script>

<!--  Date Time Picker Plugin is included in this js file -->
<script src="{{ asset('assets') }}/js/bootstrap-datetimepicker.min.js"></script>

<!--  Select Picker Plugin -->
<script src="{{ asset('assets') }}/js/bootstrap-selectpicker.js"></script>

<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
<script src="{{ asset('assets') }}/js/bootstrap-switch-tags.min.js"></script>

<!--  Charts Plugin -->
<script src="{{ asset('assets') }}/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('assets') }}/js/bootstrap-notify.js"></script>

<!-- Sweet Alert 2 plugin -->
<script src="{{ asset('assets') }}/js/sweetalert2.js"></script>

<!-- Vector Map plugin -->
<script src="{{ asset('assets') }}/js/jquery-jvectormap.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Wizard Plugin    -->
<script src="{{ asset('assets') }}/js/jquery.bootstrap.wizard.min.js"></script>

<!--  Bootstrap Table Plugin    -->
<script src="{{ asset('assets') }}/js/bootstrap-table.js"></script>

<!--  Plugin for DataTables.net  -->
<script src="{{ asset('assets') }}/js/jquery.datatables.js"></script>


<!--  Full Calendar Plugin    -->
<script src="{{ asset('assets') }}/js/fullcalendar.min.js"></script>

<!-- Light Bootstrap Dashboard Core javascript and methods -->
<script src="{{ asset('assets') }}/js/light-bootstrap-dashboard.js?v=1.4.1"></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets') }}/js/demo.js"></script>

<script src="{{ asset('assets') }}/js/online-select.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        demo.initDashboardPageCharts();
        demo.initVectorMap();
    });
</script>


</html>
