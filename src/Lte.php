<?php

namespace insolita\adminlte3;

use b;
use yii\helpers\StringHelper;

class Lte
{
    const TYPE_INFO = 'info';
    const TYPE_PRIMARY = 'primary';
    const TYPE_SECONDARY = 'secondary';
    const TYPE_SUCCESS = 'success';
    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_LIGHT = 'light';
    const TYPE_DARK = 'dark';
    
    const GRADIENT_INFO = 'info-gradient';
    const GRADIENT_PRIMARY = 'primary-gradient';
    const GRADIENT_SECONDARY = 'secondary-gradient';
    const GRADIENT_SUCCESS = 'success-gradient';
    const GRADIENT_DANGER = 'danger-gradient';
    const GRADIENT_WARNING = 'warning-gradient';
    const GRADIENT_GREY = 'grey-gradient';
    const GRADIENT_LIGHT = 'black-gradient';
    const GRADIENT_DARK = 'secondary-gradient';
    
    const COLOR_NAVY = 'navy';
    const COLOR_LIGHT_BLUE = 'light-blue';
    const COLOR_BLUE = 'blue';
    const COLOR_AQUA = 'aqua';
    const COLOR_RED = 'red';
    const COLOR_GREEN = 'green';
    const COLOR_YELLOW = 'yellow';
    const COLOR_PURPLE = 'purple';
    const COLOR_MAROON = 'maroon';
    const COLOR_TEAL = 'teal';
    const COLOR_OLIVE = 'olive';
    const COLOR_LIME = 'lime';
    const COLOR_ORANGE = 'orange';
    const COLOR_FUCHSIA = 'fuchsia';
    const COLOR_BLACK = 'black';
    const COLOR_GRAY = 'gray';
    
    public static function prepend(string $prefix, string $str, bool $skipEmpty = true)
    {
        if (empty($str) && $skipEmpty) {
            return $str;
        }
        return empty($str) && $skipEmpty ? $str : $prefix . $str;
    }
    
    public static function append(string $suffix, string $str, bool $skipEmpty = true)
    {
        if (empty($str) && $skipEmpty) {
            return $str;
        }
        return empty($str) && $skipEmpty ? $str : $str . $suffix;
    }
}