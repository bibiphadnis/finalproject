<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuisineController extends Controller
{
    public function index() 
    {
        $cuisines = DB::table('cuisines')
        ->get([
            'name',
            'id'
        ]);

        return view('cuisines.index', [
            'cuisines' => $cuisines
        ]);
    }

    public function show($id) {
        $cuisine = DB::table('cuisines')
            ->where('id', '=', $id)
            ->first();


        $recipes = DB::table('recipes')
            ->where('cuisine_id', '=', $id)
            ->get([
                'recipes.name AS name',
                'recipes.id AS id'
            ]);


        return view('cuisines.show', [
            'cuisine' => $cuisine,
            'recipes' => $recipes
        ]);

    }


}
