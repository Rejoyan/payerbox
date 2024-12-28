<nav id="sidebar" class="bg-white border-right">

    <ul class="list-unstyled components">
        <li class="pb-3 bg-dark p-3 text-white">
            <a href="{!! route('dashboard') !!}"><i class="fas fa-user text-white"></i> My Dashboard</a>
        </li>
        <li class="pb-3 greenc p-3 text-white">
            <i class="fas fa-clock text-white"></i> Today:- {!! date('d/m/Y',time()) !!}    </li>


        <p>
            <a href="{!! route('dashboard') !!}">
                <img class="img-fluid pt-2" width="" src="{!! asset('asset/losgo.png') !!}" alt="LOGO" title="www.dextrosolution.com">
            </a>
        </p> 


<li class="pb-3 border-top pt-3"> <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold"><i class="far fa-life-ring"></i> Fetch Data</a>
            <ul class="collapse list-unstyled" id="pageSubmenu1">
                <li> <a href="{!! route('trx-rand-veiw') !!}" class="font-weight-bold">FETCH DATA FROM API</a> </li>
            </ul>
        </li>
        <li class="pb-3 border-top pt-3"> <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold"><i class="far fa-life-ring"></i> Payment Box</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li> <a href="{!! route('paybox') !!}" class="font-weight-bold">VIEW RECORD</a> </li>
            </ul>
        </li>
        <li class="pb-3 border-top pt-3"> <a href="#trxstatus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold"><i class="far fa-life-ring"></i> Trx Status</a>
            <ul class="collapse list-unstyled" id="trxstatus">
                <li> <a href="{!! route('trx-status-veiw',['status'=>1]) !!}" class="font-weight-bold">Paid Trx</a> </li>
                <li> <a href="{!! route('trx-status-veiw',['status'=>0]) !!}" class="font-weight-bold">UnPaid Trx</a> </li>
            </ul>
        </li>

        <li class="pb-3 border-top pt-3"> <a href="#systemSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold"><i class="fas fa-cogs"></i> Web Settings</a>
            <ul class="collapse list-unstyled" id="systemSubmenu">
                <li> <a href="" class="font-weight-bold">SITE SETTING</a> </li>
            </ul>
        </li>
        <li class=" pb-3 border-top pt-3"> <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold"><i class="fas fa-user"></i> User Profile</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li> <a href="" class="font-weight-bold">MANAGE USER</a> </li>
                <li> <a href="" class="font-weight-bold">CHANGE PASSWORD</a> </li>
            </ul>
        </li>
 



       

        <ul class="list-unstyled text-center">
            <li> 

                    <a href="{!! route('logout') !!}"  
                       class="download bg-dark border-0 text-white pl-0 pt-3 pb-3" title="Logout"
                       
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="main-icon fa fa-power-off"></i> 
                        Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                
            </li>
        </ul>

</nav>