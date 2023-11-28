<?php

namespace App\Actions;

use App\Program;
use Illuminate\Support\Str;

class ConvertProgramToIdAction
{
    public function execute(string $program): int
    {
        $normalizedProgram = Str::lower($program);

        return Program::query()->where('name', $normalizedProgram)->first()->id;
    }
}
