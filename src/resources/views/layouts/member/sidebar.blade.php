<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="/img/logo.png" alt="" srcset="">
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class='sidebar-title'>Front</li>
            <li class="sidebar-item @active('member.dashboard')">
                <a href="{{ route('member.dashboard') }}" class="sidebar-link">
                    <i data-feather="command" width="20"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @active('member.packages')">
                <a href="{{ route('member.packages')}}" class="sidebar-link">
                    <i data-feather="package" width="20"></i>
                    <span>Daftar Paket</span>
                </a>
            </li>
            <li class="sidebar-item @active('member.invoice')">
                <a href="{{ route('member.invoice.index')}}" class="sidebar-link">
                    <i data-feather="file-plus" width="20"></i>
                    <span>Invoice</span>
                </a>
            </li>

            <li class="sidebar-item @active('member.meetings')">
                <a href="{{ route('member.meetings.index') }}" class="sidebar-link">
                    <i data-feather="video" width="20"></i>
                    <span>Meeting</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
