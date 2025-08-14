@extends('layout.app')
@section('title' ,'loin')


@section('content')

<main class="page-content mb-5">
  <section class="news-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row mb-4 text-center">
                    <h2 class="fw-bold display-5 text-dark full-underline">Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($news as $item)
                <div class="col-sm-4 wow fadeInDown animated" data-wow-delay="0.2s">
                    <div class="blog-item">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" width="350" height="262" alt="{{ $item->title }}">
                        </a>
                        <h3>{{ Str::limit($item->title, 50) }}</h3>
                        <p>{{ Str::limit($item->description, 120) }}</p>
                        <a href="{{ route('news.show', $item->id) }}">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

</main>

@endsection