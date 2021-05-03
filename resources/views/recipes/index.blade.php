@extends('layouts.main')

@section('title', 'Recipes')

@section('content')
    @if (Auth::check()) 
        <div class="mb-3 text-end">
            <a href="{{ route('recipes.create') }}">New Recipe</a>
        </div>
    @endif
   
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipes as $recipe)
                <tr>
                    <td>
                        {{$recipe->id}}
                    </td>
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