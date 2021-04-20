<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;
use App\Models\User;
use App\Models\DocumentType;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Variables modificables
        $min_users = 5;
        $max_users = 200;
        //
        $this->command->info('--DEMO--');
        $this->command->info('Creating document types...');
        $document_types = [
          'Cédula de Ciudadanía',
          'Cédula de Extranjería',
          'Tarjeta de identidad',
          'Pasaporte',
          'Permiso Especial de Permanencia',
          'Menor sin identificación',
          'Adulto sin identidad',
        ];
        foreach ($document_types as $name) {
          DocumentType::create(['name' => $name]);
        }
        $this->command->info('Creating document types...DONE');
        $this->command->info('Document types created = '.count($document_types));
        $this->command->info('---');

        $this->command->info('Choosing random number of users.');
        $users = random_int($min_users,$max_users);
        $this->command->info('Users to create = '.$users);
        $this->command->info('Initializing Faker Factory');
        $faker = \Faker\Factory::create();
        $this->command->info('Creating Users');
        for ($i=1; $i <= $users; $i++) {
          $gender = random_int(1,2);
          if ($gender == 1) {
            $first_name = $faker->unique()->firstNameMale;
          }
          else {
            $first_name = $faker->unique()->firstNameFemale;
          }
          $full_name = $first_name.' '.$faker->lastName;
          $user_document_type = DocumentType::inRandomOrder()->first()->id;

          User::create([
            "name" => $full_name,
            "email" => $faker->email,
            "document_type_id" => $user_document_type
          ]);
          $this->command->info('['.$i.'/'.$users.']');
        }
        $this->command->info('DONE');
    }
}
