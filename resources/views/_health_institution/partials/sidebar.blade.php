<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ \StringHelper::setActive(['institution_dashboard.show']) }}" >
                <a href="{{ route('institution_dashboard.show') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>

            @can('isCountryHead')
                @can('hasLicencePurchased')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_institutions.*']) }}" >
                        <a href="{{ route('institution_institutions.list') }}">
                            <i class="la la-hospital-o"></i>
                            <span class="menu-title">Health Institutions</span>
                        </a>
                    </li>
                @endcan
            @endcan

            @can('hasLicencePurchased')
                <li class="nav-item {{ \StringHelper::setActive(['institution_diseases.*']) }}" >
                    <a href="{{ route('institution_diseases.list') }}">
                        <i class="la la-bug"></i>
                        <span class="menu-title">Diseases</span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</div>