@extends('layout.app')

@section('title', $news->title)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4 p-md-5">

                    {{-- Title & Date --}}
                    <h1 class="fw-bold mb-3">{{ $news->title }}</h1>
                    <p class="text-muted mb-4 small">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ $news->created_at->format('d M Y') }}
                    </p>

                    {{-- News Image --}}
                    @if($news->image)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $news->image) }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 450px; object-fit: cover;"
                                 alt="{{ $news->title }}">
                        </div>
                    @endif

                    {{-- Description --}}
                    <div class="news-content fs-5 lh-lg">
                        {!! nl2br(e($news->description)) !!}
                    </div>

                    {{-- Back & Share --}}
                    <div class="mt-5 d-flex flex-wrap justify-content-between gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to News
                        </a>

                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                               target="_blank" class="btn btn-primary">
                               <i class="bi bi-facebook"></i> Share
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}"
                               target="_blank" class="btn btn-info text-white">
                               <i class="bi bi-twitter"></i> Tweet
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Custom style for paragraph spacing --}}
<style>
    .news-content p {
        margin-bottom: 1rem;
    }
</style>
@endsection
