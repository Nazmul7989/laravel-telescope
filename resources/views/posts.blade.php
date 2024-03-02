@extends('layout.app')

@section('content')
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-3">
                <div class="card shadow mb-3" style="min-height: 200px;">
                    <div class="card-body">
                        <h5>{{ $post->title }}</h5>
                        <div>{{ \Illuminate\Support\Str::limit($post->description,80) }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 mt-3 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>

@endsection
