<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <!-- <li class="nav-item {{ \StringHelper::setActive(['admin_dashboard.show']) }}" >
                <a href="{{ route('admin_dashboard.show') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li> -->

            <li class="nav-item {{ \StringHelper::setActive(['admin_accounts.list']) }}" >
                <a href="{{ route('admin_accounts.list') }}">
                    <i class="la la-server"></i>
                    <span class="menu-title">Accounts</span>
                </a>
            </li>

            <li class="nav-item {{ \StringHelper::setActive(['admin_health_heads.*']) }}" >
                <a href="{{ route('admin_health_heads.list') }}">
                    <i class="la la-h-square"></i>
                    <span class="menu-title">Health Heads</span>
                </a>
            </li>

            <li class="nav-item {{ \StringHelper::setActive(['admin_health_institutions.*']) }}" >
                <a href="{{ route('admin_health_institutions.list') }}">
                    <i class="la la-hospital-o"></i>
                    <span class="menu-title">Health Institutions</span>
                </a>
            </li>

            <li class="nav-item {{ \StringHelper::setActive(['admin_statistics.*']) }}" >
                <a href="{{ route('admin_statistics.list') }}">
                    <i class="ft-activity"></i>
                    <span class="menu-title">Statistics</span>
                </a>
            </li>

        </ul>
    </div>
</div>