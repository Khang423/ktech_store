<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TagEnums extends Enum
{
    const CORE_CPU = 'core-cpu';
    const OptionTwo = 1;
    const OptionThree = 2;
}
