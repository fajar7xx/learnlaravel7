@extends('layouts.app', ['title' => 'Update Post'])


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Update post
                </div>
                <div class="card-body">
                    <form action="/posts/{{  $post->slug }}/edit" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        @include('posts.partials.form-control')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection