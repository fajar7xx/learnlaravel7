@extends('layouts.app')

@section('title', 'Category')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('components.alert')
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <h4>All Posts</h4>
            <hr>
        </div>
        <div>
            <a href="/posts/create" class="btn btn-primary">New Post</a>
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>
                    <div class="card-body">
                        {{-- <h4 class="card-title">Title</h4> --}}
                        <div class="card-text">
                            {{ Str::limit($post->body, 100, '.') }}
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="card-link">Read more</a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        Published on {{ $post->created_at->diffForHumans() }}
                        <a href="posts/{{ $post->slug }}/edit" class="btn btn-success btn-sm">Edit</a>
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