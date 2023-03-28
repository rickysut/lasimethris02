<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterKelompok>
 */
class MasterKelompokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'nama_kelompok' => $this->faker->company,
            'nama_pimpinan' => $this->faker->name,
            'hp_pimpinan' => $this->faker->phoneNumber,
            'id_provinsi' => 33,
            'id_kabupaten' => 3301,
            'id_kecamatan' => 330101,
            'id_kelurahan' => 3301010001,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
