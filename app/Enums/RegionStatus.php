<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RegionStatus extends Enum
{
    const Activo = 'A';
    const Inactivo = 'I';
    const Eliminado= 'trash';
}
