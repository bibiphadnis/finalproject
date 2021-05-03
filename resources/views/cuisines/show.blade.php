@extends('layouts.main')

@section('title')
    Cuisine: {{$cuisine->name}}
@endsection

@section('content')
<a href="{{route('cuisines.index')}}" class="d-block mb-3">Back to All Cuisines</a>
    <p>Total Recipes: {{$recipes->count()}}</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Recipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipes as $recipe)
                <tr>
                    <td>
                        <a href="{{route('recipes.details', [ 'id' => $recipe->id])}}">
                        {{$recipe->name}}
                        </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection