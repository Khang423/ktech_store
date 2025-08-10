<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt Hàng Thành Công</title>
</head>

<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: Arial, sans-serif;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background: linear-gradient(90deg, #4f46e5, #9333ea); padding:20px; text-align:center; color:#fff;">
                            <div style="font-size:20px; font-weight:bold;">Đặt Hàng Thành Công!</div>
                            <div style="font-size:14px; font-weight:normal; margin-top:4px;">
                                Cảm ơn bạn đã mua sắm tại cửa hàng chúng tôi
                            </div>
                        </td>
                    </tr>
                    @php
                        $methodList = [
                            0 => 'Thanh toán khi nhận hàng',
                            1 => 'Thanh toán trực tuyến MOMO',
                            2 => 'Thanh toán chuyển khoảng ngân hàng',
                        ];
                        $method = $methodList[$order->method_payment] ?? 'Không xác định';
                    @endphp

                    <!-- Order Info -->
                    <tr>
                        <td style="padding:20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td colspan="4" style="font-weight:bold; font-size:16px; padding-bottom:8px;">
                                        Thông Tin Đơn Hàng
                                    </td>
                                </tr>
                                <tr style="font-size:14px; color:#374151; font-weight:bold;">
                                    <td style="padding:4px 0;">Mã đơn hàng</td>
                                </tr>
                                <tr style="font-size:14px; color:#111827;">
                                    <td style="padding:4px 0;">{{ $order->order_code }}</td>
                                </tr>
                                <tr style="font-size:14px; color:#374151; font-weight:bold;">
                                    <td style="padding:4px 0;">Ngày đặt</td>
                                </tr>
                                <tr style="font-size:14px; color:#111827;">
                                    <td style="padding:4px 0;">{{ $order->created_at }}</td>
                                <tr style="font-size:14px; color:#374151; font-weight:bold;">
                                    <td style="padding:4px 0;">Phương thức thanh toán</td>
                                </tr>
                                <tr style="font-size:14px; color:#111827;">
                                    <td style="padding:4px 0;">{{ $method }}g</td>
                                </tr>
                                <tr style="font-size:14px; color:#374151; font-weight:bold;">
                                    <td style="padding:4px 0;">Trạng thái</td>
                                </tr>
                                <tr style="font-size:14px; color:#111827;">
                                    <td style="padding:4px 0; color:#2563eb;">Đang xử lý</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Products -->
                    <tr>
                        <td style="padding:0 20px 20px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="font-size:14px; color:#374151; border-collapse:collapse;">
                                <tr>
                                    <td colspan="3" style="font-weight:bold; font-size:16px; padding:8px 0;">Sản Phẩm
                                        Đã Mua</td>
                                </tr>

                                <!-- Dữ liệu sản phẩm mẫu -->
                                @foreach ($order->orderItem as $i)
                                    <tr>
                                        <td style="padding:6px 0; width:40%; border-bottom:1px solid #e5e7eb;">
                                            {{ $i->productVersions->config_name }}</td>
                                        <td
                                            style="padding:6px 0;width:20%; border-bottom:1px solid #e5e7eb; text-align:center;">
                                            x{{ $i->quantity }}
                                        </td>
                                        <td
                                            style="padding:6px 0;width:40%; border-bottom:1px solid #e5e7eb; text-align:right;">
                                            {{ formatPriceToVND($i->unit_price) }}</td>
                                    </tr>
                                    @php
                                        $sum = 0;
                                        $sum += $i->unit_price * $i->quantity
                                    @endphp
                                @endforeach

                                <!-- Tổng cộng -->
                                <tr>
                                    <td colspan="2" style="padding-top:8px; font-weight:bold;">Tạm tính:</td>
                                    <td style="padding-top:8px; text-align:right;">{{ formatPriceToVND($sum) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:4px; font-weight:bold;">Phí vận chuyển:</td>
                                    <td style="padding-top:4px; text-align:right;">30.000₫</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:8px; font-weight:bold; font-size:16px;">Tổng
                                        cộng:</td>
                                    <td
                                        style="padding-top:8px; font-weight:bold; color:#4f46e5; text-align:right; font-size:16px;">
                                        {{ formatPriceToVND($sum + 30000) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Shipping Info -->
                    <tr>
                        <td style="padding:0 20px 20px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="font-size:14px; color:#374151; border-collapse:collapse;">
                                <tr>
                                    <td colspan="2" style="font-weight:bold; font-size:16px; padding:8px 0;">Thông
                                        Tin Giao Hàng</td>
                                </tr>
                                <tr>
                                    <td colspan="2"
                                        style="background-color:#f3f4f6; padding:10px; border-radius:4px;">
                                        Họ tên: {{ $order->customers->name }}<br>
                                        Địa chỉ:
                                        {{ $order->note . ' - ' . $order->wards->name . ' - ' . $order->districts->name . ' - ' . $order->cities->name }}<br>
                                        SĐT: {{ $order->customers->tel }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
