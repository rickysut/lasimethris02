<?php

namespace Database\Factories;

use App\Models\DataUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataUserFactory extends Factory
{
    protected $model = DataUser::class;

    public function definition()
    {
        return [
            'user_id' => 2,
            'name' => $this->faker->name,
            'mobile_phone' => $this->faker->phoneNumber,
            'fix_phone' => $this->faker->optional()->phoneNumber,
            'company_name' => $this->faker->company,
            'pic_name' => $this->faker->name,
            'jabatan' => $this->faker->jobTitle,
            'npwp_company' => $this->faker->numerify('##.###.###.#-###.###'),
            'nib_company' => $this->faker->numerify('##.#######.#-###.###'),
            'address_company' => $this->faker->address,
            'provinsi' => 35,
            'kabupaten' => 3501,
            'kecamatan' => null,
            'desa' => null,
            'kodepos' => $this->faker->optional()->postcode,
            'fax' => $this->faker->optional()->phoneNumber,
            'ktp' => $this->faker->optional()->numerify('################'),
            'ktp_image' => null,
            'assignment' => $this->faker->optional()->word,
            'avatar' => null,
            'logo' => null,
            'email_company' => $this->faker->optional()->companyEmail,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
