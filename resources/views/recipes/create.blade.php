@extends('layouts.main')

@section('title', 'New Recipe')

@section('content')
    <form action="/recipes" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('title')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cuisine" class="form-label">Cuisine</label>
            <select name="cuisine" id="cuisine" class="form-select">
                <option value="">-- Select Cuisine --</option>
                @foreach($cuisines as $cuisine)
                    <option value="{{$cuisine->id}}" {{ (string) $cuisine->id === old('cuisine') ? "selected" : "" }}>
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
            <textarea rows="10" cols="30" name="ingredients" id="ingredients" value="{{ old('ingredients') }}"></textarea>
            @error('ingredients')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="recipe" class="form-label">Recipe</label>
            <textarea rows="10" cols="30" name="recipe" id="recipe" value="{{ old('recipe') }}"></textarea>
            @error('recipe')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection