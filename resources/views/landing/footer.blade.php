<!-- START FOOTER SECTION -->
<footer>
    <div class="top_footer blue_light_bg" data-z-index="1" data-parallax="scroll" data-image-src="assets/images/footer_bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="newsletter_form">
                        <h4 class="footer_title border_title animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.footer.newsletter')</h4>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="0.4s">@lang('landing.footer.newsletter-description')</p>
                        <form class="subscribe_form animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                            <input class="input-rounded" type="text" required placeholder="Email"/>
                            <button type="submit" title="Subscribirme" class="btn-info" name="submit" value="Submit"> @lang('landing.footer.button-newsletter')</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-8 res_md_mt_30 res_sm_mt_20">
                    <h4 class="footer_title border_title animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.footer.quick-links')</h4>
                    <ul class="footer_link half_link list_none res_sm_mb_30">
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.2s"><a href="{{ url('/') }}">Wadaboo</a></li>
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.3s"><a href="{{ route('about') }}">@lang('landing.footer.about')</a></li>
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.3s"><a href="{{ route('service') }}">@lang('landing.header.service')</a></li>
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.3s"><a href="{{ route('price') }}">@lang('landing.header.price')</a></li>
{{--                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.4s"><a href="#">Blog</a></li>--}}
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.5s"><a href="{{ route('faq') }}">@lang('landing.header.faq')</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-4 res_md_mt_30 res_sm_mt_20">
                    <h4 class="footer_title border_title animation" data-animation="fadeInUp" data-animation-delay="0.2s">Social</h4>
                    <ul class="footer_social list_none">
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.2s"><a href="https://www.facebook.com/Wadaboo-100932027988744" target="_blank"><i class="ion-social-facebook"></i> Facebook</a></li>
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.3s"><a href="https://www.linkedin.com/company/wadaboo/" target="_blank"><i class="ion-social-linkedin"></i> Linkedin</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="bottom_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">Copyright Wadaboo; {{ date("Y") }} @lang('landing.footer.copyright')</p>
                </div>
                <div class="col-md-6">
                    <ul class="list_none footer_menu">
                        <li><a href="#">@lang('landing.footer.privacy-policies')</a></li>
                        <li><a href="/download/Terminos.pdf">@lang('landing.footer.terms-and-conditions')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER SECTION -->
