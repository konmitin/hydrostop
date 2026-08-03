<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => env('APP_ADMIN_EMAIL'),
            'password' => "adminpass"
        ]);

        DB::table('branches')->insert([
            'name' => 'Санкт-Петербург',
            'code' => 'sankt-peterburg',
            'phone' => '+7 (812) 679 35-55',
            'email' => 'hydrostop@inbox.ru',
            'address' => '194100, Санкт-Петербург, Новолитовская 37',
            'is_main' => 'Y',
        ]);

        DB::table('statuses')->insert([
            'name' => 'В наличии'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Нет в наличии'
        ]);

        DB::table('categories')->insert([
            'name' => 'Бентонитовый шнур',
            'slug' => 'bentonitovii-shnur',
        ]);

        DB::table('categories')->insert([
            'name' => 'Гернитовый шнур',
            'slug' => 'gernitovii-shnur',
        ]);

        DB::table('units')->insert([
            'name' => 'пог.м'
        ]);

        DB::table('units')->insert([
            'name' => 'шт'
        ]);
        DB::table('units')->insert([
            'name' => 'кг'
        ]);

        DB::table('companies')->insert([
            'name' => 'ООО ГидроСтоп',
            'inn' => 7802954068,
        ]);
    }
}
