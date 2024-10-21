<?php

namespace Works\Biolinkworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Biolinkworks\Models\BioUser;
use Works\Biolinkworks\Models\BioCategory;
use Works\Biolinkworks\Models\BioSubcategory;
use Works\Biolinkworks\Models\BioTag;

class BioLinkController extends Controller
{
    // Lista todos los usuarios
    public function listUsers()
    {
        return BioUser::all();
    }

    // Lista todos los datos de un usuario por su username
    public function getUser($username)
    {
        $user = BioUser::where('username', $username)
            ->with(['categories', 'subcategories', 'tags', 'bioLinks'])
            ->firstOrFail();

        $user->increment('views');

        return response()->json($this->transformUserResponse($user));
    }

    // Lista los 50 usuarios más vistos
    public function topUsers()
    {
        $users = BioUser::orderBy('views', 'desc')->take(50)->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista todas las categorías
    public function listCategories()
    {
        return BioCategory::all();
    }

    // Lista todas las subcategorías
    public function listSubcategories()
    {
        return BioSubcategory::all();
    }

    // Lista todas las etiquetas (tags)
    public function listTags()
    {
        return BioTag::all();
    }

    // Lista los 50 usuarios más vistos con una determinada etiqueta
    public function topTagUsers($tagSlug)
    {
        $tag = BioTag::where('slug', $tagSlug)->firstOrFail();
        $users = $tag->bioUsers()->orderBy('views', 'desc')->take(50)->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista los 50 usuarios más vistos de una categoría específica
    public function topCategoryUsers($categorySlug)
    {
        $category = BioCategory::where('slug', $categorySlug)->firstOrFail();
        $users = $category->bioUsers()->orderBy('views', 'desc')->take(50)->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista los 50 usuarios más vistos de una subcategoría específica
    public function topSubcategoryUsers($subcategorySlug)
    {
        $subcategory = BioSubcategory::where('slug', $subcategorySlug)->firstOrFail();
        $users = $subcategory->bioUsers()->orderBy('views', 'desc')->take(50)->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista todos los usuarios de una categoría específica
    public function getCategoryUsers($categorySlug)
    {
        $category = BioCategory::where('slug', $categorySlug)->firstOrFail();
        $users = $category->bioUsers()->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista todos los usuarios de una subcategoría específica
    public function getSubcategoryUsers($subcategorySlug)
    {
        $subcategory = BioSubcategory::where('slug', $subcategorySlug)->firstOrFail();
        $users = $subcategory->bioUsers()->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Lista todos los usuarios con una etiqueta específica
    public function getTagUsers($tagSlug)
    {
        $tag = BioTag::where('slug', $tagSlug)->firstOrFail();
        $users = $tag->bioUsers()->with(['categories', 'subcategories', 'tags', 'bioLinks'])->get();

        return response()->json($users->map(function($user) {
            return $this->transformUserResponse($user);
        }));
    }

    // Método reutilizable para transformar la respuesta de un usuario
    private function transformUserResponse($user)
    {
        return [
            'username' => $user->username,
            'name' => $user->name,
            'surname' => $user->surname,
            'biography' => $user->biography,
            'photo' => $user->photo,
            'alt' => $user->alt,
            'background' => $user->background,
            'calltoaction' => $user->calltoaction,
            'views' => $user->views,
            'categories' => $user->categories->map(function($category) {
                return [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description
                ];
            }),
            'subcategories' => $user->subcategories->map(function($subcategory) {
                return [
                    'name' => $subcategory->name,
                    'slug' => $subcategory->slug,
                    'description' => $subcategory->description
                ];
            }),
            'tags' => $user->tags->map(function($tag) {
                return [
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                    'description' => $tag->description
                ];
            })
        ];
    }
}
