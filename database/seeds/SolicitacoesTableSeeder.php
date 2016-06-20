<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

use Illuminate\Database\Seeder;

class SolicitacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\pt_BR\Address($faker));
        
        for ($i = 0; $i < 100; $i++) {
            DB::table('solicitacao')->insert(
                [
                    'id' => ($i + 1 + 10),
                    'cep' => "90050-003",
                    'uf' => array_rand(self::$UF, 1),
                    'cidade' => $faker->city,
                    'bairro' => $faker->name,
                    'endereco' => $faker->name,
                    'endereco_complemento' => $faker->address,
                    'observacao' => $faker->text(255),
                    'tipo' => rand(0, 4),
                    'created_at' => $faker->datetime(),
                    'updated_at' => $faker->datetime()
                ]
            );
        }
    }
}
