<div class="sidebar active">
    <div class="menu-btn">
        <i class="ph-bold ph-caret-left" style="font-size: 24px; color: #000000;"></i>
    </div>
    <div class="head">
        <div class="user-img">
            <img src="{{ asset('img/3.jpg') }}" alt="">
        </div>
        <div class="user-details">
            <p class="title">{{ Auth::user()->name }}</p>
            <p class="name">{{ Auth::user()->email }}</p>
        </div>
    </div>
    <div class="nav">
        <div class="menu">
            <p class="title">Main</p>
            <ul>
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="icon ph-bold ph-house-simple" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon ph-bold ph-user" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">users</span>
                        <i class="arrow ph-bold ph-caret-down" ></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#"><span class="text">Users</span></a></li>
                        <li><a href="#"><span class="text">xd</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="icon ph-bold ph-file-text" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">posts</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('recursoshumanos.createuser') || request()->routeIs('recursoshumanos.ocuper') ? 'active' : '' }}">
                    <a href="#">
                        <i class="icon ph-bold ph-calendar-blank" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">Recursos Humanos</span>
                        <i class="arrow ph-bold ph-caret-down"></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ request()->routeIs('recursoshumanos.createuser') ? 'active' : '' }}">
                            <a href="{{ route('recursoshumanos.createuser') }}">
                                <span class="text">Crear Usuario</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('recursoshumanos.ocuper') ? 'active' : '' }}">
                            <a href="{{ route('recursoshumanos.ocuper') }}">
                                <span class="text">Ocupacion y Permisos</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="icon ph-bold ph-chart-bar" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">icone</span>
                        <i class="arrow ph-bold ph-caret-down" style="font-size: 24px; color: #000000;"></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#"><span class="text">Users</span></a></li>
                        <li><a href="#"><span class="text">xd</span></a></li>
                        <li><a href="#"><span class="text">peri.once</span></a></li>
                        <li><a href="#"><span class="text">psadasdad</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu">
            <p class="title">Warehouse</p>
            <ul>
                <li>
                    <a href="{{ route('Warehouses') }}">
                        <i class="ph ph-warehouse ph-bold" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">Warehouse</span>
                    </a>

                </li>
            </ul>
        </div>
        <div class="menu">
            <p class="title">Message</p>
            <ul>
                <li>
                    <a href="{{ route('messages.index') }}">
                        <i class="icon ph-bold ph-chat" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">Messages</span>
                        @if(isset($unreadMessages) && $unreadMessages > 0)
                            <span class="notification-badge">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        <div class="menu">
            <p class="title">Settings</p>
            <ul>
                <li>
                    <a href="#">
                        <i class="icon ph-bold ph-gear" style="font-size: 24px; color: #000000;"></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="menu">
        <p class="title">Account</p>
        <ul>
            <li>
                <a href="#">
                    <i class="icon ph-bold ph-info" style="font-size: 24px; color: #000000;"></i>
                    <span class="text">Help</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon ph-bold ph-sign-out" style="font-size: 24px; color: #000000;"></i>
                    <span class="text">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
