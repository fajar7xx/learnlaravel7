@extends('layouts.app')

@section('title', 'ini contoh posts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('components.alert')
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                @isset($category)
                    <h4>Category : {{ $category->name }}</h4>
                @endisset
                
                @isset($tag)
                    <h4>Tag : {{ $tag->name }}</h4>
                @endisset

                @if (!isset($tag) && !isset($category))
                    <h4>All Posts</h4>
                @endif
                <hr>
            </div>
            @auth
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">New Post</a>
                </div>
            @endauth
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <img src="{{ $post->postImage }}" class="card-img-top" style="height: 270px; object-fit: cover; object-position: center;">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                {{ $post->title }}
                                </a>
                            </h4>
                            <div class="p-0 mt-0 mb-1">
                                <span class="card-text"><small class="text-muted">Published on {{ $post->created_at->diffForHumans() }}</small></span>, 
                                <span class="card-text"><small class="text-muted">Publisher {{ $post->author->name }}</small></span>, 
                                <span class="card-text"><small>
                                    Category 
                                        <a href="{{ route('categories.show', $post->category->slug) }}">
                                            {{ $post->category->name }}
                                        </a>
                                </small> 
                                </span>
                            </div>
                            <div class="card-text">
                                {{ Str::limit($post->body, 100, '.') }}
                            </div>
                            <a href="/posts/{{ $post->slug }}" class="card-link">Read more</a>

                            <div class="d-flex justify-content-between align-items-center border-top mt-3">
                                <div class="media align-items-center mt-1">
                                    <img src="{{ $post->author->gravatar() }}" width="32" class="rounded-circle mr-3">
                                    <div class="media-body">
                                        <div>
                                            {{ $post->author->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection