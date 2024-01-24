<?php

namespace App\Models;

use Laravel\Nova\Actions\Actionable;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory, Actionable;

    const SUPER_ADMIN_LEVEL    = 0;
    const ADMINISTRADOR_LEVEL  = 1;
}
