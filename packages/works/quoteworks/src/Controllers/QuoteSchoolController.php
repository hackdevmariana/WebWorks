<?php

namespace Works\Quoteworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Quoteworks\Models\QuoteAuthor;

class QuoteSchoolController extends Controller
{
    public function index()
    {
        $schools = QuoteAuthor::distinct()->pluck('school');

        $cleanedSchools = [];

        foreach ($schools as $school) {
            $schoolArray = json_decode($school, true);

            if (!is_array($schoolArray)) {
                $schoolArray = [$school];
            }

            $filtered = array_filter($schoolArray, function ($value) {
                return !is_null($value) && $value !== '';
            });

            $cleanedSchools = array_merge($cleanedSchools, $filtered);
        }

        return response()->json(array_values($cleanedSchools));
    }

    public function show($school)
    {
        $authors = QuoteAuthor::where('school', 'LIKE', '%' . $school . '%')->get();
        return response()->json($authors);
    }

    public function authors($school)
    {
        $authors = QuoteAuthor::where('school', 'LIKE', '%' . $school . '%')
            ->select('name', 'surname')
            ->get();
        return response()->json($authors);
    }

    public function books($school)
    {
        $books = QuoteAuthor::where('school', 'LIKE', '%' . $school . '%')
            ->pluck('published_books');
        return response()->json($books);
    }
}
