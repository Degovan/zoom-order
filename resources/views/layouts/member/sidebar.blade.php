<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="/img/logo.svg" alt="" srcset="">
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class='sidebar-title'>Front</li>
            <li class="sidebar-item @active('member.dashboard')">
                <a href="" class="sidebar-link">
                    <i data-feather="command" width="20"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @active('member.pricing.index')">
                <a href="{{ route('member.pricing.index')}}" class="sidebar-link">
                    <i data-feather="command" width="20"></i>
                    <span>Pricing</span>
                </a>
            </li>
            <li class="sidebar-item @active('member.invoice.index')">
                <a href="{{ route('member.invoice.index')}}" class="sidebar-link">
                    <i data-feather="command" width="20"></i>
                    <span>Invoice</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
