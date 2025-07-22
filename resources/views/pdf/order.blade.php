<!DOCTYPE html>
<html lang="vi">


<head>
    <link rel="shortcut icon" href="https://ktech.id.vn/asset/admin/systemImage/ktech-dark.svg">
    <meta charset="UTF-8">
    <title>Hóa đơn {{ $data->ref_code }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .invoice-container {
            width: 100%;
            max-width: 480pt;
            margin: 0 auto;
            padding: 0;
            box-sizing: border-box;
        }

        .company-header {
            border-bottom: 1pt solid #000;
            padding: 8pt 0;
        }

        .company-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 70pt;
            height: 50pt;
            text-align: center;
            vertical-align: middle;
            background-color: #000;
            font-weight: bold;
            color: #2d5a2d;
            font-size: 9pt;
        }

        img {
            display: block;
            margin: 0 auto;
            /* Căn giữa */
            max-width: 100%;
            max-height: 100%;
            height: 100px;
            object-fit: contain;
        }

        .company-info {
            padding-left: 8pt;
            font-size: 9pt;
        }

        .invoice-title {
            font-size: 12pt;
            font-weight: bold;
            margin: 12pt 0 5pt 0;
        }

        .invoice-details,
        .status-paid,
        .customer-info,
        .bank-info {
            font-size: 9pt;
            margin-bottom: 8pt;
        }

        .status-paid {
            color: #dc3545;
            font-weight: bold;
        }

        .customer-info {
            background: #f8f9fa;
            border: 1pt solid #ddd;
            padding: 8pt;
        }

        .invoice-table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
            margin-top: 8pt;
            table-layout: fixed;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1pt solid #000;
            padding: 3pt;
            text-align: center;
            box-sizing: border-box;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .summary-table {
            width: 100%;
            font-size: 9pt;
            border-collapse: collapse;
            margin-top: 12pt;
        }

        .summary-table th,
        .summary-table td {
            border: 1pt solid #000;
            padding: 4pt;
        }

        .total-amount {
            font-weight: bold;
            font-size: 10pt;
        }

        .qr-table {
            width: 100%;
            margin-top: 18pt;
            border-collapse: collapse;
        }

        .qr-code {
            width: 90pt;
            height: 90pt;
            border: 1pt solid #ccc;
            background: #f0f0f0;
            text-align: center;
            vertical-align: middle;
            font-size: 8pt;
        }

        .bank-info {
            padding-left: 8pt;
            font-size: 9pt;
        }

        table,
        tr,
        td,
        th {
            page-break-inside: avoid;
        }
    </style>

</head>

<body>
    <div class="invoice-container">
        <div class="company-header">
            <table class="company-table">
                <tr>
                    <td class="logo-cell">
                        <img src="https://ktech.id.vn/asset/admin/systemImage/KtechLogo.png" alt="">
                    </td>
                    <td class="company-info">
                        <strong>K-Tech Store</strong><br>
                        Mã số thuế: ##########<br>
                        Địa chỉ: #########################<br>
                        Điện thoại: 0799599040<br>
                        STK: 0799599040 tại Mb Bank
                    </td>
                </tr>
            </table>
        </div>

        <div class="invoice-title">HÓA ĐƠN {{ $data->ref_code ?? '' }}</div>

        <div class="invoice-details">
            Hóa đơn ngày: {{ $data->created_at }}<br>
            Ngày đến hạn: {{ $data->updated_at }}
        </div>

        <div class="status-paid">
            Trạng thái: Chưa thanh toán | Số tiền: {{ formatPriceToVND($data->total_amount) }}
        </div>

        <div class="customer-info">
            Họ tên: Võ Vĩ Khang<br>
            Địa chỉ: Ấp 7 Chợ, Đông Thái, An Biên, Kiên Giang<br>
            Hình thức: QR/PAY/ATM/Credit
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width:40px">STT</th>
                    <th>Sản phẩm</th>
                    <th>ĐVT</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                    $sum = 0;
                @endphp
                @foreach ($data->stockImportDetails as $i)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td class="text-left">{{ $i->productVersion->name }}</td>
                        <td>Chiếc</td>
                        <td>{{ $i->quantity }}</td>
                        <td class="text-center">{{ formatPriceToVND($i->price) }}</td>
                        <td class="text-right">{{ formatPriceToVND($i->price * $i->quantity) }}</td>
                    </tr>
                    {{ $sum += $i->price * $i->quantity }}
                @endforeach
                <tr>
                    <td colspan="5" class="text-right">Tạm tính</td>
                    <td colspan="1" class="text-right">{{ formatPriceToVND($sum) }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Thuế VAT</td>
                    <td colspan="1" class="text-right">0 đ</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right total-amount">Tổng</td>
                    <td colspan="1" class="text-right total-amount">{{ formatPriceToVND($sum) }}</td>
                </tr>
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <th>Tổng hợp</th>
                <th>Trước thuế</th>
                <th>VAT</th>
                <th>Tổng thanh toán</th>
            </tr>
            <tr>
                <td>Không chịu thuế</td>
                <td class="text-right">{{ formatPriceToVND($sum) }}</td>
                <td class="text-right">0 đ</td>
                <td class="text-right">{{ formatPriceToVND($sum) }}</td>
            </tr>
        </table>

        <table class="qr-table">
            <tr>
                <td class="qr-code">
                    <img src="" alt="">
                </td>
                <td class="bank-info">
                    <strong>Thông tin chuyển khoản</strong><br>
                    Ngân hàng: MBBank<br>
                    STK: 0799599040<br>
                    Chủ TK: Võ Vĩ Khang<br>
                    Nội dung: {{ $data->ref_code}}<br>
                    Số tiền: {{ formatPriceToVND($sum) }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
