<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    const PENDING = 0; // Chờ xác nhận
    const PROCCESSING = 1; // Đang xử lý
    const SHIPED = 2; // Đang giao hàng
    const DELIVERED = 3; // Đã giao hàng
    const CANCELLED = 4; // Đã hủy
}
