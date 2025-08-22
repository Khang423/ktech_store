<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn đã đặt hàng </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/outside/thanks.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12">
                <div class="thank-you-container">
                    @if ($status == 'success')
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                    @else
                        <div class="danger-icon">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    @endif


                    @if ($status == 'success')
                        <h1 class="h2 fw-bold text-primary mb-3">Cảm ơn bạn!</h1>
                        <p class="lead text-muted mb-4">Đơn hàng của bạn đã được đặt thành công</p>
                    @else
                        <h1 class="h2 fw-bold text-primary mb-3">Thông báo!</h1>
                        <p class="lead text-muted mb-4">Thanh toán bị gián đoạn</p>
                    @endif


                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Mã đơn hàng</h6>
                                <p class="mb-0"> {{ $data->order_code }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Ngày đặt</h6>
                                <p class="mb-0"> {{ $data->created_at }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Tổng tiền</h6>
                                <p class="mb-0 text-success fw-bold"> {{ formatPriceToVND($data->total_price) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Trạng thái</h6>
                                @if ($status == 'success')
                                    <span class="badge bg-success">Đang xử lý</span>
                                @else
                                    <span class="badge bg-danger">Đã huỷ</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Phương thức thanh toán</h6>
                                @if ($data->method_payment == 0)
                                    <span class="badge bg-success">Thanh toán khi nhận hàng</span>
                                @elseif ($data->method_payment == 1)
                                    <span class="badge bg-success">VNPay</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Chúng tôi sẽ gửi email xác nhận và thông tin vận chuyển đến địa chỉ email của bạn trong vòng 24
                        giờ.
                    </div>

                    <div class="d-flex flex-wrap justify-content-center mb-4">
                        <button class="btn btn-custom" onclick="trackOrder()">
                            <i class="fas fa-truck me-2"></i>Theo dõi đơn hàng
                        </button>
                        <button class="btn btn-outline-custom" onclick="continueShopping()">
                            <i class="fas fa-shopping-cart me-2"></i>Tiếp tục mua sắm
                        </button>
                    </div>

                    <hr class="my-4">

                    <h5 class="text-primary mb-3">Kết nối với chúng tôi</h5>
                    <div class="social-links mb-4">
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>

                    <p class="text-muted small mb-0">
                        Cần hỗ trợ? Liên hệ: <strong>0799599040</strong> hoặc
                        <a href="mailto:cskhktech@gmail.com" class="text-decoration-none">cskhktech@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const trackOrder = () => {
            window.location.href = '/customer/profile';
        };

        const continueShopping = () => {
            window.location.href = '/';
        };

        history.replaceState(null, '', '/thanks');
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9643b0e771a7a904',t:'MTc1MzM2Mjk3Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>
