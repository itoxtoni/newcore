@extends('layouts.public')

@push('meta')
    <meta name="description" content="{{ $page->meta['meta_description'] }}">
    <meta name="description" content="{{ $page->meta['opengraph_title'] }}">

    <meta property="og:title" content="{{ $page->meta['opengraph_title'] }}" />
    <meta property="og:description" content="{{ $page->meta['opengraph_description'] }}" />
    <meta property="og:image" content="{{ $page->meta['opengraph_image'] }}" />

    <meta name="twitter:card" content="{{ $page->meta['twitter_title'] }}" />
    <meta name="twitter:description" content="{{ $page->meta['twitter_description'] }}" />
    <meta name="twitter:image" content="{{ $page->meta['twitter_image'] }}" />

@endpush

@section('content')

  <!-- Widget-about -->
  <div class="tf-widget-about-us main-content">
    <div class="themeflat-container">
        <div class="tf-about-us container">

            <div class="row">
                <div class="col-md-8 mx-auto">

                    <div class="about-box">
                        <div class="title-box title-small-v2">
                            <h2 class="title-section wow fadeInUp animated text-center">
                                {{ $page->title }}
                            </h2>
                        </div>

                        <div class="post wow fadeInUp animated">
                            {!! $page->body !!}
                        </div>
                    </div>
                </div>
              </div>

        </div>
    </div>
</div><!-- Widget-about  -->

@endsection