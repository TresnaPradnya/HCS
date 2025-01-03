@extends('layouts.index')

@section('title')
    <strong>
        All Posts
    </strong>
@endsection


@section('content')
<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($posts as $post)
        <div class="card mb-4">
            <div class="card-body">
                <!-- User Info and Time -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0 text-dark">{{ $post->user->name }}</h5>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>
                <hr>

                <!-- Charts Section -->
                @if ($post->pie_chart_image || $post->line_chart_image)
                    <div class="d-flex justify-content-center gap-3 mb-3">
                        @if ($post->pie_chart_image)
                            <img src="{{ $post->pie_chart_image }}" alt="Pie Chart" class="img-fluid" style="max-width: 300px; height: auto;">
                        @endif
                        @if ($post->line_chart_image)
                            <img src="{{ $post->line_chart_image }}" alt="Line Chart" class="img-fluid" style="max-width: 350px; height: auto;">
                        @endif
                    </div>
                @endif

                <!-- Footprint Data Section -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Transportation</h5>
                                <p class="text-primary font-weight-bold">{{ $post->transportation_footprint }} kg CO₂</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Energy</h5>
                                <p class="text-success font-weight-bold">{{ $post->energy_footprint }} kg CO₂</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Diet</h5>
                                <p class="text-danger font-weight-bold">{{ $post->diet_footprint }} kg CO₂</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total</h5>
                                <p class="text-info font-weight-bold">{{ $post->total_footprint }} kg CO₂</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Content -->
                <p class="mb-3 text-dark font-weight-bold">"{{ $post->content }}"</p>
                <p class="text-muted"><em>Visibility: {{ ucfirst($post->visibility) }}</em></p>
                <hr>

                <!-- Interaction Buttons -->
                <div class="d-flex align-items-center mb-3">
                    <!-- Like Button -->
                    <form action="{{ $post->likes->contains('user_id', auth()->id()) ? route('posts.unlike', $post) : route('posts.interact', $post) }}" method="POST" class="mr-3">
                        @csrf
                        <input type="hidden" name="type" value="like">
                        <button type="submit" class="btn btn-sm {{ $post->likes->contains('user_id', auth()->id()) ? 'btn-danger' : 'btn-primary' }}">
                            <i class="fas {{ $post->likes->contains('user_id', auth()->id()) ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                        </button>
                    </form>

                    <!-- Comment Form -->
                    <form action="{{ route('posts.interact', $post) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="type" value="comment">
                        <input type="text" name="content" class="form-control d-inline-block" placeholder="Add a comment..." required style="width: 200px;">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-comment"></i>
                        </button>
                    </form>
                </div>

                <!-- Display Likes -->
                <p class="mb-1">{{ $post->likes->count() }} Likes</p>

                <!-- Display Comments -->
                <ul class="list-unstyled">
                    @foreach($post->comments as $comment)
                        <li><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</li>
                    @endforeach
                </ul>

                <!-- Delete Button -->
                @if($post->user_id === auth()->id())
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted">No posts yet!</p>
    @endforelse
</div>
@endsection
