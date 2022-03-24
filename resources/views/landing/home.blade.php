@extends('landing.landing')

@section('content')

    @include('landing.section-start-banner.start-banner')

    @include('landing.section-about.about')

    @include('landing.section-services.services')

    @include('landing.section-token.token')

    @include('landing.section-timeline.timeline')

    @include('landing.section-team.team')

    @include('landing.section-faq.faq')

    @include('landing.section-news.news')

{{--    @include('landing.section-blog.blog')--}}

    @include('landing.section-contact.contact')

@endsection
