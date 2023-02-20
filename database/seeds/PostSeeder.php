<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Model\Artikel\Kategori;
use App\Model\Artikel\Artikel;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        //Kategori
        for ($i=1; $i <=8 ; $i++) { 
            $kategori = new Kategori();
            $kategori->name = $faker->city;
            $kategori->status = 'active';
            $kategori->user_id = '0e888eef-d648-4080-9bdc-a561ad274322';
            $kategori->save();

            $a = rand(2,5);
            for ($j=1; $j <=$a ; $j++) { 
                $artikel = new Artikel();
                $artikel->category_id = $kategori->id;
                $artikel->title = $faker->realText($maxNbChars = 50, $indexSize = 2);
                $artikel->content = $faker->realText($maxNbChars = 600, $indexSize = 2);
                $artikel->status = 'publish';
                $artikel->user_id = '0e888eef-d648-4080-9bdc-a561ad274322';
                $artikel->save();
            }
        }
    }
}
