<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MethodPaymentEnums extends Enum
{
    const COD = 1;
    const QR_CODE = 2;
    const MOMO = 3;
}
