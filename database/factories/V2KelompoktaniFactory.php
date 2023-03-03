<?php

namespace Database\Factories;

use App\Models\V2Kelompoktani;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelompoktani>
 */
class V2KelompoktaniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [
            'user_id' => 45,
            'cpcl_id' => null,
            'simluhtan_id' => null,
            'nama_kelompok' => $this->faker->company(),
            'nama_pimpinan' => $this->faker->name(),
            'hp_pimpinan' => $this->faker->phoneNumber(),
            'id_provinsi' => 32,
            'id_kabupaten' => 3201,
            'id_kecamatan' => 320101,
            'id_kelurahan' => 3201010001,
            'jumlah_anggota' => $this->faker->numberBetween(5, 50),
            'luas_lahan' => $this->faker->randomFloat(2, 5, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
