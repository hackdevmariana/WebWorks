<?php

namespace App\Policies;

use App\Models\User;
use Works\Web\Models\Web; 

class WebPolicy
{
    /**
     * Permitir eliminar un registro específico.
     */
    public function delete(User $user, Web $web): bool
    {
        return true; 
    }

    /**
     * Permitir eliminar registros de forma masiva.
     */
    public function deleteAny(User $user): bool
    {
        return true; 
    }
}
