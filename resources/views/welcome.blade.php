@extends('layouts.frontend.app')

@section('title', 'Login')


@section('content')
    {{-- Slider --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($categories as $category)
                <div class="carousel-item active">
                    <img src="{{ asset('categoryImages/' . $category->image) }}" class="img-thumbnail"
                        alt="{{ $category->name }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-success"><b>{{ $category->name }}</b></h2>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Blog Grid -->
    <div class="container">
        <div class="row g-4">
            @foreach ($posts as $post)
                <div class="col-md-4">

                    <div class="card h-100 shadow-sm">
                        <div class=" overflow-hidden" style="max-height: 200px;">
                            <img class="img-thumbnail" src="{{ asset('postImages/'.$post->image) }}" alt="blog">
                        </div>
                        <a href="#" class="avatar mt- position-relative rounded-circle border border-white shadow"
                            style="margin: 0 auto; margin-top: -40px; width: 70px; height: 70px; overflow: hidden; z-index: 10; border-width: 7px; box-shadow: 0 0 10px rgba(0,0,0,.2);">
                            <img src="https://png.pngtree.com/png-clipart/20240709/original/pngtree-casual-man-flat-design-avatar-profile-picture-vector-png-image_15526568.png"
                                class="w-100" alt="Profile Image">
                        </a>

                        <div class="card-body ">
                            <h4 class="card-title">
                                <a href="">
                                    <b> {{ $post->title }} </b>
                                </a>
                            </h4>
                        </div>

                        <div class="card-footer d-flex justify-content-between text-muted">

                            <div class="d-flex align-items-center">

                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart-fill " viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                    </svg>
                                    57
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chat-fill " viewBox="0 0 16 16">
                                        <path
                                            d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15" />
                                    </svg>
                                    138
                                </span>
                            </div>

                            <div class="d-flex align-items-center">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                    281
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
            {{-- Load More Button --}}
            <section class="text-center bg-light py-5">
                <a href="#" class="btn text-black px-4 py-3"
                    style="background: #C3D8F5; box-shadow: 0 0 2px rgba(0,0,0,.4); transition: all 0.3s;">
                    <strong>LOAD MORE</strong>
                </a>
        </div>
        </section>
    </div>
    <style>
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 5px 10px 20px rgba(0, 0, 0, .3);
        }
    </style>




@endsection
