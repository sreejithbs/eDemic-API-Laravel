<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @cannot('hasLicencePurchased')
                <li class="nav-item {{ \StringHelper::setActive(['institution_dashboard.show']) }}" >
                    <a href="{{ route('institution_dashboard.show') }}">
                        <i class="la la-home"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
            @endcannot

            @can('hasLicencePurchased')

                <li class="nav-item" >
                    <a href="javascript:void(0);">
                        <i class="ft-users"></i>
                        <span class="menu-title">Patients</span>
                    </a>
                </li>

                <li class="nav-item" >
                    <a href="javascript:void(0);">
                        <i class="ft-map-pin"></i>
                        <span class="menu-title">Map</span>
                    </a>
                </li>

                @can('isCountryHead')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_institutions.list']) }}" >
                        <a href="{{ route('institution_institutions.list') }}">
                            <i class="la la-hospital-o"></i>
                            <span class="menu-title">Health Institutions</span>
                        </a>
                    </li>
                @endcan

                @can('isInstitution')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_doctors.list']) }}" >
                        <a href="{{ route('institution_doctors.list') }}">
                            <i class="la la-stethoscope"></i>
                            <span class="menu-title">Doctors</span>
                        </a>
                    </li>
                @endcan

                <li class="nav-item {{ \StringHelper::setActive(['institution_messages.list']) }}" >
                    <a href="{{ route('institution_messages.list') }}">
                        <i class="la la-bullhorn"></i>
                        <span class="menu-title">Messages</span>
                    </a>
                </li>

                <li class="nav-item {{ \StringHelper::setActive(['institution_diseases.list']) }}" >
                    <a href="{{ route('institution_diseases.list') }}">
                        <i class="la la-bug"></i>
                        <span class="menu-title">Diseases</span>
                    </a>
                </li>

                @can('isCountryHead')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_diseases.editRiskLevel']) }}" >
                        <a href="javascript:void(0);">
                        <!-- <a href="{{ route('institution_diseases.editRiskLevel') }}"> -->
                            <i class="ft-alert-triangle"></i>
                            <span class="menu-title">Risk Level</span>
                        </a>
                    </li>
                @endcan

                <li class="nav-item" >
                    <a href="javascript:void(0);">
                        <i class="ft-activity"></i>
                        <span class="menu-title">Statistics</span>
                    </a>
                </li>

                @can('isInstitution')
                    <li class="nav-item" >
                        <a href="javascript:void(0);">
                            <i class="ft-shield"></i>
                            <span class="menu-title">Self Quarantine</span>
                        </a>
                    </li>
                @endcan

                <li class="nav-item" >
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-formId').submit();">
                        <i class="ft-power"></i>
                        <span class="menu-title">Signout</span>
                    </a>
                    <form id="logout-formId" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

            @endcan

        </ul>
    </div>
</div>