<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $table = $this->table('users');
        $table->truncate();

        $date = new DateTime();
        $end = $date->getTimestamp();
        $start = $end - (365 * 24 * 60 * 60);

        $faker = Faker\Factory::create('pt_BR');
        $users = [];

        for ($i = 0; $i < 10; $i++) {
            $int = mt_rand($start, $end);
            $data = date("Y-m-d H:i:s", $int);

            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => $faker->userName,
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'hash' => '',
                'admin' => 1,
                'last_access' => null,
                'created_at' => $data,
                'updated_at' => null
            ];
        }

        $table->insert($users)->save();
    }
}
