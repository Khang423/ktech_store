<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    const DEFAULT = 0;
    const PENDING = 1;  // Chờ xác nhận
    const PROCCESSING = 2; // Đang xử lý
    const SHIPED = 3; // Đang giao hàng
    const DELIVERED = 4; // Đã giao hàng
    const CANCELLE  = 5; // Đã hủy
}
