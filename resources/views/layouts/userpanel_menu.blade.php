{{-- <div class="bg-primary">
    <div class="container d-flex justify-content-center">
      <ul class="nav secondary-nav">
        <li class="nav-item"> <a href="{{ route('userpanel_profile_index') }}" class="nav-link userpanel_menu_profile">Profile</a></li>
        <li class="nav-item"> <a href="{{ route('userpanel_transaction_index') }}" class="nav-link userpanel_menu_transaction">Transactions</a></li>
        <li class="nav-item"> <a href="{{ route('userpanel_recipient_index') }}" class="nav-link userpanel_menu_recipients">Recipients</a></li>
      </ul>
    </div>
</div> --}}

<ul class="nav nav-pills flex-column mb-auto">
  <li class="nav-item"><a href="{{ route('userpanel_dashboard_index') }}" class="nav-link userpanel_menu_dashboard">Dashboard</a></li>
  <li class="nav-item"><a href="{{ route('userpanel_profile_index') }}" class="nav-link userpanel_menu_profile">Profile</a></li>
  <li class="nav-item"><a href="{{ route('userpanel_transaction_index') }}" class="nav-link userpanel_menu_transaction">Transaction</a></li>
  <li class="nav-item"><a href="{{ route('userpanel_recipient_index') }}" class="nav-link userpanel_menu_recipients">Recipients</a></li>
</ul>