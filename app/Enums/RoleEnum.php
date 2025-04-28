<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    const ROOT_ADMIN = 0;
    const SALE_STAFF = 1;
    const WHEREHOUSE_STAFF = 2;
}
