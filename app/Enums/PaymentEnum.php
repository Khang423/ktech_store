<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentEnum extends Enum
{
    const SHIP_CODE = 0; // Thanh toán khi nhận hàng
    const ONLINE = 1; // Thanh toán trực tuyến
}
