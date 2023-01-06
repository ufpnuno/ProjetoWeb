@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Creating a review for {{$user->name}}</h1>
                <form method="post" action="{{ route('reviews.store') }}">
                    @csrf
                    <div class="form-group">
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="{{ $user->id }}">Creating a review for {{ $user->name }}</option>
                        </select>
                        <span>Your rating</span>
                        <p class="stars">
                            <label for="rated-1"></label>
                            <input type="radio" id="rated-1" name="rating" value="1">
                            <label for="rated-2"></label>
                            <input type="radio" id="rated-2" name="rating" value="2">
                            <label for="rated-3"></label>
                            <input type="radio" id="rated-3" name="rating" value="3">
                            <label for="rated-4"></label>
                            <input type="radio" id="rated-4" name="rating" value="4">
                            <label for="rated-5"></label>
                            <input type="radio" id="rated-5" name="rating" value="5">
                        </p>
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.errors')
@endsection