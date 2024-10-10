<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Cycle;

class CycleSeeder extends Seeder
{
    public function run()
    {
        $cycles = [
            [
                'name' => 'Spring Educational Conference',
                'slug' => 'spring-educational-conference',
                'start' => '2025-03-01',
                'end' => '2025-06-01',
                'pattern' => 'weekly',
                'days' => json_encode(['Monday', 'Wednesday']),
                'links' => json_encode(['https://springeduconf.com']),
                'media' => json_encode(['https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/event_banner.png']),
                'tag' => 'education',
                'frequency' => 'weekly',
            ],
            [
                'name' => 'Autumn Learning Sessions',
                'slug' => 'autumn-learning-sessions',
                'start' => '2025-09-01',
                'end' => '2025-11-30',
                'pattern' => 'bi-weekly',
                'days' => json_encode(['Tuesday', 'Thursday']),
                'links' => json_encode(['https://autumnlearningsessions.com']),
                'media' => json_encode(['https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo_organization.png']),
                'tag' => 'learning',
                'frequency' => 'bi-weekly',
            ],
        ];

        foreach ($cycles as $cycle) {
            Cycle::create($cycle);
        }
    }
}
