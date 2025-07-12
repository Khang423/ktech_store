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
    const SSD_SIZE = 'dung-luong-ssd';
    const RAM_SIZE = 'dung-luong-ram';
    const USAGE_NEEDS = 'nhu-cau';
    const CPU_GEN = 'the-he-cpu';
    const DISPLAY_RESOLUTION = 'do-phan-giai-man-hinh';
    const GRAPHICS_CARD = 'card-do-hoa-roi';
    const DISPLAY_SIZE = 'kich-thuoc-man-hinh';
}
