@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        @if ($post->thumbnail)
            <img src="{{ $post->postImage }}" class="rounded w-100 img-fluid img-thumbnail" style="height: 500px; object-fit: cover; object-position: center;">
        @endif
        <h1>{{ $post->title }}</h1>
        <div class="text-secondary mb-2">
             <a href="/categories/{{ $post->category->slug }}">
                {{ $post->category->name }} 
            </a> 
            &middot; {{ $post->created_at->format('d F Y') }}
            &middot;
            @foreach ($post->tags as $tag)
                <a href="/tags/{{ $tag->slug }}" class="badge badge-info">{{ $tag->name }}</a>
            @endforeach
            <div class="media my-3">
                <img src="{{ $post->author->gravatar() }}" width="60" class="rounded-circle mr-3">
                <div class="media-body">
                    <div>
                        {{ $post->author->name }}
                    </div>
                        {{'@'. $post->author->username }}
                </div>
            </div>
        </div>

        <div class="text-justify mb-4">
            {!! nl2br($post->body) !!}
        </div> 

        <!-- Button trigger modal -->
        <div class="d-flex">
            @can('delete', $post)
                <div class="mr-1">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId">
                    Delete
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Yakin ingin menghapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form action="/posts/{{ $post->slug }}/delete" method="POST">
                                @csrf
                                @method('delete')
                                {{-- <div class="modal-body">
                                </div> --}}
                                <div class="modal-footer">
                                    <button class="btn btn-danger btn-sm">Ya, Hapus</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('update', $post)
            <div>
                <a href="{{ route('posts.update', $post->slug) }}" class="btn btn-info btn-sm">Edit</a>
            </div>
            @endcan
        </div>

    </div>


@endsection
