   <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Astra Credit Companies - Geographic Information System</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">


                <ul class="nav navbar-nav navbar-right">

                   

                     <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">accessible</i>
                            <span class="label-count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Info User</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">account_box</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>{{Auth::user()->username}}</h4>
                                                <p>
                                                    <!-- <i class="material-icons">email</i>{{Auth::user()->email}} -->
                                                    <p style="color: #ffffff">Test</p>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">exit_to_app</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Sign Out</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Exit dari Website
                                                </p>

                                            </div>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- #END# Notifications -->


                
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->