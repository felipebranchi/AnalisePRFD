<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
        
        DB::table('users')->insert(
            // Usuario de teste
            // test@example.com
            // 123456
            [
                'id' => 1,
                'name' => "Usuario de Teste",
                'Email' => "paciente@example.com",
                'password' => '$2y$10$JhHj9wmj98NI.Z1MyR321eG934RssXCDIo.39.PaTpn6gOBBoxilu',
                'remember_token' => null,
                'created_at' => "2016-06-20 11:00:00",
                'updated_at' => "2016-06-20 11:00:00"
            ]
        );
        // Cria demais usuarios
        for ($i = 2; $i < 111; $i++) {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'name' => $faker->name,
                    'Email' => $faker->safeEmail,
                    'password' => '$2y$10$PDSF8m7R0uwKCYXhe5Liy.98e/AVEJfcTp/vepsakSU6V/4Sc7S2S',
                    'remember_token' => null,
                    'created_at' => "2016-06-20 11:00:00",
                    'updated_at' => "2016-06-20 11:00:00"
                ]
            );
        }
    }
}