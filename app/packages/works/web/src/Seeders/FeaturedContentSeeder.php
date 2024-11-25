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
        // Ejemplo 1: Evento destacado con patrón semanal (lunes y jueves)
        $content1 = Content::create([
            'web_id' => 1,
            'name' => 'Highlighted Event',
            'slug' => 'highlighted-event',
            'title' => 'Event Title',
            'subtitle' => 'Important Subtitle',
            'text' => 'Event details go here.',
            'content_type' => 'event',
            'author_id' => 1,
        ]);

        $featuredContent1 = FeaturedContent::create([
            'content_id' => $content1->id,
        ]);

        PublicationPattern::create([
            'featured_content_id' => $featuredContent1->id,
            'pattern' => 'every Monday and Thursday',
        ]);

        PublicationPeriod::create([
            'featured_content_id' => $featuredContent1->id,
            'start_date' => now(),
            'end_date' => now()->addWeeks(2),
        ]);

        // Ejemplo 2: Contenido que se muestra los domingos
        $content2 = Content::create([
            'web_id' => 1,
            'name' => 'Sunday Content',
            'slug' => 'sunday-content',
            'title' => 'Sunday Exclusive',
            'subtitle' => 'Special for Sundays',
            'text' => 'This content is visible only on Sundays.',
            'content_type' => 'article',
            'author_id' => 2,
        ]);

        $featuredContent2 = FeaturedContent::create([
            'content_id' => $content2->id,
        ]);

        PublicationPattern::create([
            'featured_content_id' => $featuredContent2->id,
            'pattern' => 'every Sunday',
        ]);

        PublicationPeriod::create([
            'featured_content_id' => $featuredContent2->id,
            'start_date' => now(),
        ]);

        // Ejemplo 3: Contenido que se muestra desde el día 20 hasta fin de mes
        $content3 = Content::create([
            'web_id' => 1,
            'name' => 'End of Month Content',
            'slug' => 'end-of-month-content',
            'title' => 'End of Month Special',
            'subtitle' => 'Limited Time Content',
            'text' => 'This content is visible from the 20th to the end of the month.',
            'content_type' => 'event',
            'author_id' => 3,
        ]);

        $featuredContent3 = FeaturedContent::create([
            'content_id' => $content3->id,
        ]);

        PublicationPattern::create([
            'featured_content_id' => $featuredContent3->id,
            'pattern' => '20th to last day of the month',
        ]);

        PublicationPeriod::create([
            'featured_content_id' => $featuredContent3->id,
            'start_date' => now()->startOfMonth()->addDays(19), // Día 20
            'end_date' => now()->endOfMonth(), // Fin de mes
        ]);
    }
}
