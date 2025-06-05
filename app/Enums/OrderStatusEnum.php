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
    const DEFAULT = 0; // Chờ xác nhận
    const PENDING = 1; // Đang xử lý
    const PROCCESSING = 2; // Đang giao hàng
    const SHIPED = 3; // Đã giao hàng
    const DELIVERED = 4; // Đã hủy
    const CANCELLED = 5; // Đã hủy
}
