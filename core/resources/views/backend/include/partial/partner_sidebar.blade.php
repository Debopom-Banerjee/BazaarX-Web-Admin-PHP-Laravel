@can('access_by_partner')
<div class="nav-item {{ ($segment2 == 'orders') ? 'active' : '' }}">
    <a href="{{route('panel.orders.index',['payment_status' => App\Models\Order::PAYMENT_STATUS_PAID,'type' => 'Service'])}}" class="a-item" ><i class="ik ik-shopping-cart"></i><span>{{ 'Orders' }}</span></a>
</div>
<div class="nav-item {{ activeClassIfRoutes(['panel.partner.leads.explore',], 'active')  }}">
    <a href="{{ route('panel.partner.leads.explore')}}" class="a-item" ><i class="ik ik-book"></i><span>Explore Leads</span></a>
</div>
<div class="nav-item {{ activeClassIfRoutes(['panel.partner.leads.index',], 'active')  }}">
    <a href="{{ route('panel.partner.leads.index')}}" class="a-item" ><i class="ik ik-archive"></i><span>My Leads</span></a>
</div>
@endcan