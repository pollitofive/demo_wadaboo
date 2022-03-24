<!-- START SECTION CONTACT -->
<section class="contact_section" data-parallax="scroll" data-image-src="assets/images/app_bg.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="title_default_dark title_border text-center">
                    <h4 class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.contact-us.title')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 offset-lg-2 col-md-12 pr-0 res_md_pr_15">
                <div class="lg_pt_20 res_sm_pt_0">
                    <ul class="list_none contact_info info_contact text-center">
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                            <i class="ion-ios-location"></i>
                            <div class="contact_detail"> <span>@lang('landing.contact-us.address')</span>
                                <p>Buenos Aires, Argentina</p>
                            </div>
                        </li>
                        <li class="animation" data-animation="fadeInUp" data-animation-delay="0.8s">
                            <i class="ion-ios-email"></i>
                            <div class="contact_detail"> <span>Email</span>
                                <p>{{ config('constants.email-atencion-cliente') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<div class="row justify-content-center">
            <div class="col-md-10">
                <div class="lg_pt_20">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-contact" class="field_form_s2">
                                <div class="row">
                                    <div class="form-group col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                                        <input type="text" required="required" placeholder="Nombre *" v-model="form.nombre" id="first-name" class="form-control" name="name">
                                    </div>
                                    <div class="form-group col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.6s">
                                        <input type="email" required="required" placeholder="Email *" v-model="form.email" id="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.8s">
                                        <input type="text" required="required" placeholder="Asunto *" v-model="form.asunto" id="subject" class="form-control" name="subject">
                                    </div>
                                    <div class="form-group col-md-6 animation" data-animation="fadeInUp" data-animation-delay="1s">
                                        <input type="text" placeholder="Teléfono" id="phone" v-model="form.telefono" class="form-control" name="phone">
                                    </div>
                                    <div class="form-group col-md-12 animation" data-animation="fadeInUp" data-animation-delay="1.2s">
                                        <textarea required="required" placeholder="Mensaje *" v-model="form.mensaje" id="description" class="form-control" name="message" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12 text-center animation" data-animation="fadeInUp" data-animation-delay="1.4s">
                                        <button type="submit" title="Enviar mensaje!" @click="enviarEmail" class="btn btn-default btn-block" id="sendEmail" name="submit" value="Submit">Enviar <i class="ion-ios-arrow-thin-right"></i></button>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="alert-msg" class="alert-msg text-center"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</section>
<!-- END SECTION CONTACT -->
