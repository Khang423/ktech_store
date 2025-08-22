<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn đã thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/outside/thankforpayment.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/short_icon_ktech.svg') }}">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="thank-you-card text-center">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <h1 class="display-4 text-success mb-3">Cảm ơn bạn!</h1>
                    <p class="lead text-muted mb-4">Thanh toán của bạn đã được xử lý thành công</p>

                    <div class="order-details">
                        <h4 class="mb-3"><i class="fas fa-receipt me-2"></i>Chi tiết đơn hàng</h4>
                        <div class="detail-row">
                            <span>Mã đơn hàng:</span>
                            <span class="fw-bold">#DH2024001</span>
                        </div>
                        <div class="detail-row">
                            <span>Ngày thanh toán:</span>
                            <span id="payment-date"></span>
                        </div>
                        <div class="detail-row">
                            <span>Phương thức thanh toán:</span>
                            <span>Thẻ tín dụng</span>
                        </div>
                        <div class="detail-row">
                            <span>Tổng tiền:</span>
                            <span>1.250.000 VNĐ</span>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Email xác nhận đã được gửi đến địa chỉ email của bạn
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-custom" onclick="downloadReceipt()">
                            <i class="fas fa-download me-2"></i>Tải hóa đơn
                        </button>
                        <button class="btn btn-outline-custom" onclick="goToHome()">
                            <i class="fas fa-home me-2"></i>Về trang chủ
                        </button>
                    </div>

                    <hr class="my-4">

                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-shipping-fast text-primary mb-2" style="font-size: 2rem;"></i>
                            <h6>Giao hàng nhanh</h6>
                            <small class="text-muted">2-3 ngày làm việc</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-headset text-success mb-2" style="font-size: 2rem;"></i>
                            <h6>Hỗ trợ 24/7</h6>
                            <small class="text-muted">Luôn sẵn sàng giúp đỡ</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-shield-alt text-warning mb-2" style="font-size: 2rem;"></i>
                            <h6>Bảo mật cao</h6>
                            <small class="text-muted">Thanh toán an toàn</small>
                        </div>
                    </div>

                    <div class="social-links mt-4">
                        <p class="mb-3">Theo dõi chúng tôi:</p>
                        <a href="#" onclick="openSocial('facebook')"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" onclick="openSocial('instagram')"><i class="fab fa-instagram"></i></a>
                        <a href="#" onclick="openSocial('twitter')"><i class="fab fa-twitter"></i></a>
                        <a href="#" onclick="openSocial('youtube')"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hiển thị ngày thanh toán hiện tại
        document.getElementById('payment-date').textContent = new Date().toLocaleDateString('vi-VN');



        // Hàm tải hóa đơn
        function downloadReceipt() {
            // Tạo nội dung hóa đơn
            const receiptContent = `
PHIẾU THANH TOÁN
================
Mã đơn hàng: #DH2024001
Ngày: ${new Date().toLocaleDateString('vi-VN')}
Phương thức: Thẻ tín dụng
Tổng tiền: 1.250.000 VNĐ
================
Cảm ơn bạn đã mua hàng!
            `;

            const blob = new Blob([receiptContent], {
                type: 'text/plain'
            });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'hoa-don-DH2024001.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);

            // Hiển thị thông báo
            showNotification('Hóa đơn đã được tải xuống!', 'success');
        }

        // Hàm về trang chủ
        function goToHome() {
            showNotification('Đang chuyển về trang chủ...', 'info');
            setTimeout(() => {
                // Trong thực tế, bạn sẽ chuyển hướng đến trang chủ
                window.location.href = '#';
            }, 1000);
        }

        // Hàm mở mạng xã hội
        function openSocial(platform) {
            const urls = {
                facebook: 'https://facebook.com',
                instagram: 'https://instagram.com',
                twitter: 'https://twitter.com',
                youtube: 'https://youtube.com'
            };

            showNotification(`Đang mở ${platform}...`, 'info');
            setTimeout(() => {
                window.open(urls[platform], '_blank');
            }, 500);
        }

        // Hàm hiển thị thông báo
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                animation: slideIn 0.3s ease-out;
            `;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // CSS cho animation thông báo
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'971038b207039590',t:'MTc1NTUwNzYzMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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
