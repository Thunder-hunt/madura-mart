<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                        <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>

        <!-- Products -->
        <li class="nav-item">
            <a class="nav-link @if ($title === 'Products') active @endif" href="{{ route('products.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.5); display: block;">
                        <line x1="9" y1="2.25" x2="9" y2="8.25" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                        <rect x="2.75" y="5.25" width="12.5" height="10" rx="2" ry="2" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></rect>
                        <path d="M3,6.284l1.449-2.922c.338-.681,1.032-1.112,1.792-1.112h5.518 c.76,0,1.454,.431,1.792,1.112l1.449,2.923" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <line x1="5.25" y1="12.75" x2="7.25" y2="12.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Products</span>
            </a>
        </li>

        <!-- Clients -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <line x1="12.345" y1="11.75" x2="15.25" y2="11.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></line>
                        <path d="M8.779,4.67l-.231-.313c-.283-.382-.73-.608-1.206-.608h-1.458c-.388,0-.761,.151-1.041,.42l-1.867,1.8 c-.07,.067-.148,.123-.232,.167" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <path d="M2.75,11.75h1.26c.303,0,.59,.138,.78,.374l1.083,1.349c.596,.742,1.632,.962,2.478,.525l3.274-1.693 c1.111-.574,1.428-2.016,.661-3.003l-1.648-2.122" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <path d="M15.258,6.138c-.085-.044-.163-.1-.233-.168l-1.867-1.8c-.28-.269-.653-.42-1.041-.42h-1.807 c-.404,0-.791,.163-1.074,.453l-2.495,2.558c-.498,.51-.493,1.326,.011,1.83h0c.447,.447,1.15,.508,1.668,.145l2.83-1.985" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></path>
                        <path d="M.75,5.25H1.75c.552,0,1,.448,1,1v6c0,.552-.448,1-1,1H.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <path d="M17.25,5.25h-1c-.552,0-1,.448-1,1v6c0,.552,.448,1,1,1h1" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Clients</span>
            </a>
        </li>

        <!-- Purchase -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}" href="{{ route('purchase.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <line x1="4.75" y1="6.25" x2="7.25" y2="1.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></line>
                        <line x1="13.25" y1="6.25" x2="10.75" y2="1.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></line>
                        <path d="M15,6.25l-.597,7.166c-.086,1.037-.953,1.834-1.993,1.834H5.59 c-1.04,0-1.907-.797-1.993-1.834l-.597-7.166" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <line x1="1.75" y1="6.25" x2="16.25" y2="6.25" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Purchase</span>
            </a>
        </li>

        <!-- Order -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('order*') ? 'active' : '' }}" href="{{ route('order.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <path d="M1.75 1.75L3.10101 2.088C3.49401 2.186 3.78899 2.51199 3.84799 2.91299L4.92731 10.25" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M15.25 13.25H4.75C3.9216 13.25 3.25 12.5784 3.25 11.75C3.25 10.9216 3.9216 10.25 4.75 10.25H13.0496 C13.4701 10.25 13.8457 9.98691 13.9894 9.59171L15.2618 6.09171C15.4989 5.43951 15.0159 4.75 14.322 4.75H4.11801" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M4 17C4.552 17 5 16.552 5 16C5 15.448 4.552 15 4 15C3.448 15 3 15.448 3 16C3 16.552 3.448 17 4 17Z" fill="#1c1f21" data-color="color-2"></path>
                        <path d="M14 17C14.552 17 15 16.552 15 16C15 15.448 14.552 15 14 15C13.448 15 13 15.448 13 16C13 16.552 13.448 17 14 17Z" fill="#1c1f21" data-color="color-2"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Order</span>
            </a>
        </li>

        <!-- Sale -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('sale*') ? 'active' : '' }}" href="{{ route('sale.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <path d="m2.25,4.25h5.586c.265,0,.52.105.707.293l5.1065,5.1065c.781.781.781,2.047,0,2.828l-3.172,3.172 c-.781.781-2.047.781-2.828,0l-5.1065-5.1065c-.188-.188-.293-.442-.293-.707v-5.586Z" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <path d="m3.75,1.25h5.586c.265,0,.52.105.707.293l5.7705,5.7705" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></path>
                        <circle cx="5.75" cy="7.75" r="1.25" fill="#1c1f21" stroke-width="0" data-color="color-2"></circle>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Sale</span>
            </a>
        </li>

        <!-- Distributor -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('distributor*') ? 'active' : '' }}" href="{{ route('distributor.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <path class="color-background opacity-6" d="M15.685,4.423L9.816,1.333c-.511-.271-1.121-.27-1.631,0L2.315,4.423c-.494,.26-.801,.769-.801,1.327s.307,1.067,.801,1.327l5.869,3.09c.255,.135,.536,.203,.816,.203s.56-.067,.815-.202l5.87-3.091c.494-.26,.801-.769,.801-1.327s-.307-1.067-.801-1.327Z" />
                        <path class="color-background" d="M15.736,8.25c-.414,0-.75,.336-.75,.75l-5.87,3.091c-.072,.038-.158,.038-.232,0l-5.87-3.091c0-.414-.336-.75-.75-.75s-.75,.336-.75,.75c0,.559,.307,1.067,.801,1.327l5.869,3.09c.255,.135,.536,.203,.816,.203s.56-.067,.815-.202l5.87-3.091c.494-.26,.801-.769,.801-1.327,0-.414-.336-.75-.75-.75Z" />
                        <path class="color-background" d="M15.736,11.5c-.414,0-.75,.336-.75,.75l-5.87,3.091c-.072,.038-.158,.038-.232,0l-5.87-3.091c0-.414-.336-.75-.75-.75s-.75,.336-.75,.75c0,.559,.307,1.067,.801,1.327l5.869,3.09c.255,.135,.536,.203,.816,.203s.56-.067,.815-.202l5.87-3.091c.494-.26,.801-.769,.801-1.327,0-.414-.336-.75-.75-.75Z" />
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Distributor</span>
            </a>
        </li>

        <!-- Courier -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('couriers*') ? 'active' : '' }}" href="{{ route('couriers.index') }}">
                <div class="icon icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 20px; height: 20px;">
                        <path d="M8 8.25C9.7949 8.25 11.25 6.794 11.25 5C11.25 3.206 9.7949 1.75 8 1.75C6.2051 1.75 4.75 3.206 4.75 5C4.75 6.794 6.2051 8.25 8 8.25Z" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M1.953 14.5C3.1574 12.6813 5.15919 11.4395 7.45889 11.2699" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M14.925 15.75H8.75L10.618 11.55C10.698 11.3699 10.877 11.25 11.075 11.25H16.481C16.843 11.25 17.085 11.62 16.938 11.95L15.382 15.45C15.302 15.6301 15.123 15.75 14.925 15.75Z" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M8.75 15.75H5.75" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Courier</span>
            </a>
        </li>

        <!-- Users -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width: 25px; height: 25px; transform: scale(1.3) translateY(1px); display: block;">
                        <circle cx="9" cy="4.5" r="2.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></circle>
                        <path d="M13.762,15.516c.86-.271,1.312-1.221,.947-2.045-.97-2.191-3.159-3.721-5.709-3.721s-4.739,1.53-5.709,3.721 c-.365,.825,.087,1.774,.947,2.045,1.225,.386,2.846,.734,4.762,.734s3.537-.348,4.762-.734Z" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Users</span>
            </a>
        </li>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">REPORTS</h6>
        </li>

        <!-- Distributor Reports -->
        <li class="nav-item">
            <a class="nav-link" href="../pages/profile.html">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="2 0 14 18">
                        <title>settings</title>
                        <polyline points="11.5 5.75 9 8.25 6.5 5.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></polyline>
                        <line x1="9" y1="8.25" x2="9" y2="2.75" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" data-color="color-2"></line>
                        <path d="M16.214,9.75h-4.464v1c0,.552-.448,1-1,1h-3.5c-.552,0-1-.448-1-1v-1H1.787" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                        <path d="M12,2.75h.137c.822,0,1.561,.503,1.862,1.269l2.113,5.379c.092,.233,.138,.481,.138,.731v3.121c0,1.105-.895,2-2,2H3.75c-1.105,0-2-.895-2-2v-3.121c0-.25,.047-.498,.138-.731l2.113-5.379c.301-.765,1.039-1.269,1.862-1.269h.137" fill="none" stroke="#1c1f21" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Distributor Reports</span>
            </a>
        </li>

        <!-- Product Reports -->
        <li class="nav-item">
            <a class="nav-link" href="../pages/sign-in.html">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="2 0 14 18">
                        <title>document</title>
                        <path d="M7.99707 11.25L9.60605 12.75L13.0031 8.25" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" data-color="color-2" fill="none"></path>
                        <path d="M13.75 5.25H7.25C6.145 5.25 5.25 6.145 5.25 7.25V13.75C5.25 14.855 6.145 15.75 7.25 15.75H13.75C14.855 15.75 15.75 14.855 15.75 13.75V7.25C15.75 6.145 14.855 5.25 13.75 5.25Z" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M12.4012 2.74996C12.0022 2.06146 11.2151 1.64841 10.38 1.77291L3.45602 2.80196C2.36402 2.96386 1.61003 3.98093 1.77203 5.07393L2.75002 11.6547" stroke="#1c1f21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" data-color="color-2" fill="none"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Product Reports</span>
            </a>
        </li>

        <!-- Order Reports -->
        <li class="nav-item">
            <a class="nav-link" href="../pages/sign-up.html">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 18 18">
                        <path d="m14.911,3.089c-.298-1.197-1.373-2.089-2.661-2.089h-6.5c-1.517,0-2.75,1.233-2.75,2.75v11.25L14.911,3.089Z" stroke-width="0" fill="#1c1f21"></path>
                        <path d="m4.591,16.591l4.409-2.689,4.834,2.973c.125.083.271.126.416.126.122,0,.243-.029.354-.089.244-.13.396-.385.396-.661V6.182l-10.409,10.409Z" stroke-width="0" fill="#1c1f21"></path>
                        <path d="m2,16.75c-.192,0-.384-.073-.53-.22-.293-.293-.293-.768,0-1.061L15.47,1.47c.293-.293.768-.293,1.061,0s.293.768,0,1.061L2.53,16.53c-.146.146-.338.22-.53.22Z" fill="#1c1f21" stroke-width="0" data-color="color-2"></path>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Order Reports</span>
            </a>
        </li>
    </ul>
</div>
