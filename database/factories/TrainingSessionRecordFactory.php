<?php

namespace Database\Factories;

use App\Models\TrainingSessionRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSessionRecordFactory extends Factory
{
    protected $model = TrainingSessionRecord::class;

    public function definition()
    {
        $coach = User::inRandomOrder()->first();

        $faker = $this->faker ?? \Faker\Factory::create();

        $part1Activities = [
            'Warm-up exercises including jogging, dynamic stretching, and mobility drills. Ball familiarization with individual dribbling practice.',
            'Technical drills focusing on passing accuracy and first touch control. Small-sided games for ball retention.',
            'Speed and agility ladder drills. Cone dribbling exercises with both feet. Partner passing sequences.',
            'Rondo exercises in small groups. Positional awareness training. Quick passing combinations.',
            'Physical conditioning with interval running. Core strengthening exercises. Balance and coordination drills.',
        ];

        $part2Activities = [
            'Tactical formation practice with 4-3-3 positioning. Defensive pressing drills and transition play exercises.',
            'Shooting practice from various angles. Crossing and finishing combinations. Goalkeeper distribution work.',
            'Match simulation with focus on build-up play from the back. Set piece practice including corners and free kicks.',
            'Small-sided games 5v5 with specific objectives. Counter-attacking scenarios. High pressing exercises.',
            'Full squad scrimmage with tactical instructions. Position-specific coaching during play. Cool-down and stretching.',
        ];

        $part3Notes = [
            'Players showed good energy and focus throughout the session. Need to work on communication during defensive transitions.',
            'Excellent participation from all players. Some players need additional work on their weaker foot.',
            'Great improvement in passing accuracy compared to last week. Players are understanding tactical concepts better.',
            'Session went well despite weather conditions. Players maintained concentration and effort levels.',
            'Good competitive spirit during the scrimmage. Some players need to improve their fitness levels.',
        ];

        $part4Messages = [
            'Remember to bring water bottles and arrive 10 minutes early for next session.',
            'Great work today team! Keep practicing at home.',
            'Next session will focus on defensive organization. Be prepared.',
            'Well done everyone. See you at the next training.',
            'Excellent effort today. Rest well and stay hydrated.',
        ];

        $mainTopics = [
            'Passing and Ball Control',
            'Defensive Positioning',
            'Attacking Movements',
            'Set Pieces',
            'Fitness and Conditioning',
            'Tactical Awareness',
            'Shooting Techniques',
            'Team Communication',
            'Dribbling Skills',
            'Goalkeeper Training',
        ];

        $incidentReports = [
            null,
            null,
            'Minor collision between two players during scrimmage. No injuries reported.',
            'One player felt dizzy due to heat. Rested and recovered fully.',
            null,
            'Ball went over fence into neighboring property. Retrieved successfully.',
            null,
            null,
        ];

        $equipmentIssues = [
            null,
            null,
            'One training bib has a tear and needs replacement.',
            null,
            'Two cones are cracked and should be replaced.',
            null,
            'One ball is losing air, needs to be checked.',
            null,
        ];

        return [
            'coach_id' => $coach?->id,
            'coach_name' => $coach?->name,
            'branch' => $faker->randomElement(['Rwanda','Tanzania']),
            'training_pitch' => $faker->randomElement(['IPRC Kicukiro- Football', 'Green Hills Academy', 'Star School -Masaka', 'Nyamagana Stadium', 'IPRC-Kigali -Basketball']),
            'date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'start_time' => $faker->time('H:i:s'),
            'finish_time' => $faker->time('H:i:s'),
            'main_topic' => $faker->randomElement($mainTopics),
            'area_performance' => $faker->randomElement(['Physical', 'Technical', 'Tactical', 'Mental']),
            'part1_activities' => $faker->randomElement($part1Activities),
            'part2_activities' => $faker->randomElement($part2Activities),
            'part3_notes' => $faker->randomElement($part3Notes),
            'part4_message' => $faker->randomElement($part4Messages),
            'number_of_kids' => $faker->numberBetween(8, 30),
            'incident_report' => $faker->randomElement($incidentReports),
            'missed_damaged_equipment' => $faker->randomElement($equipmentIssues),
        ];
    }
}
