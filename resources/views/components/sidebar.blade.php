
<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img class="center-block" src="{{asset('images/astra_2.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->username}}</div>
                    <!-- <div class="email">{{Auth::user()->email}}</div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                           
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a></li>
                              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu"  id="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>


                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">layers</i>
                            <span>Master Data</span>
                        </a>

                        <ul class="ml-menu">

                         <li >
                                <a href="{{route('admin.informasi_arho')}}">
                                    <span>ARHO</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.informasi_kecamatan')}}">
                                    <span>Kecamatan</span>
                                </a>
                            </li>

                             <li>
                                <a href="{{route('admin.informasi_kelurahan')}}">
                                    <span>Kelurahan</span>
                                </a>
                            </li>


                        </ul>


                    </li>

                    <li id="menu-upload-file">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">cloud</i>
                            <span>Upload</span>
                        </a>

                         <ul class="ml-menu">

                            <!-- <li>
                                <a href="{{route('admin.upload_file')}}">
                                    <span>File Laporan</span>
                                </a>
                            </li>

                             <li>
                                <a href="{{route('admin.import_file_handling_arho')}}">
                                    <span>File Handling Arho</span>
                                </a>
                            </li>
 -->
                             <li>
                                <a href="{{route('admin.laporan.target_arho')}}">
                                    <span>Target Perusahaan</span>
                                </a>
                            </li>


                             <li>
                                <a href="{{route('admin.import_laporan_handling')}}">
                                    <span>Laporan Handling</span>
                                </a>
                            </li>
                           
                            <li>
                                <a href="{{route('admin.upload_file_actual_arho')}}">
                                    <span>Actual ARHO</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.upload_file_osa')}}">
                                    <span>OSA dan ACC</span>
                                </a>
                            </li>
                           

                            <!--  <li>
                                <a href="{{route('admin.laporan.upload_warna_arho')}}">
                                    <span>Warna ARHO</span>
                                </a>
                            </li> -->

                           <!--   <li id="menu-informasi-arho">
                                <a href="{{route('admin.informasi_arho')}}">
                                    <span>Informasi Arho</span>
                                </a>
                            </li> -->

                            
                        </ul>

                    </li>

                  

                  <!--    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">computer</i>
                            <span>Laporan</span>
                        </a>

                        <ul class="ml-menu">
                            <li id="menu-informasi-arho">
                                <a href="{{route('admin.laporan.status_customer')}}">
                                    <span>Status Customer</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.laporan.target_arho')}}">
                                    <span>Data Target Arho</span>
                                </a>
                            </li>

                            
                        </ul>
                    </li>
 -->

                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">public</i>
                            <span>Visualisasi Data</span>
                        </a>

                        <ul class="ml-menu">
                           <!--  <li>
                                <a href="{{route('admin.visualisasi.umum')}}">
                                    <span>Umum</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="{{route('admin.visualisasi.arho')}}">
                                    <span>ARHO</span>
                                </a>
                            </li>  

                             <li>
                                <a href="{{route('admin.visualisasi.kecamatan')}}">
                                    <span>KECAMATAN</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.visualisasi.customer')}}">
                                    <span>CUSTOMER</span>
                                </a>
                            </li>


                                                      
                        </ul>
                    </li>   
                   
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
</section>