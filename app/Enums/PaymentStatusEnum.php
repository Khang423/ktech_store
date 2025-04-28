<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentStatusEnum extends Enum
{
    const PENDING = 0; // Chờ thanh toán
    const COMPLETED = 1; // Đã thanh toán
    const FAILED = 2; // Thanh toán thất bại
}
