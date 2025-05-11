<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductTypeEnum extends Enum
{
    const LAPTOP = 'laptop';
    const PHONE = 'phone';
    const KEYBOARD = 'keyboard';
    const MOUSE = 'mouse';
    const HEADPHONE = 'headphone';
}
