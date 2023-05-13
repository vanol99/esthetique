<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('storage/uploads/'.auth()->user()->photo)}}" alt="user-img" title="{{auth()->user()->name}}" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block"
                   aria-expanded="false">{{ auth()->user()->name }}</a>
            </div>

            <p class="text-muted left-user-info">{{ auth()->user()->role }}</p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{route('profil')}}" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{route('destroy')}}">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @if(auth()->user()->user_type==1)
              {{--  <li>
                    <a href="{{route('estheticien.index')}}">
                        <i class="mdi mdi-owl"></i>
                        <span> Mes soins </span>
                    </a>
                </li>--}}
                <li>
                    <a href="{{route('planingown')}}">
                        <i class="mdi mdi-calendar-account"></i>
                        <span> Mon planing </span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->user_type==3 || auth()->user()->user_type==0)
                <li class="menu-title mt-2">Caisse</li>
                    <li>
                        <a href="{{route('facturation.index')}}">
                            <i class="mdi mdi-account-box-multiple"></i>
                            <span> Facturation </span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->user_type==0)
                <li class="menu-title mt-2">Apps</li>
                <li>
                    <a href="{{route('estheticien.index')}}">
                        <i class="mdi mdi-account-box-multiple"></i>
                        <span> Estheticien(e) </span>
                    </a>
                </li>
                    <li>
                        <a href="{{route('caisse.index')}}">
                            <i class="mdi mdi-account-cash"></i>
                            <span> Caissier(e) </span>
                        </a>
                    </li>
                <li>
                    <a href="{{route('customer.index')}}">
                        <i class="mdi mdi-account-group"></i>
                        <span> Clients </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('soin.index')}}">
                        <i class="mdi mdi-medical-bag"></i>
                        <span> Soins </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('typesoin.index')}}">
                        <i class="mdi mdi-forum"></i>
                        <span> Categories soins </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('conge.index')}}">
                        <i class="mdi mdi-calendar-account"></i>
                        <span> Conges </span>
                    </a>
                </li>
                    <li class="menu-title mt-2">Product</li>
                    <li>
                    <li>
                        <a href="{{route('product_type.index')}}">
                            <i class="mdi mdi-apps-box"></i>
                            <span> Categorie de produit </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('product.index')}}">
                            <i class="mdi mdi-box"></i>
                            <span> Produit </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('fournisseur.index')}}">
                            <i class="mdi mdi-account-group-outline"></i>
                            <span> Fournisseur </span>
                        </a>
                    </li>
                <li class="menu-title mt-2">Operation</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-office-building"></i>
                        <span> Reservations </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('reservation_pending')}}">Encours</a>
                            </li>
                            <li>
                                <a href="{{route('reservation')}}">Accepté</a>
                            </li>
                            <li>
                                <a href="{{route('reservation_reject')}}">Annulé</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{route('planing')}}">
                        <i class="mdi mdi-timeline"></i>
                        <span> Planings </span>
                    </a>
                </li>
                @endif


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
