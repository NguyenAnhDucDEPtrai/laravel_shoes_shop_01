<footer class="bg-dark mt-5">
    <div class="container pb-5 pt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Liên Hệ Với Chúng Tôi</h3>
                    <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn! Đừng ngần ngại liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi nào. <br>
                        Địa chỉ: 123 Đường ABC, Việt Nam <br>
                        Email: support@amazingshop.vn <br>
                        Số điện thoại: 0901 234 XXX</p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Liên Kết Quan Trọng</h3>
                    <ul>
                        <li><a href="#" title="Giới Thiệu">Giới Thiệu</a></li>
                        <li><a href="#" title="Liên Hệ">Liên Hệ</a></li>
                        <li><a href="#" title="Chính Sách Bảo Mật">Chính Sách Bảo Mật</a></li>
                        <li><a href="#" title="Điều Khoản & Điều Kiện">Điều Khoản & Điều Kiện</a></li>
                        <li><a href="#" title="Chính Sách Hoàn Tiền">Chính Sách Hoàn Tiền</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Tài Khoản Của Tôi</h3>
                    <ul>
                        <li><a href="#" title="Đăng Nhập">Đăng Nhập</a></li>
                        <li><a href="#" title="Đăng Ký">Đăng Ký</a></li>
                        <li><a href="#" title="Đơn Hàng Của Tôi">Đơn Hàng Của Tôi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="copy-right text-center">
                        <p>©Dự án vui vẻ!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>

<script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
</body>

</html>