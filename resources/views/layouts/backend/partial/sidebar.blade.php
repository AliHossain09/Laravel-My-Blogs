<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="https://png.pngtree.com/png-clipart/20240709/original/pngtree-casual-man-flat-design-avatar-profile-picture-vector-png-image_15526568.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                        
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i> Sign Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    {{--  @if (Auth::user()->role == 'admin') --}}
                    @if (Request::is ('admin*'))
                    {{-- Dashboard Menu --}}
                        <li class="{{ (Request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('admin.admin.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Tag Menu --}}
                    <li class="{{ (Request()->is('admin/tag*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.tag.index') }}">
                            <i class="material-icons">label</i>
                            <span>Tag</span>
                        </a>
                    </li>
                    
                    {{-- Category Menu --}}
                    <li class="{{ (Request()->is('admin/category*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">
                            <i class="material-icons">apps</i>
                            <span>Category</span>
                        </a>
                    </li>

                    {{-- Post Menu --}}
                    <li class="{{ (Request()->is('admin/post*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.post.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>
                    {{-- pending Menu --}}
                    <li class="{{ (Request()->is('admin/pending/post*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.post.pending') }}">
                            <i class="material-icons">pending</i>
                            <span>Pending Post</span>
                        </a>
                    </li>

                    {{-- Divider Menu --}}
                    <li class="header">System</li>

                    {{-- Logout Menu --}}
                    <li>
                       <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                    @endif

                    @if (request::is ('author*'))
                    <li class="{{ (Request()->is('author/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('author.author.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    {{-- Post Menu --}}
                    <li class="{{ (Request()->is('author/post*')) ? 'active' : '' }}">
                        <a href="{{ route('author.post.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>

                    {{-- Divider Menu --}}
                    <li class="header">System</li>

                    {{-- Logout Menu --}}
                    <li class="active">
                       <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                        
                    @endif

                    
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Admin Footer -->
            @if (Request::is ('admin*'))
            <div class="legal">
                <div class="copyright">
                    
                    &copy; 2016 - 2017 <a href="javascript:void(0);">Admin - Dashboard</a>.
                </div>
                <div class="version">
                    <b>Designed & Powered by : </b> ALI HOSSAIN
                </div>
            </div>
            <!-- # Admin Footer End -->
            @endif
           
           &copy; 2016 - 2017 <a href="javascript:void(0);">{{ (Request()->is('admin/dashboard')) ? 'Admin - Dashboard' : 'Author- Dashboard' }}</a>.
            
           
           <!-- Author Footer -->
            
            {{-- @if (Request::is ('author*'))
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">Author- Dashboard</a>.
                </div>
                <div class="version">
                    <b>Created: </b> ALI HOSSAIN
                </div>
            </div> 
            @endif --}}

            <!-- # Author Footer End -->
            
        </aside>