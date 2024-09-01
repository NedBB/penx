

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    
    <div class="app-brand demo">
    <a href="{{route('dashboard')}}" class="app-brand-link">
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
            <a href="{{route('sub-head')}}" class="menu-link">
            <div data-i18n="Sub Head">Sub Head</div>
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

   
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Make Entries">Make Entries</div>
        </a>

        <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('omnibus')}}" class="menu-link">
            <div data-i18n="Omnibus">Omnibus</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('staff')}}" class="menu-link">
            <div data-i18n="Staff">Staff</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('national.officer')}}" class="menu-link">
            <div data-i18n="National Officers">National Officers</div>
            </a>
        </li>
         <li class="menu-item">
            <a href="{{route('t.t')}}" class="menu-link">
            <div data-i18n="T & T">T & T</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('allocation')}}" class="menu-link">
            <div data-i18n="Allocation">Allocation</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('income')}}" class="menu-link">
            <div data-i18n="Income">Income</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('loans')}}" class="menu-link">
            <div data-i18n="Loan">Loans</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('contract')}}" class="menu-link">
            <div data-i18n="Contract">Contract</div>
            </a>
        </li>
        </ul>
    </li>


    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-files"></i>
        <div data-i18n="Queries">Queries</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{route('deductions')}}" class="menu-link">
            <div data-i18n="Deductions">Deductions</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('contributory-pension')}}" class="menu-link">
            <div data-i18n="Contributionary Pension">Contributionary Pension</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('payment-schedule')}}" class="menu-link">
            <div data-i18n="Payment Schedule">Payment Schedule</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('staff-schedule')}}" class="menu-link">
            <div data-i18n="Staff Payment Schedule">Staff Payment Schedule</div>
            </a>
        </li>
        </ul>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
            <div data-i18n="Payroll">Payroll</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{route('payroll-staff')}}" class="menu-link">
            <div data-i18n="Staff Payroll">Staff Payroll</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('payroll-officer')}}" class="menu-link">
            <div data-i18n="National Payroll">National Payroll</div>
            </a>
        </li>
        </ul>
    </li>
   
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-receipt"></i>
        <div data-i18n="Ledgers">Ledgers</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('ledger-income')}}" class="menu-link">
            <div data-i18n="Income">Income</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('ledger-expenditure')}}" class="menu-link">
            <div data-i18n="Expenditure">Expenditure</div>
            </a>
        </li>
        {{-- <li class="menu-item">
            <a href="{{route('ledger-expenditure')}}" class="menu-link">
            <div data-i18n="Expenditure">Expenditure</div>
            </a>
        </li> --}}
        <li class="menu-item">
            <a href="{{route('ledger-year-expenditure')}}" class="menu-link">
            <div data-i18n="Yearly Expenditure">Yearly Expenditure</div>
            </a>
        </li>
        </ul>
    </li>
   

    </ul>
</aside>