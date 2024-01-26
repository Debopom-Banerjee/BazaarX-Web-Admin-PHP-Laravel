@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Contact'.' | '.getSetting('app_name');		
		$meta_description = '-'?? getSetting('seo_meta_description');
		$meta_keywords = '-'.'' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
	@endphp
@endsection

@section('content')
        <!-- Start Contact -->
        <section class="section pt-5 mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="card map border-0">
                            <div class="card-body p-0">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->

            <div class="container mt-100 mt-60">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0 order-2 order-md-1">
                        <div class="card custom-form rounded border-0 shadow p-4">
                            <form method="post" action="{{ route('contact.store') }}">
                                @csrf
                                <input required type="hidden" value="email" name="type">
                                <p id="error-msg" class="mb-0"></p>
                                <div id="simple-msg"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input required name="name" id="name" type="text" class="form-control ps-5" placeholder="Name :">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input required name="type_value" type="text" class="form-control ps-5" placeholder="Email :">
                                            </div>
                                        </div> 
                                    </div><!--end col-->

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Subject</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="book" class="fea icon-sm icons"></i>
                                                <input required name="subject" id="subject" class="form-control ps-5" placeholder="subject :">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Comments <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="message-circle" class="fea icon-sm icons clearfix"></i>
                                                <textarea required name="description" id="comments" rows="4" class="form-control ps-5" placeholder="Message :"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" id="submit" class="btn btn-primary">Send Message</button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div><!--end custom-form-->
                    </div><!--end col-->

                    <div class="col-lg-7 col-md-6 order-1 order-md-2">
                        <div class="title-heading ms-lg-4">
                            <h4 class="mb-4">Contact Details</h4>
                            <p class="text-muted">Start working with <span class="text-primary fw-bold">{{ getSetting('app_name') }}</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="mail" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Email</h6>
                                    <a href="mailto:{{ getSetting('frontend_footer_email') }}" class="text-primary">{{ getSetting('frontend_footer_email') }}</a>
                                </div>
                            </div>
                            
                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="phone" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Phone</h6>
                                    <a href="tel:+{{getSetting('frontend_footer_phone')}}" class="text-primary">{{getSetting('frontend_footer_phone')}}</a>
                                </div>
                            </div>
                            
                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="map-pin" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Address</h6>
                                    <p>{{getSetting('frontend_footer_address')}} </p>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section>
        <!--end section-->
        <!-- End contact -->
@endsection