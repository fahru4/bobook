<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BOBOOK</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin-index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Divider -->
    <!-- Nav Item - Charts -->
    @if(Auth::guard('admin')->check())

    <li class="nav-item {{setAffect(['admin-book-index'])}}">
        <a href="{{route('admin-book-index')}}" class="nav-link {{setActive(['admin-book-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Book</span>
        </a>
    </li>

    <li class="nav-item {{setAffect(['admin-member-index'])}}">
        <a href="{{route('admin-member-index')}}" class="nav-link {{setActive(['admin-member-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Member</span>
        </a>
    </li>

    <li class="nav-item {{setAffect(['admin-transaction-index'])}}">
        <a href="{{route('admin-transaction-index')}}" class="nav-link {{setActive(['admin-transaction-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Transaction</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    @elseif(Auth::guard('member')->check())
    <li class="nav-item">
        <a class="nav-link" href="{{route('member-index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables Member</span></a>
    </li>

    <li class="nav-item {{setAffect(['member-transaction'])}}">
        <a href="{{route('member-transaction')}}" class="nav-link {{setActive(['member-transaction'])}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Transactions</span>
        </a>
    </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    

</ul>