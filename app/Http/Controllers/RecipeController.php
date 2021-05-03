<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Recipe;
use App\Models\Comment;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = DB::table('recipes')
            ->join('cuisines', 'recipes.cuisine_id', '=', 'cuisines.id')
            ->join('users', 'recipes.user_id', '=', 'users.id')
            ->orderBy('name')
            ->get([
                'recipes.id AS id',
                'recipes.name AS name',
                'users.name AS username',
                'cuisines.name as cuisine'
            ]);

        return view('recipes.index', [
            'recipes' => $recipes,
        ]);
    }


    public function create()
    {
        $cuisines = DB::table('cuisines')->orderBy('name')->get();

        return view('recipes.create', [
            'cuisines' => $cuisines,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:recipes,name',
            'recipe' => 'required',
            'ingredients' => 'required',
            'cuisine' => 'required|exists:cuisines,id',
        ]);

        DB::table('recipes')->insert([
            'name' => $request->input('name'),
            'recipe' => $request->input('recipe'),
            'ingredients' => $request->input('ingredients'),
            'cuisine_id' => $request->input('cuisine'),
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('recipes.index')
            ->with('success', "Successfully created new recipe for {$request->input('name')}!");
    }

    public function edit($id)
    {
        $recipe = DB::table('recipes')->where('id', '=', $id)->first();
        $cuisines = DB::table('cuisines')->orderBy('name')->get();

        return view('recipes.edit', [
            'recipe' => $recipe,
            'cuisines' => $cuisines,
        ]);
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'recipe' => 'required',
            'ingredients' => 'required',
            'cuisine' => 'required|exists:cuisines,id',
        ]);

        DB::table('recipes')->where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'recipe' => $request->input('recipe'),
            'ingredients' => $request->input('ingredients'),
            'cuisine_id' => $request->input('cuisine'),
        ]);

        return redirect()
            ->route('recipes.details', [ 'id' => $id ])
            ->with('success', "Successfully updated recipe for {$request->input('name')}!");
    }

    public function details($id)
    {
        $recipe = DB::table('recipes')
            ->where('recipes.id', '=', $id)
            ->join('cuisines', 'recipes.cuisine_id', '=', 'cuisines.id')
            ->join('users', 'recipes.user_id', '=', 'users.id')
            ->select([
                'recipes.id AS id',
                'recipes.name AS name',
                'recipes.recipe AS recipe',
                'recipes.ingredients AS ingredients',
                'users.name AS username',
                'cuisines.name as cuisine',
                'recipes.cuisine_id AS cuisine_id',
                'recipes.user_id AS user_id'
            ])
            ->first();

        $comments = Comment::where('recipe_id', '=', $id)->orderBy('created_at', 'desc')->get();


        return view('recipes.details', [
            'recipe' => $recipe,
            'comments' => $comments
        ]);
    }

    public function delete($id) 
    {
        if (Gate::denies('delete-recipe')) {
            abort(403);
        }

        $recipe = Recipe::find($id);
        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('success', "Successfully deleted recipe!");

    }

}
