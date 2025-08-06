<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks you </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .thank-you-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 450px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .thank-you-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .success-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: bounce 0.6s ease-out;
            position: relative;
            z-index: 1;
        }

        @keyframes bounce {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .success-icon i {
            color: white;
            font-size: 2rem;
        }

        .order-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-left: 4px solid #667eea;
        }

        .btn-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #667eea;
            color: #667eea;
            background: transparent;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .btn-outline-custom:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .social-links a {
            color: #667eea;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: #764ba2;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12">
                <div class="thank-you-container">

                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <h1 class="h2 fw-bold text-primary mb-3">Cảm ơn bạn!</h1>
                    <p class="lead text-muted mb-4">Đơn hàng của bạn đã được đặt thành công</p>

                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Mã đơn hàng</h6>
                                <p class="mb-0">{{ $order->order_code }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Ngày đặt</h6>
                                <p class="mb-0">{{ $order->created_at }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Tổng tiền</h6>
                                <p class="mb-0 text-success fw-bold">{{ formatPriceToVND($order->total_price) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">Trạng thái</h6>
                                <span class="badge bg-success">Đang xử lý</span>
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
                        Cần hỗ trợ? Liên hệ: <strong>1900-1234</strong> hoặc
                        <a href="mailto:support@example.com" class="text-decoration-none">support@example.com</a>
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
        const orderDataJson = localStorage.getItem("orderData");
        if (orderDataJson) {
            const orderData = JSON.parse(orderDataJson);
            console.log("Dữ liệu đơn hàng:", orderData);
            localStorage.removeItem("orderData");
        }
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
