<!-- START SECTION FAQ -->
<section>
    <div class="container">
        @if(Route::current()->getName() != "faq")
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="title_default_dark title_border text-center">
                    <h4 class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.faq.title')</h4>
                </div>
            </div>
        </div>
        @endif
        <div class="row small_space">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div id="accordion" class="faq_question">
                    @include('landing.section-faq.question',[
                        'number' => 1,
                        'question' => __('landing.faq.questions.question1.question'),
                        'answer' => __('landing.faq.questions.question1.answer')
                    ])

                    @include('landing.section-faq.question',[
                        'number' => 2,
                        'question' => __('landing.faq.questions.question2.question'),
                        'answer' => __('landing.faq.questions.question2.answer')
                    ])

                    @include('landing.section-faq.question',[
                        'number' => 3,
                        'question' => __('landing.faq.questions.question3.question'),
                        'answer' => __('landing.faq.questions.question3.answer')
                    ])
                    @include('landing.section-faq.question',[
                        'number' => 4,
                        'question' => __('landing.faq.questions.question4.question'),
                        'answer' => __('landing.faq.questions.question4.answer')
                    ])

                    @if(Route::current()->getName() == "faq")
                        @include('landing.section-faq.question',[
                            'number' => 5,
                            'question' => __('landing.faq.questions.question5.question'),
                            'answer' => __('landing.faq.questions.question5.answer')
                        ])

                        @include('landing.section-faq.question',[
                            'number' => 6,
                            'question' => __('landing.faq.questions.question6.question'),
                            'answer' => __('landing.faq.questions.question6.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 7,
                            'question' => __('landing.faq.questions.question7.question'),
                            'answer' => __('landing.faq.questions.question7.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 8,
                            'question' => __('landing.faq.questions.question8.question'),
                            'answer' => __('landing.faq.questions.question8.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 9,
                            'question' => __('landing.faq.questions.question9.question'),
                            'answer' => __('landing.faq.questions.question9.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 10,
                            'question' => __('landing.faq.questions.question10.question'),
                            'answer' => __('landing.faq.questions.question10.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 11,
                            'question' => __('landing.faq.questions.question11.question'),
                            'answer' => __('landing.faq.questions.question11.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 12,
                            'question' => __('landing.faq.questions.question12.question'),
                            'answer' => __('landing.faq.questions.question12.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 13,
                            'question' => __('landing.faq.questions.question13.question'),
                            'answer' => __('landing.faq.questions.question13.answer')
                        ])
                        @include('landing.section-faq.question',[
                            'number' => 14,
                            'question' => __('landing.faq.questions.question14.question'),
                            'answer' => __('landing.faq.questions.question14.answer')
                        ])
                    @else
                        <div style="text-align: center; margin-top: 20px">
                            <a href="{{ route('faq') }}" class="btn btn-default animation animated fadeInUp m-t-20" data-animation="fadeInUp" data-animation-delay="1.4s" style="animation-delay: 1.4s; opacity: 1;">@lang('landing.faq.more') <i class="ion-ios-arrow-thin-right"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION FAQ -->
