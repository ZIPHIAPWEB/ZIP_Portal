<?php

namespace App\Actions;

class ProcessFlightInfoAction
{
    public function execute($data)
    {
        switch ($data->input('flight')) {
            case 'depart-mnl':
                return [
                    ''
                ];
                break;

            case 'arrive-us':
                return [

                ];
                break;

            case 'depart-us':
                return [
                    ''
                ];
                break;

            case 'arrive-mnl':
                return [

                ];
                break;
        }
    }
}
