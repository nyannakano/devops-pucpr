<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResultFactory extends Factory
{
    public function definition()
    {
        return [
            'result' => random_int()
        ];
    }
}
