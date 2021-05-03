@extends('layouts.main')

@section('title', 'Cuisines')

@section('content')


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cuisine</th>
                <th>View Recipes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuisines as $cuisine)
                <tr>
                    <td>
                        {{$cuisine->name}}
                    </td>
                    <td>
                        <a href="{{route('cuisines.show', [ 'id' => $cuisine->id])}}">
                        Recipes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection