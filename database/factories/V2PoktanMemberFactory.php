<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\V2Kelompoktani;
use App\Models\V2PoktanMember;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V2PoktanMember>
 */
class V2PoktanMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $poktan_id = V2Kelompoktani::all()->random();
        return [
            'nama_petani' => $this->faker->name(),
            'v2kelompoktani_id' => $poktan_id,
            'ktp_petani' => $this->faker->randomNumber(8) . $this->faker->randomNumber(8),
            'luas_lahan' => $this->faker->randomFloat(2, 5, 100),
            'alamat' => $this->faker->streetAddress(),
            'province_id' => 32,
            'city_id' => 3201,
            'district_id' => 3201210,
            'village_id' => 3201210004,
            'profile_img' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
