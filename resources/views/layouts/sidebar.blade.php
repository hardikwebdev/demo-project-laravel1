 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Group848.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('stacks') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Group955.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Staking Pools</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" href="#node" aria-expanded="false" aria-controls="tables">
        <img src="{{ asset('assets/images/assets/Dashboard/Group953.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Nodes Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="node">
        <ul class="nav flex-column sub-menu rounded-bottom">
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('node_register') }}">Register</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('node_management') }}">Nodes</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" href="#wallets" aria-expanded="false" aria-controls="tables">
        <img src="{{ asset('assets/images/assets/Dashboard/Group952.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Wallets</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="wallets">
        <ul class="nav flex-column sub-menu rounded-bottom">
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('crypto_wallets') }}">Crypto Wallet</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('yield_wallet') }}">Yield Wallet</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('commission_wallet') }}">Commission  Wallet</a>
          </li>
          <!-- <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('nft_wallet') }}">NFT Wallet</a>
          </li> -->
        </ul>
      </div>
    </li>
   <!--  <li class="nav-item">
      <a class="nav-link" href="{{ route('nft_marketplace') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Group951.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">NFT Marketplace </span>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('withdrawal') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Group850.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Withdrawals</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ledger') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Group956.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Ledger</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="tables">
        <img src="{{ asset('assets/images/assets/Dashboard/Group851.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Account</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="account">
        <ul class="nav flex-column sub-menu rounded-bottom">
          <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('account') }}">My Account</a>
          </li>
          <!-- <li class="nav-item"> 
            <a class="nav-link pl-0" href="{{ route('my_collection') }}">My Collection</a>
          </li> -->
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('help_support.index') }}">
        <img src="{{ asset('assets/images/assets/Dashboard/Path1214.png') }}" class="cus-sidebar-icon" alt="">
        <span class="menu-title">Help & Support</span>
      </a>
    </li>
  </ul>
</nav>