@can('access_by_user')
<div class="nav-item {{ ($segment2 == 'orders') ? 'active' : '' }}">
    <a href="{{ route('panel.orders.index') }}" class="a-item" ><i class="ik ik-box"></i><span>{{ 'My Orders ' }}</span></a>
</div>
<div class="nav-item {{ ($segment2 == 'refer-earn') ? 'active' : '' }}">
    <a href="{{ route('panel.refer-earn.index') }}" class="a-item" ><i class="ik ik-dollar-sign"></i><span>{{ 'Refer & Earn' }}</span></a>
</div>
<div class="nav-item {{ ($segment2 == 'wallet-logs') ? 'active' : '' }}">
    <a href="{{ route('panel.wallet_logs.index',auth()->id()) }}" class="a-item" ><i class="ik ik-file-text"></i><span>{{ 'Wallte Logs' }}</span></a>
</div>
@endcan