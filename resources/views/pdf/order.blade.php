<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Hóa Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .invoice-container {
            background: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .invoice-header {
            background: white;
            border-bottom: 2px solid #dee2e6;
        }

        .logo-placeholder {
            width: 100px;
            height: 100px;
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .info-box {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
        }

        .invoice-table {
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
        }

        .invoice-table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .invoice-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .totals-box {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
        }

        .payment-info {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
        }

        .invoice-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 1.5rem;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .invoice-container {
                box-shadow: none !important;
            }
        }

        .btn-action {
            margin: 0 0.25rem;
        }

        [contenteditable="true"] {
            border: 1px dashed #007bff !important;
            border-radius: 0.25rem;
            padding: 0.5rem !important;
            background-color: #fff3cd;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="invoice-container">
            <!-- Header -->
            <div class="invoice-header p-4">
                <div class="row align-items-start">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold text-dark mb-3">HÓA ĐƠN</h1>
                        <p class="text-muted mb-1">Số hóa đơn: <strong>#INV-2024-001</strong></p>
                        <p class="text-muted">Ngày: <span id="currentDate"></span></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="logo-placeholder ms-auto">
                            LOGO
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company & Customer Info -->
            <div class="p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-semibold text-dark mb-3">Từ:</h5>
                        <div class="info-box">
                            <p class="fw-medium text-dark mb-2">Công ty ABC</p>
                            <p class="text-muted mb-1">123 Đường Nguyễn Văn A</p>
                            <p class="text-muted mb-1">Quận 1, TP.HCM</p>
                            <p class="text-muted mb-1">Điện thoại: 0123 456 789</p>
                            <p class="text-muted mb-0">Email: info@congtyabc.com</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-semibold text-dark mb-3">Đến:</h5>
                        <div class="info-box">
                            <p class="fw-medium text-dark mb-2">Khách hàng XYZ</p>
                            <p class="text-muted mb-1">456 Đường Lê Văn B</p>
                            <p class="text-muted mb-1">Quận 3, TP.HCM</p>
                            <p class="text-muted mb-1">Điện thoại: 0987 654 321</p>
                            <p class="text-muted mb-0">Email: khachhang@email.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="px-4">
                <div class="table-responsive">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th style="width: 8%;">STT</th>
                                <th style="width: 40%;">Mô tả</th>
                                <th style="width: 12%;" class="text-center">Số lượng</th>
                                <th style="width: 20%;" class="text-end">Đơn giá</th>
                                <th style="width: 20%;" class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceItems">
                            <tr>
                                <td class="text-center">1</td>
                                <td>Dịch vụ tư vấn</td>
                                <td class="text-center">1</td>
                                <td class="text-end">5,000,000 ₫</td>
                                <td class="text-end fw-medium">5,000,000 ₫</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Thiết kế website</td>
                                <td class="text-center">1</td>
                                <td class="text-end">10,000,000 ₫</td>
                                <td class="text-end fw-medium">10,000,000 ₫</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Bảo trì hệ thống</td>
                                <td class="text-center">12</td>
                                <td class="text-end">500,000 ₫</td>
                                <td class="text-end fw-medium">6,000,000 ₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totals -->
            <div class="p-4">
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <div class="totals-box">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Tạm tính:</span>
                                <span class="fw-medium" id="subtotal">21,000,000 ₫</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">VAT (10%):</span>
                                <span class="fw-medium" id="tax">2,100,000 ₫</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 fw-semibold text-dark">Tổng cộng:</span>
                                <span class="h4 fw-bold text-dark" id="total">23,100,000 ₫</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="px-4 pb-4">
                <div class="payment-info">
                    <h5 class="fw-semibold text-dark mb-3">Thông tin thanh toán</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>
                            <p class="text-muted mb-2"><strong>Số tài khoản:</strong> 1234567890</p>
                            <p class="text-muted mb-0"><strong>Chủ tài khoản:</strong> Công ty ABC</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-2"><strong>Hạn thanh toán:</strong> 30 ngày</p>
                            <p class="text-muted mb-0"><strong>Phương thức:</strong> Chuyển khoản</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="invoice-footer">
                <p class="text-muted mb-2">Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>
                <p class="small text-muted">Mọi thắc mắc xin liên hệ: info@congtyabc.com | 0123 456 789</p>
            </div>

            <!-- Action Buttons -->
            <div class="no-print p-4 bg-white border-top text-center">
                <button onclick="window.print()" class="btn btn-primary btn-action">
                    <i class="fas fa-print me-2"></i>In hóa đơn
                </button>
                <button onclick="downloadPDF()" class="btn btn-success btn-action">
                    <i class="fas fa-file-pdf me-2"></i>Tải PDF
                </button>
                <button onclick="editInvoice()" class="btn btn-secondary btn-action" id="editBtn">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current date
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('vi-VN');

        // Calculate totals
        function calculateTotals() {
            const rows = document.querySelectorAll('#invoiceItems tr');
            let subtotal = 0;

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    const amount = cells[4].textContent.replace(/[₫,\s]/g, '');
                    subtotal += parseInt(amount) || 0;
                }
            });

            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString('vi-VN') + ' ₫';
            document.getElementById('tax').textContent = tax.toLocaleString('vi-VN') + ' ₫';
            document.getElementById('total').textContent = total.toLocaleString('vi-VN') + ' ₫';
        }

        // Download PDF function
        function downloadPDF() {
            alert('Chức năng tải PDF sẽ được tích hợp với thư viện PDF generator trong phiên bản thực tế.');
        }

        // Edit invoice function
        function editInvoice() {
            const editBtn = document.getElementById('editBtn');
            const isEditing = document.body.classList.contains('editing');

            if (!isEditing) {
                // Enable editing mode
                document.body.classList.add('editing');

                // Make info boxes editable
                const editableElements = document.querySelectorAll('.info-box p');
                editableElements.forEach(el => {
                    if (el.textContent.trim()) {
                        el.contentEditable = true;
                    }
                });

                // Change button
                editBtn.innerHTML = '<i class="fas fa-save me-2"></i>Lưu';
                editBtn.className = 'btn btn-warning btn-action';
            } else {
                // Save and exit editing mode
                document.body.classList.remove('editing');

                const editableElements = document.querySelectorAll('[contenteditable="true"]');
                editableElements.forEach(el => {
                    el.contentEditable = false;
                });

                // Change button back
                editBtn.innerHTML = '<i class="fas fa-edit me-2"></i>Chỉnh sửa';
                editBtn.className = 'btn btn-secondary btn-action';

                // Recalculate totals
                calculateTotals();
            }
        }

        // Initialize
        calculateTotals();
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9679d260363709c0',t:'MTc1MzkzMDU3OC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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
