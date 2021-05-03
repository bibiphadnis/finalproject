@extends('layouts.main')

@section('title')
     {{$recipe->name}}
@endsection

@section('content')
<a href="{{route('recipes.index')}}" class="d-block mb-3">Back to Recipes</a>
<a href="{{ route('cuisines.show', [ 'id' => $recipe->cuisine_id]) }}">
    View more {{$recipe->cuisine}} recipes
</a>

<h1 class="mb-3 p-3 bg-info text-white">{{$recipe->name}}</h1>
    <p>{{$recipe->ingredients}}</p>
    <p>{{$recipe->recipe}}</p>
    <p>Created by {{$recipe->username}}</p>
    @can('edit-recipe', $recipe)
        <a href="{{ route('recipes.edit', [ 'id' => $recipe->id]) }}" class="d-block mb-3">Edit Your Recipe</a>
    @endcan
    @can('delete-recipe')
        
        <form method="post" action="{{ route('recipes.delete', [ 'id' => $recipe->id]) }}">
        @csrf
            <input type="submit" value="Delete Recipe" class="btn btn-primary btn-sm">
        </form>
    @endcan


 <h4 class="mb-2 p-2 bg-info text-white">Comments</h4>
 @forelse ($comments as $comment)
        <h6>
            {{ $comment->body }}
        </h6>
        <h6>
            Posted by {{ $comment->user->name }}
        </h6>
        <div class="border-bottom mt-2 pb-2 mb-2">
            <em>
                Posted on {{ $comment->created_at->format('n/j/Y') }} at
                {{ $comment->created_at->format('G:i A') }}
            </em>
        </div>
    @empty
        <p class="border-bottom pb-2">
            No comments yet!
        </p>
    @endforelse

    
    @if (Auth::check())
    <form
        class="mt-3"
        action="{{ route('comments.store') }}"
        method="POST"
    >
        @csrf
        <input type="hidden" name="recipe" value="{{ $recipe->id }}">
        <div class="form-group">
            <h4 class="bg-info text-white p-2">
                Comment
            </h4>
            <textarea
                name="comment"
                class="form-control"></textarea>
            @error('comment')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="text-right mt-3">
            <button class="btn btn-primary" type="submit">
                Post Comment
            </button>
        </div>
    </form>
    @else
    <h6>Login to post a comment</h6>
    @endif
    
@endsection