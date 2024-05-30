@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Blog Posts</h1>
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
