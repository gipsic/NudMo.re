<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Bootstrap Admin App + jQuery">
        <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- =============== VENDOR STYLES ===============-->
        <!-- FONT AWESOME-->
        <link rel="stylesheet" href="/vendor/fontawesome/css/font-awesome.min.css">
        <!-- SIMPLE LINE ICONS-->
        <link rel="stylesheet" href="/vendor/simple-line-icons/css/simple-line-icons.css">
        <!-- ANIMATE.CSS-->
        <link rel="stylesheet" href="/vendor/animate.css/animate.min.css">
        <!-- WHIRL (spinners)-->
        <link rel="stylesheet" href="/vendor/whirl/dist/whirl.css">
        <!-- =============== PAGE VENDOR STYLES ===============-->
        <!-- JQCLOUD-->
        <link rel="stylesheet" href="/vendor/jqcloud2/dist/jqcloud.css">
        <!-- =============== BOOTSTRAP STYLES ===============-->
        <link rel="stylesheet" href="/css/bootstrap.css" id="bscss">
        <!-- =============== APP STYLES ===============-->
        <link rel="stylesheet" href="/css/app.css" id="maincss">

        <script src="/vendor/jquery/dist/jquery.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
        </script>

    </head>

    <body>
        <div class="wrapper">
            <!-- top navbar-->
            <div id="header">
                <header class="topnavbar-wrapper">
                    <!-- START Top Navbar-->
                    <nav role="navigation" class="navbar topnavbar">
                        <!-- START navbar header-->
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand">
                                <div class="brand-logo">
                                    <img src="/img/logo.png" alt="{{ config('app.name', 'Laravel') }}" style="height:32px;" class="img-responsive">
                                </div>
                                <div class="brand-logo-collapsed">
                                    <img src="/img/logo-single.png" alt="{{ config('app.name', 'Laravel') }}" class="img-responsive">
                                </div>
                            </a>
                        </div>
                        <!-- END navbar header-->
                        <!-- START Nav wrapper-->
                        <div class="nav-wrapper">
                            <!-- START Left navbar-->
                            <ul class="nav navbar-nav">
                                <li>
                                    <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                                    <a href="#" data-trigger-resize="" data-toggle-state="aside-collapsed" class="hidden-xs"><em class="fa fa-navicon"></em></a>
                                    <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                                    <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle"><em class="fa fa-navicon"></em></a>
                                </li>
                            </ul>
                            <!-- END Left navbar-->
                            <!-- START Right Navbar-->
                            <ul class="nav navbar-nav navbar-right">
                                @if (!Auth::guest())
								<li>
									<a>สวัสดี {{$current_user->name}} {{$current_user->surname}}</a>
								</li>
                                <!-- START Alert menu-->
                                <li>
                                    <a href="/profile"><em class="icon-user"></em></a>
                                </li>
                                <!-- END Alert menu-->
                                @endif
                                <!-- Fullscreen (only desktops)-->
                                <li class="visible-lg">
                                    <a href="#" data-toggle-fullscreen=""><em class="fa fa-expand"></em></a>
                                </li>
                                @if (!Auth::guest())
                                <!-- START Offsidebar button-->
                                <li>
                                    <a href="{{ url('/logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="icon-logout"></em></a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                </li>
                                @endif
                                <!-- END Offsidebar menu-->
                            </ul>
                            <!-- END Right Navbar-->
                            <!-- END Right Navbar-->
                        </div>
                        <!-- END Nav wrapper-->
                    </nav>
                    <!-- END Top Navbar-->
                </header>
            </div>
            <!-- Main section-->
            <aside class="aside">
                <div id="side">
                    <!-- sidebar-->

                    <!-- START Sidebar (left)-->
                    <div class="aside-inner">
                        <nav data-sidebar-anyclick-close="" class="sidebar">
                            <!-- START sidebar nav-->
                            <ul class="nav">
                                <!-- Iterates over all sidebar items-->
                                @if (Auth::guest())
                                <li class="nav-heading "><span>ยินดีต้อนรับ</span></li>
								<li><a href="{{ url('/login') }}"><em class="fa fa-sign-in"></em><span>เข้าสู่ระบบ</span></a></li>
								<li><a href="{{ url('/register') }}"><em class="fa fa-users"></em><span>ลงทะเบียน</span></a></li>
                                @else
								
                                @if ($current_user->isPatient())
                                <li class="nav-heading "><span>เมนูสำหรับผู้ใช้งาน</span></li>
                                <li class=" "><a href="/profile" title="แก้ไขข้อมูลส่วนตัว"><em class="icon-user"></em><span>แก้ไขข้อมูลส่วนตัว</span></a></li>
                                <li class=" "><a href="/appointment/patient" title=" จัดการตารางนัดหมาย "><em class="fa fa-calendar"></em><span> จัดการการนัดหมาย </span></a></li>
                                <li class=" "><a href="/record/patient" title=" ดูประวัติการรักษา "><em class="fa fa-stethoscope"></em><span>ดูประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/prescription/patient" title=" ดูประวัติการรับยา "><em class="fa fa-list"></em><span> ดูประวัติการรับยา </span></a></li>
                                @endif
								
                                @if ($current_user->isAdministrator())
                                <li class="nav-heading "><span>เมนูสำหรับผู้ดูแลระบบ</span></li>
                                <li class=" "><a href="/profile/list" title="จัดการผู้ใช้งานระบบ"><em class="icon-people"></em><span>จัดการผู้ใช้งานระบบ</span></a></li>
                                <li class=" "><a href="/schedule/staff" title="จัดการตารางออกตรวจ"><em class="fa fa-table"></em><span>จัดการตารางออกตรวจ</span></a></li>
                                <li class=" "><a href="/appointment/staff" title="จัดการตารางนัดหมาย"><em class="fa fa-calendar"></em><span>จัดการตารางนัดหมาย</span></a></li>
                                <li class=" "><a href="/record/staff" title="จัดการประวัติการรักษา"><em class="fa fa-file-text-o"></em><span>จัดการประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/medicine" title="จัดการรายการยา"><em class="fa fa-medkit"></em><span>จัดการรายการยา</span></a></li>
                                <li class=" "><a href="/prescription" title="จัดการประวัติการสั่งยา"><em class="fa fa-list-alt"></em><span>จัดการประวัติการสั่งยา</span></a></li>
								
                                @elseif ($current_user->isStaff())
                                <li class="nav-heading "><span>เมนูสำหรับเจ้าหน้าที่</span></li>
                                <li class=" "><a href="/profile/list" title="จัดการผู้ใช้งานระบบ"><em class="icon-people"></em><span>จัดการผู้ใช้งานระบบ</span></a></li>
                                <li class=" "><a href="/schedule/staff" title="จัดการตารางออกตรวจ"><em class="fa fa-table"></em><span>จัดการตารางออกตรวจ</span></a></li>
                                <li class=" "><a href="/appointment/staff" title="จัดการตารางนัดหมาย"><em class="fa fa-calendar"></em><span>จัดการตารางนัดหมาย</span></a></li>
                                <li class=" "><a href="/record/staff" title="จัดการประวัติการรักษา"><em class="fa fa-file-text-o"></em><span>จัดการประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/prescription" title="จัดการประวัติการสั่งยา"><em class="fa fa-list-alt"></em><span>จัดการประวัติการสั่งยา</span></a></li>
                                
								@elseif ($current_user->isDoctor())
                                <li class="nav-heading "><span>เมนูสำหรับแพทย์</span></li>
                                <li class=" "><a href="/profile/list" title="จัดการผู้ใช้งานระบบ"><em class="icon-people"></em><span>จัดการผู้ใช้งานระบบ</span></a></li>
                                <li class=" "><a href="/schedule/doctor" title="จัดการตารางออกตรวจ"><em class="fa fa-table"></em><span>จัดการตารางออกตรวจ</span></a></li>
                                <li class=" "><a href="/appointment/doctor" title="จัดการตารางนัดหมาย"><em class="fa fa-calendar"></em><span>จัดการตารางนัดหมาย</span></a></li>
                                <li class=" "><a href="/record/staff" title="จัดการประวัติการรักษา"><em class="fa fa-file-text-o"></em><span>จัดการประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/prescription/doctor" title="จัดการประวัติการสั่งยา"><em class="fa fa-list-alt"></em><span>จัดการประวัติการสั่งยา</span></a></li>
                               
								@elseif ($current_user->isNurse())
                                <li class="nav-heading "><span>เมนูสำหรับพยาบาล</span></li>
                                <li class=" "><a href="/profile/list" title="จัดการผู้ใช้งานระบบ"><em class="icon-people"></em><span>จัดการผู้ใช้งานระบบ</span></a></li>
                                <li class=" "><a href="/record/staff" title="จัดการ ประวัติการรักษา"><em class="fa fa-file-text-o"></em><span>จัดการประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/prescription" title="จัดการ ประวัติการสั่งยา"><em class="fa fa-list-alt"></em><span>จัดการประวัติการสั่งยา</span></a></li>
                                
								@elseif ($current_user->isPharmacist())
                                <li class="nav-heading "><span>เมนูสำหรับเภสัชกร</span></li>
                                <li class=" "><a href="/profile/list" title="จัดการผู้ใช้งานระบบ"><em class="icon-people"></em><span>จัดการผู้ใช้งานระบบ</span></a></li>
                                <li class=" "><a href="/record/staff" title="จัดการ ประวัติการรักษา"><em class="fa fa-file-text-o"></em><span>จัดการประวัติการรักษา</span></a></li>
                                <li class=" "><a href="/medicine" title="จัดการ รายการยา"><em class="fa fa-medkit"></em><span>จัดการรายการยา</span></a></li>
                                <li class=" "><a href="/prescription" title="จัดการ ประวัติการสั่งยา"><em class="fa fa-list-alt"></em><span>จัดการประวัติการสั่งยา</span></a></li>
                                @endif


                                @endif
                            </ul>
                            <!-- END sidebar nav-->
                        </nav>
                    </div>
                    <!-- END Sidebar (left)-->

                </div>
            </aside>

            <section>

                @yield('content')

            </section>

            <!-- Page footer-->
            <footer>
                <span>&copy; 2016 - NudMo.re</span>
            </footer>

        </div>
        <!-- =============== VENDOR SCRIPTS ===============-->
        <!-- MODERNIZR-->
        <script src="/vendor/modernizr/modernizr.custom.js"></script>
        <!-- MATCHMEDIA POLYFILL-->
        <script src="/vendor/matchMedia/matchMedia.js"></script>
        <!-- JQUERY-->
        <script src="/vendor/jquery/dist/jquery.js"></script>
        <!-- BOOTSTRAP-->
        <script src="/vendor/bootstrap/dist/js/bootstrap.js"></script>
        <!-- STORAGE API-->
        <script src="/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
        <!-- JQUERY EASING-->
        <script src="/vendor/jquery.easing/js/jquery.easing.js"></script>
        <!-- ANIMO-->
        <script src="/vendor/animo.js/animo.js"></script>
        <!-- SLIMSCROLL-->
        <script src="/vendor/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- SCREENFULL-->
        <script src="/vendor/screenfull/dist/screenfull.js"></script>
        <!-- =============== PAGE VENDOR SCRIPTS ===============-->
        <!-- JQCLOUD-->
        <script src="/vendor/jqcloud2/dist/jqcloud.js"></script>
        <!-- Demo-->
        <script src="/js/demo/demo-jqcloud.js"></script>
        <!-- =============== APP SCRIPTS ===============-->
        <script src="/js/app.js"></script>
    </body>
</html>
