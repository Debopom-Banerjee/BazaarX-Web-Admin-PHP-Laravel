
<div class="row">
    <div class="col-lg-12">
        <div class="card public-profile border-0 rounded shadow" style="z-index: 1;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 text-md-start text-center">
                        <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" class="avatar avatar-large rounded-circle shadow d-block mx-auto" alt="">
                    </div><!--end col-->

                    <div class="col-lg-10 col-md-9">
                        <div class="row align-items-end">
                            <div class="col-md-7 text-md-start text-center mt-4 mt-sm-0">
                                <h3 class="title mb-0">{{ auth()->user()->name }}</h3>
                                <small class="text-muted h6 me-2">{{ AuthRole() }}</small>
                                <ul class="list-inline mb-0 mt-3">
                                    <li class="list-inline-item me-2"><a href="javascript:void(0)" class="text-muted" title="Instagram"><i data-feather="instagram" class="fea icon-sm me-2"></i>{{ auth()->user()->name }}</a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted" title="Linkedin"><i data-feather="linkedin" class="fea icon-sm me-2"></i>{{ auth()->user()->name }}</a></li>
                                </ul>
                            </div><!--end col-->
                            <div class="col-md-5 text-md-end text-center">
                                <div class="d-sm-flex d-lg-block justify-content-sm-between">
                                    <ul class="list-unstyled social-icon social mb-0 mt-4">
                                        <li class="list-inline-item"><a href="{{ route('customer.notification') }}" class="rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notifications"><i class="uil uil-bell align-middle"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('customer.setting') }}" class="rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings"><i class="uil uil-cog align-middle"></i></a></li>
                                    </ul><!--end icon-->

                                    <span class="mt-4">
                                        <button class="toggleBtn">
                                            <i class="uil uil-bars"></i>
                                        </button>
                                    </span>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->