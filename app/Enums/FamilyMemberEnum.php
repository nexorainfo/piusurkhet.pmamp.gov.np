<?php

namespace App\Enums;

enum FamilyMemberEnum: string
{
    case GRAND_MOTHER = 'grand mother';
    case FATHER = 'father';
    case MOTHER = 'mother';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::GRAND_MOTHER => 'हजुर आमा',
            self::FATHER => 'वुबा',
            self::MOTHER => 'आमा',
        };
    }


}
