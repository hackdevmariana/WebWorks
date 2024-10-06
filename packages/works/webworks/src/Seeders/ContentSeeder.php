<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Hero;
use Works\Webworks\Models\Gallery;
use Works\Webworks\Models\Carousel;
use Works\Webworks\Models\Author;
use Works\Webworks\Models\PublicationPeriod;
use Works\Webworks\Models\PublicationPattern;

class ContentSeeder extends Seeder
{
    private function createHero($website, $author)
    {
        $heroContent = Content::firstOrCreate(
            ['slug' => Str::slug('Welcome to Example.com')],
            [
                'website_id' => $website->id,
                'web' => 'home-hero', // Cambiado de 'name' a 'web'
                'title' => 'Welcome to Example.com',
                'subtitle' => 'Test texts, for text tests.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/hero.png',
                'content_type' => 'hero',
                'is_default' => true,
                'author_id' => $author->id,
                'draft' => false
            ]
        );

        Hero::firstOrCreate(
            ['content_id' => $heroContent->id],
            ['website_id' => $website->id, 'web' => 'homepage-hero'] // Cambiado de 'name' a 'web'
        );
    }

    private function createAuthor($website)
    {
        return Author::updateOrCreate(
            ['username' => 'jdoe'],
            [
                'website_id' => $website->id,
                'username' => 'jdoe',
                'name' => 'John',
                'surname' => 'Doe',
                'links' => json_encode(['twitter' => 'https://twitter.com/jdoe']),
                'photo' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/author.jpg',
                'biography' => 'John Doe is a fictional example author.'
            ]
        );
    }

    private function createPattern($website)
    {
        return PublicationPattern::firstOrCreate(
            ['website_id' => $website->id, 'pattern_name' => 'Weekend Only'],
            [
                'day_of_the_week' => json_encode([1, 3, 4]),
                'type' => 'weekly'
            ]
        );
    }

    private function createPeriod($website, $newsContent, $publicationPattern)
    {
        PublicationPeriod::firstOrCreate(
            ['website_id' => $website->id, 'content_id' => $newsContent->id],
            [
                'start_day' => now(),
                'end_day' => now()->addWeek(),
                'pattern_id' => $publicationPattern->id,
            ]
        );
    }

    private function createNews($website, $author)
    {
        return Content::firstOrCreate(
            ['slug' => Str::slug('Breaking News Example')],
            [
                'website_id' => $website->id,
                'web' => 'breaking-news', // Cambiado de 'name' a 'web'
                'title' => 'Breaking News Example',
                'text' => 'This is the content of a breaking news article.',
                'content_type' => 'news',
                'is_default' => false,
                'author_id' => $author->id,
                'draft' => false
            ]
        );
    }

    private function createPost($website, $author)
    {
        return Content::firstOrCreate(
            ['slug' => Str::slug('First Blog Post Example')],
            [
                'website_id' => $website->id,
                'web' => 'first-blog-post', // Cambiado de 'name' a 'web'
                'title' => 'First Blog Post Example',
                'text' => 'This is an example blog post content.',
                'content_type' => 'post',
                'is_default' => false,
                'author_id' => $author->id,
                'draft' => false
            ]
        );
    }

    private function createGallery($website, $author)
    {
        $galleryContent = Content::firstOrCreate(
            ['slug' => Str::slug('Gallery for the homepage')],
            [
                'website_id' => $website->id,
                'web' => 'homepage-gallery', // Cambiado de 'name' a 'web'
                'title' => 'Gallery for the homepage',
                'content_type' => 'gallery',
                'is_default' => true,
                'author_id' => $author->id,
                'draft' => false
            ]
        );

        Gallery::firstOrCreate(
            ['content_id' => $galleryContent->id],
            ['website_id' => $website->id, 'web' => 'homepage-gallery'] // Cambiado de 'name' a 'web'
        );
    }

    private function createCarousel($website, $author)
    {
        $carouselContent = Content::firstOrCreate(
            ['slug' => Str::slug('Carousel for the homepage')],
            [
                'website_id' => $website->id,
                'name' => 'homepage-carousel', 
                'title' => 'Carousel for the homepage',
                'content_type' => 'carousel',
                'is_default' => true,
                'author_id' => $author->id,
                'draft' => false
            ]
        );

        return Carousel::firstOrCreate(
            ['content_id' => $carouselContent->id],
            ['website_id' => $website->id, 'name' => 'homepage-carousel'] 
        );
    }


    private function createCarouselItems($website, $author, $carousel)
    {
        $carouselItems = [
            [
                'slug' => Str::slug('Carousel Item 1'),
                'title' => 'Carousel Item 1',
                'text' => 'Description for item 1.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/carousel_image_01.png',
                'content_type' => 'carousel_item',
                'is_default' => true,
                'author_id' => $author->id,
            ],
            [
                'slug' => Str::slug('Carousel Item 2'),
                'title' => 'Carousel Item 2',
                'text' => 'Description for item 2.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/carousel_image_02.png',
                'content_type' => 'carousel_item',
                'is_default' => true,
                'author_id' => $author->id,
            ],
            [
                'slug' => Str::slug('Carousel Item 3'),
                'title' => 'Carousel Item 3',
                'text' => 'Description for item 3.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/carousel_image_03.png',
                'content_type' => 'carousel_item',
                'is_default' => true,
                'author_id' => $author->id,
            ],
            [
                'slug' => Str::slug('Carousel Item 4'),
                'title' => 'Carousel Item 4',
                'text' => 'Description for item 4.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/carousel_image_04.png',
                'content_type' => 'carousel_item',
                'is_default' => true,
                'author_id' => $author->id,
            ],
            [
                'slug' => Str::slug('Carousel Item 5'),
                'title' => 'Carousel Item 5',
                'text' => 'Description for item 5.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/carousel_image_05.png',
                'content_type' => 'carousel_item',
                'is_default' => true,
                'author_id' => $author->id,
            ],
        ];
        foreach ($carouselItems as $item) {
            $content = Content::firstOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['website_id' => $website->id, 'name' => $item['title']])
            );
    
            // Relacionar contenido con el carrusel usando la relación correcta
            $carousel->contents()->attach($content->id);
        }
    }

    private function createCallToAction($website, $author)
    {
        Content::firstOrCreate(
            ['slug' => Str::slug('Sign Up Today!')],
            [
                'website_id' => $website->id,
                'name' => 'sign-up-now',
                'title' => 'Sign Up Today!',
                'subtitle' => 'Don’t miss our offers',
                'content_type' => 'call-to-action',
                'url' => 'https://google.com',
                'is_default' => true,
                'author_id' => $author->id,
                'draft' => false
            ]
        );
    }



    public function run()
    {
        $website = Website::firstOrCreate(
            ['web' => 'example.com'],
            ['url' => 'https://example.com']
        );

        $author = $this->createAuthor($website);

        $this->createHero($website, $author);
        $this->createCallToAction($website, $author);
        $this->createGallery($website, $author);

        // Crear el carrusel y obtener el modelo de carrusel
        $carousel = $this->createCarousel($website, $author);

        // Asegurarse de que el carrusel fue creado correctamente antes de agregar los ítems
        if ($carousel) {
            $this->createCarouselItems($website, $author, $carousel);
        }

        $newsContent = $this->createNews($website, $author);
        $publicationPattern = $this->createPattern($website);
        $this->createPeriod($website, $newsContent, $publicationPattern);

        $this->createPost($website, $author);
    }


}
