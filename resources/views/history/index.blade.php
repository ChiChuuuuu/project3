@extends('layout.layout')
@section('main')

<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
                    <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                    <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                </button>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Extended Tables</a>
            </div>
            <div class="collapse navbar-collapse">

                <form class="navbar-form navbar-left navbar-search-form" role="search">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" value="" class="form-control" placeholder="Search...">
                    </div>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../charts.html">
                            <i class="fa fa-line-chart"></i>
                            <p>Stats</p>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-gavel"></i>
                            <p class="hidden-md hidden-lg">
                                Actions
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create New Post</a></li>
                            <li><a href="#">Manage Something</a></li>
                            <li><a href="#">Do Nothing</a></li>
                            <li><a href="#">Submit to live</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Another Action</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification">5</span>
                            <p class="hidden-md hidden-lg">
                                Notifications
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Notification 1</a></li>
                            <li><a href="#">Notification 2</a></li>
                            <li><a href="#">Notification 3</a></li>
                            <li><a href="#">Notification 4</a></li>
                            <li><a href="#">Another notification</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-with-icons">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-list"></i>
                            <p class="hidden-md hidden-lg">
                                More
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li>
                                <a href="#">
                                    <i class="pe-7s-mail"></i> Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-help1"></i> Help Center
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-tools"></i> Settings
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-lock"></i> Lock Screen
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-danger">
                                    <i class="pe-7s-close-circle"></i>
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                    <div class="card">
                        <div class="header">
                            <h4 class="title">Table with Links</h4>
                            <p class="category">Here is a subtitle for this table</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th>Job Position</th>
                                        <th class="text-right">Salary</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Andrew Mike</td>
                                        <td>Develop</td>
                                        <td class="text-right">&euro; 99,225</td>
                                        <td class="td-actions text-right">
                                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td class="text-center">2</td>
                                        <td>John Doe</td>
                                        <td>Design</td>
                                        <td class="text-right">&euro; 89,241</td>
                                        <td class="td-actions text-right">
                                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Alex Mike</td>
                                        <td>Design</td>
                                        <td class="text-right">&euro; 92,144</td>
                                        <td class="td-actions text-right">
                                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Mike Monday</td>
                                        <td>Marketing</td>
                                        <td class="text-right">&euro; 49,990</td>
                                        <td class="td-actions text-right">
                                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Paul Dickens</td>
                                        <td>Communication</td>
                                        <td class="text-right">&euro; 69,201</td>
                                        <td class="td-actions text-right">
                                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

        </div>
    </div>


</div>

@endsection
