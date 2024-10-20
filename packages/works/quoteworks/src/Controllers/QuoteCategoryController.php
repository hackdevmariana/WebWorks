<?php

namespace Works\Quoteworks\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Quoteworks\Models\QuoteCategory;
use Works\Quoteworks\Models\QuoteBook;

class QuoteCategoryController extends Controller
{
    // index: Devolverá el resultado de SELECT name, slug, description, related_fields FROM quote_categories;
    public function index()
    {
        // Selecciona los campos name, slug, description, related_fields de la tabla quote_categories
        $categories = QuoteCategory::select('name', 'slug', 'description', 'related_fields')->get();

        return response()->json($categories);
    }

    // show: 
    // 1. SELECT name FROM quote_categories WHERE slug LIKE '%slug%';
    // 2. SELECT * FROM quote_books WHERE category LIKE "%name%";
    public function show($slug)
    {
        // Obtener el nombre de la categoría por el slug
        $category = QuoteCategory::where('slug', 'LIKE', '%' . $slug . '%')->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Usar el nombre de la categoría para obtener los libros asociados
        $books = QuoteBook::where('category', 'LIKE', '%' . $category->name . '%')->get();

        return response()->json($books);
    }

    // authors:
    // 1. SELECT name FROM quote_categories WHERE slug LIKE '%slug%';
    // 2. SELECT author FROM quote_books WHERE category LIKE "%name%";
    public function authors($slug)
    {
        // Obtener el nombre de la categoría por el slug
        $category = QuoteCategory::where('slug', 'LIKE', '%' . $slug . '%')->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Usar el nombre de la categoría para obtener los autores asociados
        $authors = QuoteBook::where('category', 'LIKE', '%' . $category->name . '%')
                            ->pluck('author') // Selecciona solo los autores
                            ->unique();       // Elimina duplicados

        return response()->json($authors);
    }

    // books:
    // 1. SELECT name FROM quote_categories WHERE slug LIKE '%slug%';
    // 2. SELECT title_in_spanish FROM quote_books WHERE category LIKE "%name%";
    public function books($slug)
    {
        // Obtener el nombre de la categoría por el slug
        $category = QuoteCategory::where('slug', 'LIKE', '%' . $slug . '%')->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Usar el nombre de la categoría para obtener los títulos en español de los libros asociados
        $books = QuoteBook::where('category', 'LIKE', '%' . $category->name . '%')
                          ->pluck('title_in_spanish') // Selecciona solo los títulos en español
                          ->unique();                 // Elimina duplicados

        return response()->json($books);
    }
}
