<div class="main-menu menu-static menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

           <!--  <li class="nav-item {{ \StringHelper::setActive(['institution_dashboard.show']) }}" >
                <a href="{{ route('institution_dashboard.show') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li> -->

            @can('hasLicencePurchased')

                <li class="nav-item {{ \StringHelper::setActive(['institution_patients.*']) }}" >
                    <a href="{{ route('institution_patients.list') }}">
                        <i class="ft-users"></i>
                        <span class="menu-title">Patients</span>
                    </a>
                </li>

                <li class="nav-item {{ \StringHelper::setActive(['institution_maps.*']) }}" >
                    <a href="{{ route('institution_maps.list') }}">
                        <i class="ft-map-pin"></i>
                        <span class="menu-title">Map</span>
                    </a>
                </li>

                @can('isCountryHead')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_institutions.*']) }}" >
                        <a href="{{ route('institution_institutions.list') }}">
                            <i class="la la-hospital-o"></i>
                            <span class="menu-title">Health Institutions</span>
                        </a>
                    </li>
                @endcan

                @can('isInstitution')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_doctors.*']) }}" >
                        <a href="{{ route('institution_doctors.list') }}">
                            <i class="la la-stethoscope"></i>
                            <span class="menu-title">Doctors</span>
                        </a>
                    </li>
                @endcan

                <li class="nav-item {{ \StringHelper::setActive(['institution_messages.*']) }}" >
                    <a href="{{ route('institution_messages.list') }}">
                        <i class="la la-bullhorn"></i>
                        <span class="menu-title">Messages</span>
                    </a>
                </li>

                <li class="nav-item {{ \StringHelper::setActive(['institution_diseases.*']) }}" >
                    <a href="{{ route('institution_diseases.list') }}">
                        <i class="la la-bug"></i>
                        <span class="menu-title">Diseases</span>
                    </a>
                </li>

                @can('isCountryHead')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_risk_level.*']) }}" >
                        <a href="{{ route('institution_risk_level.editRiskLevel') }}">
                            <i class="ft-alert-triangle"></i>
                            <span class="menu-title">Risk Level</span>
                        </a>
                    </li>
                @endcan

                <li class="nav-item {{ \StringHelper::setActive(['institution_statistics.*']) }}" >
                    <a href="{{ route('institution_statistics.list') }}">
                        <i class="ft-activity"></i>
                        <span class="menu-title">Statistics</span>
                    </a>
                </li>

                @can('isInstitution')
                    <li class="nav-item {{ \StringHelper::setActive(['institution_quarantine.*']) }}" >
                        <a href="{{ route('institution_quarantine.listQuarantine') }}">
                            <i class="ft-shield"></i>
                            <span class="menu-title">Self Quarantine</span>
                        </a>
                    </li>
                @endcan

            @endcan

        </ul>
    </div>
</div>