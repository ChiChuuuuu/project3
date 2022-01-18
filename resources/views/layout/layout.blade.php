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
            <div class="user">
                <div class="info">
                    <div class="photo">
                        <img src="{{ asset('assets') }}/img/default-avatar.png" />
                    </div>

                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        <span>
                            Tania Andrew
                            <b class="caret"></b>
                        </span>
                    </a>

                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#pablo">
                                    <span class="sidebar-mini">MP</span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>

                            <li>
                                <a href="#pablo">
                                    <span class="sidebar-mini">EP</span>
                                    <span class="sidebar-normal">Edit Profile</span>
                                </a>
                            </li>

                            <li>
                                <a href="#pablo">
                                    <span class="sidebar-mini">S</span>
                                    <span class="sidebar-normal">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="nav">
                <li>
                    <a href="/">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#pagesExamples">
                        <i class="pe-7s-gift"></i>
                        <p>Sách
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="pagesExamples">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('book.index') }}">
                                    <span class="sidebar-mini">DS</span>
                                    <span class="sidebar-normal">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bbook.index') }}">
                                    <span class="sidebar-mini">MS</span>
                                    <span class="sidebar-normal">Mượn sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rbook.index') }}">
                                    <span class="sidebar-mini">TS</span>
                                    <span class="sidebar-normal">Trả sách</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('student.index') }}">
                        <i class="pe-7s-graph1"></i>
                        <p>Thẻ thư viện</p>
                    </a>
                </li>

                <li>
                    <a href="{{ route('history.index') }}">
                        <i class="pe-7s-graph1"></i>
                        <p>Lịch sử</p>
                    </a>
                </li>

                <li>
                    <a data-toggle="collapse" href="#manament">
                        <i class="pe-7s-gift"></i>
                        <p>Quản lí
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="manament">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('author.index') }}">
                                    <span class="sidebar-mini">TG</span>
                                    <span class="sidebar-normal">Tác giả</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">
                                    <span class="sidebar-mini">TL</span>
                                    <span class="sidebar-normal">Thể loại</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shelf.index') }}">
                                    <span class="sidebar-mini">TS</span>
                                    <span class="sidebar-normal">Tủ sách</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        @yield('main')
    </div>

</body>
<!--   Core JS Files  -->
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

<script type="text/javascript">
    $(document).ready(function() {

        demo.initDashboardPageCharts();
        demo.initVectorMap();
    });
</script>


</html>
