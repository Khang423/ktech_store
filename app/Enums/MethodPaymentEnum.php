<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MethodPaymentEnum extends Enum
{
    const COD = 0; // thanh toán khi nhận hàng
    const VNPAY = 1; // Thanh toán bằng ví momo
}
