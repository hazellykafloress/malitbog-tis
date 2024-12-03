<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\BusinessType;
use App\Models\Establishment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::factory()->create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'role_id' => Role::where('name', RoleEnum::ADMIN->value)->value('id')
    ]);

    $user = User::factory()->create([
      'name' => 'Owner1',
      'email' => 'owner@email.com',
      'role_id' => Role::where('name', RoleEnum::OWNER->value)->value('id')
    ]);


    Establishment::create([
      'user_id' => $user->id,
      'name' => 'Malitbog Municipality',
      'description' => 'Malitbog Municipality',
      'address' => 'Malitbog, Southern Leyte',
      'geolocation_longitude' => '125.00094211920187',
      'geolocation_latitude' => '10.158163827849396',
      'mode_of_access' => 'Car Access, Foot Access',
      'contact_number' => '+6391234567890',
      'business_type_id' => BusinessType::inRandomOrder()->first()?->id,
    ]);
  }
}
