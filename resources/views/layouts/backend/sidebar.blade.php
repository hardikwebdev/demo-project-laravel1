 <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">          
            <li class="@if(\Request::is('admin/dashboard') || \Request::is('admin')  ) {{'active'}} @endif" >
                <a href="{{route('admin.dashboard')}}" title="Dashboard">
                <img src="{{asset('images/Dashboard.png')}}" class="side-icon-size" style="width: 20px;"> <span class="nav-label"> Dashboard</span></a>
            </li> 
            <li class=" @if(\Request::is('admin/user') || \Request::is('admin/user/*') || strstr(\Request::route()->getName(),'proof_request') || strstr(\Request::route()->getName(),'package_history') ||  strstr(\Request::route()->getName(),'payment_history') || strstr(\Request::route()->getName(),'support_ticket') || strstr(\Request::route()->getName(),'ticket_request')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('/assets/images/assets/Dashboard/Group851.png')}}" class="side-icon-size" style="width: 15px;">
                    <span class="nav-label">Users</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class=" @if(\Request::is('admin/user') || \Request::is('admin/user/*')) {{'active'}} @endif">
                        <a href="{{route('user.index')}}" title="Manage Users"><span class="cus-sub-menu">Manage Users</span></a>
                    </li>
                    {{-- @php $proof_count = Helper::getPendingProofCount() @endphp
                    <li class=" @if(strstr(\Request::route()->getName(),'proof_request')) {{'active'}} @endif">
                        <a href="{{route('proof_request.index')}}" title="Proof Request"><span class="cus-sub-menu"> Proof Request </span><span class="label label-info pull-right">{{$proof_count}}</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'package_history')) {{'active'}} @endif">
                        <a href="{{route('package_history.index')}}" title="Package History"><span class="cus-sub-menu">Package History</span></a>
                    </li>--}}
                    <li class=" @if(strstr(\Request::route()->getName(),'crypto_Wallets_payment_history')) {{'active'}} @endif">
                        <a href="{{route('crypto_wallets_payment_history.index')}}" title="Crypto Wallets Payment History"><span class="cus-sub-menu">Crypto Wallets Payment History</span></a>
                    </li>
                    {{-- @php $count = Helper::getUnreadCount() @endphp --}}
                    <li class=" @if(strstr(\Request::route()->getName(),'nft_wallets_payment_history')) {{'active'}} @endif">
                        <a href="{{route('nft_wallets_payment_history.index')}}" title="Nft Wallets Payment History"><span class="cus-sub-menu">NFT Wallets Payment History</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'nft_purchase_history')) {{'active'}} @endif">
                        <a href="{{route('nft_purchase_history.index')}}" title="Nft Purchase History"><span class="cus-sub-menu">NFT Purchase History</span></a>
                    </li>
                    @php $count = Helper::getUnreadCount() @endphp
                    <li class=" @if(strstr(\Request::route()->getName(),'support_ticket')) {{'active'}} @endif">
                        <a href="{{route('support_ticket.index1','all')}}" title="Support"><span class="cus-sub-menu">Support</span><span class="label label-info pull-right">{{$count}}</span></a>
                    </li>
                    {{-- <!-- <li class=" @if(strstr(\Request::route()->getName(),'ticket_request2') || strstr(\Request::route()->getName(),'ticket_request')) {{'active'}} @endif">                     -->
                    @role('admin')
                        <li class=" @if(strstr(\Request::route()->getName(),'support_ticket')) {{'active'}} @endif">
                            <a href="{{route('package_setting.show',['bulk-upgrade'])}}" title="Support"><span class="cus-sub-menu">Bulk Package Upgrade</span></a>
                        </li>
                    @endrole --}}
                    <!-- </li> -->
                </ul>
            </li>        
            <li class=" @if(\Request::is('admin/admin_fund_wallet') || \Request::is('admin/withdrawal_request') || \Request::is('admin/withdrawal_request/*') || \Request::is('admin/mt4-wallet-withdrawl-requests') || \Request::route()->getName() =='admin_pips_rebate.index' || \Request::route()->getName()=='admin_pips_rebate.import' || strstr(\Request::route()->getName(),'profit_sharing')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('/assets/images/assets/Dashboard/Group952.png')}}" class="side-icon-size" style="width: 20px;">
                    <span class="nav-label">Wallet</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class=" @if(\Request::is('admin/crypto_wallets_credit_request')) {{'active'}} @endif">
                        <a href="{{route('crypto_wallets_credit_request.index')}}" title="Crypto Wallets Credits Requests"> <span class="cus-sub-menu">Crypto Wallets Credits Requests<span class="label label-info pull-right">{{Helper::getPendingCryptoCreditRequestCount()}}</span></span></a>
                    </li>
                    <li class=" @if(\Request::is('admin/nft_wallets_credit_request')) {{'active'}} @endif">
                        <a href="{{route('nft_wallets_credit_request.index')}}" title="Nft Wallets Credits Requests"> <span class="cus-sub-menu">NFT Wallets Credits Requests<span class="label label-info pull-right">{{Helper::getPendingNftCreditRequestCount()}}</span></span></a>
                    </li> 
                    <li class=" @if(\Request::is('admin/nft_purchase_request')) {{'active'}} @endif">
                        <a href="{{route('nft_purchase_request.index')}}" title="Nft Purchase Requests"> <span class="cus-sub-menu">NFT Purchase Requests</span><span class="label label-info pull-right">{{Helper::getPendingNftPurchaseRequestCount()}}</span></a>
                    </li> 
                    {{-- <li class=" @if(\Request::is('admin/withdrawal_request') || \Request::is('admin/withdrawal_request/*')) {{'active'}} @endif">
                        <a href="{{route('capital_request')}}" title="Capital Withdrawal Requests"> <span class="cus-sub-menu">Capital Withdrawal Requests</span></a>
                    </li> --}}
                    <li class=" @if(\Request::is('admin/withdrawal_request') || \Request::is('admin/withdrawal_request/*')) {{'active'}} @endif">
                        <a href="{{route('withdrawal_request.index')}}" title="Withdrawal Requests"> <span class="cus-sub-menu">Withdrawal Requests</span><span class="label label-info pull-right">{{Helper::getwithdrawalRequestCount()}}</span></a>
                    </li>
                    <li class=" @if(\Request::is('admin/yield_wallet') || \Request::is('admin/yield_wallet/*')) {{'active'}} @endif">
                        <a href="{{route('yield_wallet.index')}}" title="Yield Wallet"> <span class="cus-sub-menu">Yield Wallet</span></a>
                    </li>
                    {{-- @role('admin')
                    <li class=" @if(\Request::is('admin/mt4-wallet-withdrawl-requests')) {{'active'}} @endif">
                        <a href="{{route('mt4_withdrawal_requests')}}" title="MT5 Withdrawal Requests"><span class="cus-sub-menu">MT5 Withdrawal Requests</span></a>
                    </li>
                    <li class=" @if(\Request::route()->getName() =='admin_pips_rebate.index' || \Request::route()->getName()=='admin_pips_rebate.import') {{'active'}} @endif">
                        <a href="{{route('admin_pips_rebate.index')}}" title="Lot Rebates"><span class="cus-sub-menu">Lot Rebates</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'profit_sharing')) {{'active'}} @endif">
                        <a href="{{route('profit_sharing.index')}}" title="MT4 Top-up Requests"><span class="cus-sub-menu">Profit Sharing</span></a>
                    </li>
                    @endrole --}}
                </ul>
            </li> 
            {{-- <li class=" @if(strstr(\Request::route()->getName(),'report.user') || strstr(\Request::route()->getName(),'report.show') || strstr(\Request::route()->getName(),'report.fund_withdrawal_report') ||  strstr(\Request::route()->getName(),'report.leader_bonus')||  strstr(\Request::route()->getName(),'report.payout') ||  strstr(\Request::route()->getName(),'report.profit')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('images/Report.png')}}" class="side-icon-size">
                    <span class="nav-label">Reports</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" style="">
                     <li class=" @if(strstr(\Request::route()->getName(),'report.user')) {{'active'}} @endif">
                        <a href="{{route('report.user')}}" title="User Report"><span class="cus-sub-menu">User Report</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'report.show')) {{'active'}} @endif">
                        <a href="{{route('report.show','user-wallet-report')}}" title="User Wallet Report"><span class="cus-sub-menu">User Wallet Report</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'report.fund_withdrawal_report')) {{'active'}} @endif">
                        <a href="{{route('report.fund_withdrawal_report')}}" title="FundIn Withdrawal Report"><span class="cus-sub-menu">FundIn Withdrawal Report</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'report.leader_bonus')) {{'active'}} @endif">
                        <a href="{{route('report.leader_bonus')}}" title="Fund Transferred leader Report"><span class="cus-sub-menu">Fund Transferred leader Report</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'report.payout')) {{'active'}} @endif">
                        <a href="{{route('report.payout')}}" title="Fund Transferred leader Report"><span class="cus-sub-menu">Payout Report</span></a>
                    </li>
                    <li class=" @if(strstr(\Request::route()->getName(),'report.profit')) {{'active'}} @endif">
                        <a href="{{route('report.profit')}}" title="Profit Report"><span class="cus-sub-menu">Profit Report</span></a>
                    </li>
                </ul>
            </li>             --}}
           
            {{-- <div class="footerlogodiv">
                <a title="CMS" href="javascript:void(0)">
                   <span class="nav-label colorwhite"> <b class="ml18">Powered by,</b>
                    <div>
                        <img src="" alt="Logo"  class="footerlogo">
                    </div>
                   </span> 
                </a>
            </div> --}}
            <li class="@if(\Request::is('admin/packages') || \Request::is('admin/packages/*') || \Request::is('admin/pool-packages') || \Request::is('admin/pool-packages/*')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('/assets/images/assets/Dashboard/Group955.png')}}" class="side-icon-size" style="width: 20px;">
                    <span class="nav-label">Staking Pools</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class="@if(\Request::is('admin/pool-packages') || \Request::is('admin/pool-packages/*')) {{'active'}} @endif">
                        <a href="{{ route('pool-packages.index')}}" title=""> <span class="cus-sub-menu">Pool Packages</span><span class="label label-info pull-right"></span></a>
                    </li>
                    <li class="@if(\Request::is('admin/packages') || \Request::is('admin/packages/*')) {{'active'}} @endif">
                        <a href="{{ route('packages.index')}}" title=""> <span class="cus-sub-menu">Packages</span></a>
                    </li>
                </ul>
            </li>
            <li class="@if(\Request::is('admin/nft-category') || \Request::is('admin/nft-category/*') || \Request::is('admin/nft-product') || \Request::is('admin/nft-product/*')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('assets/images/assets/Dashboard/Group951.png')}}" class="side-icon-size" style="width: 20px;">
                    <span class="nav-label">NFT Collection</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class="@if(\Request::is('admin/nft-category') || \Request::is('admin/nft-category/*')) {{'active'}} @endif">
                        <a href="{{ route('nft-category.index')}}" title="Categories"> <span class="cus-sub-menu">Categories</span><span class="label label-info pull-right"></span></a>
                    </li>
                    <li class="@if(\Request::is('admin/nft-product') || \Request::is('admin/nft-product/*')) {{'active'}} @endif">
                        <a href="{{ route('nft-product.index') }}" title="Products"> <span class="cus-sub-menu">Products</span></a>
                    </li>
                </ul>
            </li>
            <li class=" @if(\Request::is('admin/package_setting') || \Request::is('admin/rank_setting')|| \Request::is('admin/setting') || \Request::is('admin/package_setting/*') || \Request::is('admin/rank_setting/*')|| \Request::is('admin/general_setting/*') || strstr(\Request::route()->getName(),'investment-plans')) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('/assets/images/assets/Dashboard/Path1214.png')}}" class="side-icon-size" style="width: 20px;">
                    <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class=" @if(\Request::is('admin/setting')) {{'active'}} @endif"><a href="{{route('setting.index')}}"><span class="cus-sub-menu">General Setting</span></a></li>
                    {{-- <li class=" @if(\Request::is('admin/package_setting') || \Request::is('admin/package_setting/*')) {{'active'}} @endif"><a href="{{route('package_setting.index')}}"><span class="cus-sub-menu">Package Setting</span></a></li> --}}
                    <li class=" @if(\Request::is('admin/rank_setting')|| \Request::is('admin/rank_setting/*')) {{'active'}} @endif"><a href="{{route('rank_setting.index')}}"><span class="cus-sub-menu">Rank Setting</span></a></li>
                    {{-- <li class=" @if(\Request::is('admin/investment-plans')|| \Request::is('admin/investment-plans/*')) {{'active'}} @endif"><a href="{{route('investment-plans.index')}}"><span class="cus-sub-menu">Investment Plans</span></a></li> --}}
                </ul>
            </li>
            <li class="@if(\Request::is('admin/news') || \Request::is('admin/news/*') || \Request::is('admin/announcement') || \Request::is('admin/announcement/*') || \Request::is('admin/slider') || \Request::is('admin/slider/*') ||   \Request::is('admin/ticket') ||   \Request::is('admin/ticket/*') ||   \Request::is('admin/product') ||   \Request::is('admin/product/*') ) {{'active'}} @endif">
                <a href="#">
                    <img src="{{asset('images/content.png')}}" class="side-icon-size" style="width: 20px;">
                    <span class="nav-label">CMS</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="">
                    <li class=" @if(\Request::is('admin/news') || \Request::is('admin/news/*')) {{'active'}} @endif">
                        <a href="{{route('news.index')}}"><span class="cus-sub-menu"> News</span></a>               
                    </li>
                    {{-- <li class=" @if( \Request::is('admin/announcement') || \Request::is('admin/announcement/*')) {{'active'}} @endif">
                        <a href="{{route('announcement.index')}}"><span class="cus-sub-menu"> Announcement</span></a>               
                    </li>     --}}
                     <li class=" @if( \Request::is('admin/slider') || \Request::is('admin/slider/*')) {{'active'}} @endif">
                        <a href="{{route('slider.index')}}"><span class="cus-sub-menu"> Slider</span></a>               
                    </li>     
                </ul>
            </li>
        </ul>
    </div>
</nav>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>