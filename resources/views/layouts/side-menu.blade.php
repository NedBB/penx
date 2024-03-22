

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    
    <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo">
        <img src="{{asset('pension-logo.png')}}" style="width: 100%" >
        </span>
        <span class="app-brand-text demo menu-text">Nigeria Union <br>Of Pensioners</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Settings">Settings</div>
        <!-- <div class="badge bg-primary rounded-pill ms-auto">5</div> -->
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{route('contractors')}}" class="menu-link">
            <div data-i18n="Contractors">Contractors</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('conposs')}}" class="menu-link">
            <div data-i18n="Conpos">Conpos</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('group-head')}}" class="menu-link">
            <div data-i18n="Group Head">Group Head</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('loan')}}" class="menu-link">
            <div data-i18n="Loan">Loan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('bank')}}" class="menu-link">
            <div data-i18n="Bank">Bank</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('bank-account')}}" class="menu-link">
            <div data-i18n="Bank Account">Bank Account</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('state-parastatal')}}" class="menu-link">
            <div data-i18n="State & Parastatal">State & Parastatal</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('rank')}}" class="menu-link">
            <div data-i18n="Rank">Rank</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('system-users')}}" class="menu-link">
            <div data-i18n="System Users">System Users</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('departments')}}" class="menu-link">
            <div data-i18n="Departments">Departments</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('general-settings')}}" class="menu-link">
            <div data-i18n="General Settings">General Settings</div>
            </a>
        </li>
        </ul>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Make Entries">Make Entries</div>
        </a>

        <ul class="menu-sub">
        <li class="menu-item">
            <a href="layouts-collapsed-menu.html" class="menu-link">
            <div data-i18n="Omnibus">Omnibus</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-content-navbar.html" class="menu-link">
            <div data-i18n="Staff">Staff</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-content-navbar-with-sidebar.html" class="menu-link">
            <div data-i18n="National Officers">National Officers</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="../horizontal-menu-template" class="menu-link" target="_blank">
            <div data-i18n="T & T">T & T</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-without-menu.html" class="menu-link">
            <div data-i18n="Allocation">Allocation</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-without-navbar.html" class="menu-link">
            <div data-i18n="Income">Income</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-fluid.html" class="menu-link">
            <div data-i18n="Loan">Loan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-container.html" class="menu-link">
            <div data-i18n="Contract">Contract</div>
            </a>
        </li>
        </ul>
    </li>

    <!-- Front Pages -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-files"></i>
        <div data-i18n="Queries">Queries</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
            <div data-i18n="Deductions">Deductions</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
            <div data-i18n="Contributionary Pension">Contributionary Pension</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
            <div data-i18n="Payment Schedule">Payment Schedule</div>
            </a>
        </li>
        </ul>
    </li>

    <li class="menu-item">
        <a href="app-email.html" class="menu-link">
        <i class="menu-icon tf-icons ti ti-mail"></i>
        <div data-i18n="Payroll">Payroll</div>
        </a>
    </li>
    <!-- e-commerce-app menu start -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
        <div data-i18n="Ledgers">Ledgers</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
            <div data-i18n="Income">Income</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
            <div data-i18n="Expenditure">Expenditure</div>
            </a>
        </li>
        </ul>
    </li>
    <!-- e-commerce-app menu end -->

    </ul>
</aside>