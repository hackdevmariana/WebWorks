<?php

namespace Works\Quoteworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Quoteworks\Models\{
    QuoteAuthor,
    QuoteBook,
    QuoteCategory,
    QuoteCollaboration,
    QuoteCollection,
    QuoteComment,
    QuoteLink,
    QuoteMedia,
    QuoteQuote,
    QuoteReview,
    QuoteSchool
};
use Illuminate\Support\Str;

class QuoteWorksSeeder extends Seeder
{
    public function run()
    {
        $media = $this->createMedia();
        $author = $this->createAuthor();
        $this->attachMediaToAuthor($author, $media);
        $book = $this->createBook($author);
        $quote = $this->createQuote($author, $book);
        $category = $this->createCategory();
        $this->attachQuoteToCategory($quote, $category);
        $collaboration = $this->createCollaboration();
        $this->attachCollaborationToAuthor($author, $collaboration);
        $collection = $this->createCollection();
        $this->attachBookToCollection($book, $collection);
        $this->createComment($book);
        $this->createReview($book);
    }

    private function createMedia()
    {
        return QuoteMedia::firstOrCreate([
            'name' => 'Video Interview',
            'slug' => Str::slug('Video Interview'),
            'description' => 'An interview with the author.',
            'url' => 'http://example.com/video-interview',
            'type' => 'video'
        ]);
    }

    private function createAuthor()
    {
        $authorSlug = Str::slug('John Doe');
        $author = QuoteAuthor::where('slug', $authorSlug)->first();

        if (!$author) {
            $author = QuoteAuthor::firstOrCreate([
                'name' => 'John',
                'surname' => 'Doe',
                'slug' => Str::slug('John Doe'),
                'media' => json_encode(['url' => 'http://example.com/media.jpg']),
                'areas_of_study' => json_encode(['Philosophy', 'Ethics', 'Logic']),
                'school' => json_encode(['Some Philosophical School', 'Other School']),
                'urls' => json_encode(['http://example.com', 'http://another-example.com']),
                'birth' => json_encode(['date' => '1960-01-01', 'place' => 'Unknown']),
                'death' => null,
                'biography' => 'John Doe is a contemporary philosopher.',
                'published_books' => json_encode(['Book 1', 'Book 2', 'Book 3']),
                'links_to_articles' => json_encode(['http://example.com/article', 'http://example.com/another-article']),
                'author_slug' => Str::slug('john-doe'),
                'views' => 100,
            ]);
        }

        return $author;
    }

    private function attachMediaToAuthor($author, $media)
    {
        $author->media()->attach($media->id);
    }

    private function createBook($author)
    {
        $baseSlug = Str::slug('El título en español');
        $slug = $baseSlug;

        // Verifica si el slug ya existe
        $existingBook = QuoteBook::where('slug', $slug)->first();
        if ($existingBook) {
            $count = 1;
            while (QuoteBook::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
        }

        $book = QuoteBook::firstOrCreate([
            'title_in_spanish' => 'El título en español',
            'slug' => $slug,
            'original_title' => 'Original Title',
            'original_language' => 'English',
            'author' => 'John Doe',
            'translator' => 'Jane Doe',
            'publisher' => 'Great Publisher',
            'number_of_pages' => 300,
            'publication_date' => '2000-01-01',
            'weight' => 0.5,
            'dimensions' => '21x15cm',
            'links' => json_encode(['http://example.com/book-link', 'http://example.com/another-book-link']),
            'media' => json_encode(['http://example.com/book-media', 'http://example.com/another-book-media']),
            'isbn' => '1234567890123',
            'category' => 'Philosophy',
            'synopsis' => 'A book about philosophy.',
            'comments' => 'This is a great book.',
            'views' => 500,
        ]);

        $book->authors()->attach($author->id);

        return $book;
    }

    private function createQuote($author, $book)
    {
        return QuoteQuote::firstOrCreate([
            'quote' => 'The unexamined life is not worth living.',
            'author_id' => $author->id,
            'id_book' => $book->id,
            'views' => 1000,
        ]);
    }

    private function createCategory()
    {
        return QuoteCategory::firstOrCreate([
            'name' => 'Philosophy',
            'slug' => Str::slug('Philosophy'),
            'description' => 'Quotes related to philosophy.',
            'related_fields' => 'Metaphysics, Ethics',
        ]);
    }

    private function attachQuoteToCategory($quote, $category)
    {
        $category->quoteQuotes()->attach($quote->id);
    }

    private function createCollaboration()
    {
        return QuoteCollaboration::firstOrCreate([
            'type_of_collaboration' => 'Co-author',
            'description' => 'Co-authored with another philosopher.',
            'year' => 1990,
        ]);
    }

    private function attachCollaborationToAuthor($author, $collaboration)
    {
        $author->collaborations()->attach($collaboration->id);
    }

    private function createCollection()
    {
        return QuoteCollection::firstOrCreate([
            'collection' => 'Classic Philosophy',
            'slug' => Str::slug('Classic Philosophy'),
            'description' => 'A collection of classic philosophical works.',
        ]);
    }

    private function attachBookToCollection($book, $collection)
    {
        $collection->books()->attach($book->id);
    }

    private function createComment($book)
    {
        QuoteComment::firstOrCreate([
            'user_id' => 1,
            'title' => 'Great Book',
            'slug' => Str::slug('Great Book'),
            'comment' => 'This book provides great insight into philosophy.',
            'commentable_id' => $book->id,
            'commentable_type' => QuoteBook::class,
        ]);
    }

    private function createReview($book)
    {
        QuoteReview::firstOrCreate([
            'user_id' => 1,
            'title' => 'Insightful',
            'slug' => Str::slug('Insightful'),
            'review' => 'The book offers a fresh perspective on classic ideas.',
            'reviewable_id' => $book->id,
            'reviewable_type' => QuoteBook::class,
        ]);
    }
}
