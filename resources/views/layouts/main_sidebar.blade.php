@php
    $data = [];
    $data['pending_orders'] = App\Models\Order::where('status', 0)->count();
    $user_role = auth()->user()->role_id;
@endphp


<aside id="sidebar_main">
    
    <div class="sidebar_main_header" style="height:auto">
        <div class="sidebar_logo">
            <a href="#" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="" height="15" width="200px"/>
                <img class="logo_light" src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="" height="15" width="200px"/>
            </a>
            <a href="#" class="sSidebar_show sidebar_logo_small">
                <img class="logo_regular" src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="" height="32" width="200px"/>
                <img class="logo_light" src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="" height="32" width="200px"/>
            </a>
        </div>
    </div>
    
    <div class="menu_section">
        <ul>
            <li title="Dashboard" class="sidebar_dashboard">
                <a href="{{ route('admin_dashboard_index') }}">
                    <span class="menu_icon"><i class="material-icons">dashboard</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            <li title="Payment Orders" class="sidebar_orders">
                <a href="{{ route('admin_order_index') }}">
                    <span class="menu_icon"><i class="material-icons">list_alt</i></span>
                    <span class="menu_title">
                        <span>Payment Orders</span>
                        @if ($data['pending_orders'])
                            <span class="uk-badge uk-badge-warning">{{ $data['pending_orders'] }}</span>
                        @endif
                    </span>
                </a>
            </li>
            @if ($user_role == 1)
                <li title="Settings" class="sidebar_settings">
                    <a href="{{ route('admin_settings_index') }}">
                        <span class="menu_icon"><i class="material-icons">settings</i></span>
                        <span class="menu_title">Settings</span>
                    </a>
                </li>
                <li title="Countries" class="sidebar_countries">
                    <a href="{{ route('admin_country_index') }}">
                        <span class="menu_icon"><i class="material-icons">flag</i></span>
                        <span class="menu_title">Countries</span>
                    </a>
                </li>
                <li title="Services" class="sidebar_services">
                    <a href="{{ route('admin_service_index') }}">
                        <span class="menu_icon"><i class="material-icons">wifi_tethering</i></span>
                        <span class="menu_title">Services</span>
                    </a>
                </li>
                <li title="Payment Methods" class="sidebar_payment_methods">
                    <a href="{{ route('admin_payment_method_index') }}">
                        <span class="menu_icon"><i class="material-icons">account_balance</i></span>
                        <span class="menu_title">Payment Methods</span>
                    </a>
                </li>
                <li title="Currencies" class="sidebar_currencies">
                    <a href="{{ route('admin_currency_index') }}">
                        <span class="menu_icon"><i class="material-icons">attach_money</i></span>
                        <span class="menu_title">Currencies</span>
                    </a>
                </li>
                <li title="Offers" class="sidebar_offers">
                    <a href="{{ route('admin_offer_index') }}">
                        <span class="menu_icon"><i class="material-icons">local_offer</i></span>
                        <span class="menu_title">Offers</span>
                    </a>
                </li>
                <li title="Live Chat" class="sidebar_live_chat">
                    <a href="https://www.mylivechat.com/webconsole/" target="_blank">
                        <span class="menu_icon"><i class="material-icons">question_answer</i></span>
                        <span class="menu_title">Live Chat</span>
                    </a>
                </li>
                <li title="Users" class="sidebar_users">
                    <a href="{{ route('admin_users_index') }}">
                        <span class="menu_icon"><i class="material-icons">people</i></span>
                        <span class="menu_title">Users</span>
                    </a>
                </li>
                <li title="Admins" class="sidebar_admins">
                    <a href="{{ route('admin_admin_index') }}">
                        <span class="menu_icon"><i class="material-icons">manage_accounts</i></span>
                        <span class="menu_title">Admins</span>
                    </a>
                </li>
                <li title="Roles" class="sidebar_roles">
                    <a href="{{ route('admin_role_index') }}">
                        <span class="menu_icon"><i class="material-icons">verified_user</i></span>
                        <span class="menu_title">Roles</span>
                    </a>
                </li>
                <li title="Issues" class="sidebar_issues">
                    <a href="{{ route('admin_issue_index') }}">
                        <span class="menu_icon"><i class="material-icons">list</i></span>
                        <span class="menu_title">Issues</span>
                    </a>
                </li>
                <li title="Subscribes" class="sidebar_subscribes">
                    <a href="{{ route('admin_subscribe_index') }}">
                        <span class="menu_icon"><i class="material-icons">subscriptionsA</i></span>
                        <span class="menu_title">Subscribes</span>
                    </a>
                </li>
                <li title="Emails" class="sidebar_emails">
                    <a href="{{ route('admin_mail_index') }}">
                        <span class="menu_icon"><i class="material-icons">email</i></span>
                        <span class="menu_title">Emails</span>
                    </a>
                </li>
                <li title="CMS" class="sidebar_cms">
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">wordpress</i></span>
                        <span class="menu_title">CMS</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin_notice_index') }}">Sliders</a></li>
                        <li><a href="{{ route('admin_global_payments_index') }}">Global Payment Methods</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</aside>