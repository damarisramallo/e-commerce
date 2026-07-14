<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talle',
                'type' => 1,
                'features' => [
                    [
                        'value' => 's',
                        'description' => 'small',
                    ],
                    [
                        'value' => 'm',
                        'description' => 'medium',
                    ],
                    [
                        'value' => 'l',
                        'description' => 'large',
                    ],
                    [
                        'value' => 'xl',
                        'description' => 'extra large',
                    ]
                ],
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#000000',
                        'description' => 'black',
                    ],
                    [
                        'value' => '#0000FF',
                        'description' => 'blue',
                    ],
                    [
                        'value' => '#FF0000',
                        'description' => 'red',
                    ],
                    [
                        'value' => '#FFFFFF',
                        'description' => 'white',
                    ],
                    [
                        'value' => '#FFFF00',
                        'description' => 'yellow',
                    ],
                ],
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'm',
                        'description' => 'masculino',
                    ],
                    [
                        'value' => 'f',
                        'description' => 'femenino',
                    ],
                ],
            ],
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);

            foreach($option['features'] as $feature) {
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }
    }
}
