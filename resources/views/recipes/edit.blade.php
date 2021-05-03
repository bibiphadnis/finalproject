@extends('layouts.main')

@section('title')
    Edit Recipe: {{ $recipe->name }}
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('recipes.update', [ 'id' => $recipe->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $recipe->name) }}">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cuisine" class="form-label">Cuisine</label>
            <select name="cuisine" id="cuisine" class="form-select">
                <option value="">-- Select Cuisine --</option>
                @foreach($cuisines as $cuisine)
                    <option 
                        value="{{$cuisine->id}}" 
                        {{ (int) $cuisine->id === old('cuisine', $recipe->cuisine_id) ? "selected" : "" }}>
                            {{$cuisine->name}}
                    </option>
                @endforeach
            </select>
            @error('cuisine')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients</label>
            <input type="text" name="ingredients" id="ingredients" value="{{ old('ingredients', $recipe->ingredients) }}">
            @error('ingredients')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="recipe" class="form-label">Recipe</label>
            <input type="text" name="recipe" id="recipe" value="{{ old('recipe', $recipe->recipe) }}">
            @error('recipe')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection