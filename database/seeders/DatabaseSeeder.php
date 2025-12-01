<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer un admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@barbershop.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'phone' => '+216 12 345 678'
        ]);

        // Créer un client test
        User::create([
            'name' => 'Client Test',
            'email' => 'client@test.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'phone' => '+216 98 765 432'
        ]);

        // Créer des services
        Service::create([
            'name' => 'Coupe Classique',
            'description' => 'Coupe de cheveux traditionnelle avec finitions',
            'price' => 15.00,
            'duration' => 30,
            'is_active' => true
        ]);

        Service::create([
            'name' => 'Coupe + Barbe',
            'description' => 'Coupe de cheveux avec taille et rasage de barbe',
            'price' => 25.00,
            'duration' => 45,
            'is_active' => true
        ]);

        Service::create([
            'name' => 'Rasage Traditionnel',
            'description' => 'Rasage complet au rasoir avec serviette chaude',
            'price' => 12.00,
            'duration' => 20,
            'is_active' => true
        ]);

        Service::create([
            'name' => 'Coupe Moderne',
            'description' => 'Coupe tendance avec styling',
            'price' => 20.00,
            'duration' => 40,
            'is_active' => true
        ]);
    }
}