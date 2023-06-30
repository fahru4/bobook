<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BOBOOK</div>
    </a>

 

    <!-- Divider -->
    <!-- Nav Item - Charts -->
    @if(Auth::guard('admin')->check())

       <!-- Divider -->
       <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item {{setActive(['admin-index'])}}">
           <a class="nav-link" href="{{route('admin-index')}}">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
       </li>
   
       <!-- Divider -->
   
       <!-- Heading -->
       <div class="sidebar-heading">
           Interface
       </div>

    <li class="nav-item {{setActive(['admin-book-index'])}}">
        <a class="nav-link {{setAffect(['admin-book-index'])}}" href="{{route('admin-book-index')}}" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Book</span>
        </a>
        <div id="collapseUtilities" class="collapse {{setAffect(['admin-book-index'])}}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Book:</h6>
                <a href="{{route('admin-book-index')}}" class="collapse-item {{setActive(['admin-book-index'])}}">Master Book</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    {{-- <li class="nav-item {{setActive(['admin-book-index'])}}">
        <a href="{{route('admin-book-index')}}" class="nav-link {{setAffect(['admin-book-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Book</span>
        </a>
    </li> --}}

    <li class="nav-item {{setActive(['admin-member-index'])}}">
        <a href="{{route('admin-member-index')}}" class="nav-link {{setAffect(['admin-member-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Member</span>
        </a>
    </li>

    <li class="nav-item {{setActive(['admin-transaction-index'])}}">
        <a href="{{route('admin-transaction-index')}}" class="nav-link {{setAffect(['admin-transaction-index'])}}">
            <i class="dripicons-user"></i>
            <span>Master Transaction</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    @elseif(Auth::guard('member')->check())

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{setActive(['member-index'])}}">
        <a class="nav-link" href="{{route('member-index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('member-index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables Member</span></a>
    </li> --}}

    <li class="nav-item {{setActive(['member-transaction'])}} ">
        <a href="{{route('member-transaction')}}" class="nav-link {{setAffect(['member-transaction'])}}">
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