<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spaces')->insert([
            [
                'name' => "BIBLIOTECA PÚBLICA",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "CASA DAS ARTES",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 6,
                    "dayName": "domingo",
                    "firstHour": 15,
                    "lastHour": 20
                }]'
            ],
            [
                'name' => "CENTRO CULTURAL PALÁCIO DA JUSTIÇA",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "CENTRO CULTURAL PALÁCIO RIO NEGRO",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "CENTRO CULTURAL POVOS DA AMAZÔNIA",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 15
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 15
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 15
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 15
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 15
                }]'
            ],
            [
                'name' => "GALERIA DO LARGO",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 15,
                    "lastHour": 20
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 15,
                    "lastHour": 20
                },
                {
                    "day": 6,
                    "dayName": "domingo",
                    "firstHour": 15,
                    "lastHour": 20
                }]'
            ],
            [
                'name' => "MUSEU CASA EDUARDO RIBEIRO",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "MUSEU DO SERINGAL",
                'available' => true,
                'schedules' => '[{
                    "day": 0,
                    "dayName": "segunda-feira",
                    "firstHour": 9,
                    "lastHour": 16
                },
                {
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 16
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 16
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 16
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 16
                },
                {
                    "day": 6,
                    "dayName": "domingo",
                    "firstHour": 9,
                    "lastHour": 15
                }]'
            ],
            [
                'name' => "PALACETE PROVINCIAL",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "TEATRO AMAZONAS",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 6,
                    "dayName": "domingo",
                    "firstHour": 9,
                    "lastHour": 13
                }]'
            ],
            [
                'name' => "USINA CHAMINÉ",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ],
            [
                'name' => "Biblioteca Infantil Emídio Vaz",
                'available' => true,
                'schedules' => '[{
                    "day": 1,
                    "dayName": "terça-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 2,
                    "dayName": "quarta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },
                {
                    "day": 3,
                    "dayName": "quinta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 4,
                    "dayName": "sexta-feira",
                    "firstHour": 9,
                    "lastHour": 17
                },    
                {
                    "day": 5,
                    "dayName": "sábado",
                    "firstHour": 9,
                    "lastHour": 17
                }]'
            ]
        ]);
    }
}