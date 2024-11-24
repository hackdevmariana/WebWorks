<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Content;
use Works\Web\Models\FeaturedContent;
use Works\Web\Models\PublicationPattern;
use Works\Web\Models\PublicationPeriod;

class FeaturedContentSeeder extends Seeder
{
    public function run(): void
    {
        $content = Content::create([
            'web_id' => 1,
            'name' => 'Highlighted Event',
            'slug' => 'highlighted-event',
            'title' => 'Event Title',
            'subtitle' => 'Important Subtitle',
            'text' => 'Event details go here.',
            'content_type' => 'event',
        ]);

        $featuredContent = FeaturedContent::create([
            'content_id' => $content->id,
        ]);

        PublicationPattern::create([
            'featured_content_id' => $featuredContent->id,
            'pattern' => 'every Monday and Thursday',
        ]);

        PublicationPeriod::create([
            'featured_content_id' => $featuredContent->id,
            'start_date' => now(),
            'end_date' => now()->addWeeks(2),
        ]);
    }
}
