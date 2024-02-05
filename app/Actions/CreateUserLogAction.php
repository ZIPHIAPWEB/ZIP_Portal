<?php

namespace App\Actions;

class CreateUserLogAction
{
    public function execute($activity): void
    {
        $user = auth()->user();

        $user->createLog($activity);
    }
}
