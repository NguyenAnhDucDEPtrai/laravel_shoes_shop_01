<ul id="account-panel" class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('front.showProfile') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> Tài khoản của tôi</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('front.myOrders') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>Đơn hàng của tôi</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('front.showChangePassword') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> Đổi mật khẩu</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('front.auth.logout') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </li>
</ul>