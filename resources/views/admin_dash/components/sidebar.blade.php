<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="/admins"><img class="logo-icon me-2" src="{{asset('admin/assets/images/app-logo.svg')}}" alt="logo"><span class="logo-text">ADMIN</span></a>

        </div>
        <!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ (request()->is('admins')) ? 'active' : '' }}" href="/admins">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Overview</span>
                    </a>
                    <!--//nav-link-->
                </li>
                <!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle {{ (request()->is('admins/users')) ? 'active' : '' }} {{(request()->is('admins/withdraw')) ? 'active' : ''}}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-f" aria-expanded="false" aria-controls="submenu-1">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                        </svg>
                        </span>
                        <span class="nav-link-text">Users</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                        <!--//submenu-arrow-->
                    </a>
                    <!--//nav-link-->
                    <div id="submenu-f" class="collapse submenu submenu-1 {{(request()->is('admins/users')) ? 'show' : ''}} {{(request()->is('admins/withdraw')) ? 'show' : ''}}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/users')) ? 'active' : ''}}" href="/admins/users">All Users</a></li>
                        </ul>
                    </div>
                </li>
                <!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle {{(request()->is('admins/deposit')) ? 'active' : '' }} {{(request()->is('admins/contacts')) ? 'active' : '' }} {{(request()->is('admins/investments')) ? 'active' : ''}} {{(request()->is('admins/site')) ? 'active' : ''}}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Settings</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                        <!--//submenu-arrow-->
                    </a>
                    <!--//nav-link-->
                    <div id="submenu-1" class="collapse submenu submenu-1 {{(request()->is('admins/deposit')) ? 'show' : '' }} {{(request()->is('admins/contacts')) ? 'show' : '' }} {{(request()->is('admins/investments')) ? 'show' : '' }} {{(request()->is('admins/site')) ? 'show' : '' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/deposit')) ? 'active' : ''}}" href="/admins/deposit">Deposit Methods</a></li>
                            <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/contacts')) ? 'active' : ''}}" href="/admins/contacts">Contacts</a></li>
                            <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/investments')) ? 'active' : ''}}" href="/admins/investments">Investment Plans</a></li>
                            <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/site')) ? 'active' : ''}}" href="/admins/site">Site Settings</a></li>
                        </ul>
                    </div>
                </li>
                <!--//nav-item-->

                <li class="nav-item has-submenu">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link submenu-toggle {{(request()->is('dashboard/support/inbox')) ? 'active' : '' }} {{(request()->is('dashboard/support/new')) ? 'active' : ''}}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-5" aria-expanded="false" aria-controls="submenu-1">
                    <span class="nav-icon">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </span>
                    <span class="nav-link-text">Support Center</span>
                    <span class="submenu-arrow">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </span>
                    <!--//submenu-arrow-->
                </a>
                <!--//nav-link-->
                <div id="submenu-5" class="collapse submenu submenu-5 {{(request()->is('admins/inbox')) ? 'show' : ''}} " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item"><a class="submenu-link {{(request()->is('admins/inbox')) ? 'active' : ''}}" href="/admins/inbox">Inbox</a></li>
                    </ul>
                </div>
                </li>
                <!--//nav-item-->
            </ul>
            <!--//app-menu-->
        </nav>
        <!--//app-nav-->
        <form action="/logout" id='logout' method="POST">
            @csrf
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <li class="nav-item">
                        <a class="nav-link" style='cursor:pointer;' onclick="document.getElementById('logout').submit()">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Log Out</span>
                        </a>
                    </li>
                        <!--//nav-link-->
                </ul>
                <!--//footer-menu-->
            </nav>
        </div>
         </form>
        <!--//app-sidepanel-footer-->

    </div>
    <!--//sidepanel-inner-->
</div>
<!--//app-sidepanel-->
</header>

   <div class="app-wrapper">