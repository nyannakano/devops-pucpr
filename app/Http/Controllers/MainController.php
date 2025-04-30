<?php

namespace App\Http\Controllers;

use App\Models\Result;

class MainController extends Controller
{
    public function calculate($numberOne, $numberTwo)
    {
       if (!Result::exists()) {
           $result = Result::create([
               'result' => $numberOne + $numberTwo
           ]);

           return $result;
       }

       $result = Result::first();
       $result->result = $numberOne + $numberTwo;
       $result->save();

       return $result;
    }

    public function status()
    {
        if (!Result::exists()) {
            return 'Inexistente';
        }

        $result = Result::first();

        if ($result->result % 2 == 0) {
            return 'Par';
        }

        return 'Ímpar';
    }
}
