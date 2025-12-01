<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Group;

/** @extends Factory<Student> */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $first = $this->faker->firstName();
        $last = $this->faker->lastName();
        $branch = Branch::inRandomOrder()->first();
        $group = Group::inRandomOrder()->first();

        return [
            'first_name' => $first,
            'second_name' => $last,
            'email' => strtolower($first.'.'.$last).'@example.com',
            'phone' => '+2507'.$this->faker->numberBetween(10000000, 99999999),
            'status' => $this->faker->randomElement(['active','inactive']),
            'dob' => $this->faker->date('Y-m-d', '-7 years'),
            'gender' => $this->faker->randomElement(['male','female']),
            'joined_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'jersey_name' => strtoupper($last),
            'jersey_number' => (string) $this->faker->numberBetween(1, 99),
            'school_name' => $this->faker->company().' School',
            'position' => $this->faker->randomElement(['FW','MF','DF','GK']),
            'coach' => $this->faker->name(),
            'sport_discipline' => $this->faker->randomElement(['Football','Basketball','Volleyball']),
            'branch_id' => $branch?->id,
            'group_id' => $group?->id,
        ];
    }
}
