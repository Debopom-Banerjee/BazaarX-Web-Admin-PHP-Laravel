<div class="modal fade" id="signInToggle" aria-hidden="true" aria-labelledby="signInToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered login-popup-main signin-modal">
            <div class="modal-content border-0 shadow overflow-hidden rounded">
                <div class="modal-body p-0">
                    <div class="login-popup">
                        <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="row g-0">
                            <div class="d-md-flex col-md-6 col-lg-6 showcase">
                                <img src="{{ asset('storage/backend/constant-management/sliders/image_41223.png') }}" style="object-fit: contain" alt="">
                                <div class="overlay">
                                    <div class="px-5 pt-5rem mobile-d-none">
                                        <h2 class="register-text-h2" style="margin-top: 85px">
                                            <i class="bi bi-quote"></i>
                                            <br>
                                            Empowering Your Business Success
                                        </h2>
                                        <h4 class="register-text-p"> Discover a comprehensive solution for all your business requirements at Gofinx! From financial strategies to marketing brilliance, we've got you covered. Elevate your business with BazaarX today! 📈 </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 py-lg-5">
                                <div class="login p-5 pt-0">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="#"
                                        class="img-fluid d-md-block w-25">
                                    </div>
                                    <h5 class="text-center">Welcome Back!</h5>
                                    <form method="POST" action="{{ route('login') }}" class="mt-3 mb-1">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-2">Email Address</label>
                                            <div class="input-group bg-white border mb-2">
                                                <input required name="email" type="email" class="form-control  br-0 border-0 px-2" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-2">Password</label>
                                            <div class="input-group bg-white border mb-2">
                                               <input required name="password" type="password" class="form-control  br-0 border-0 px-2" placeholder="Enter Password">
                                            </div>
                                        </div>
                                        <div class="form-check d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                <label class="form-check-label small text-muted border-end pe-1" for="exampleCheck2">Remember me</label>
                                            </div>
                                            <a target="_blank" href="{{url('password/forget')}}" class="text-decoration-none text-muted small">Forgot Password?</a>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-success rounded w-100 mb-2">Sign In</button>
                                    </form>
                                    <div class="text-center text-muted">
                                        Don’t have an account? <a class="text-decoration-none userSignUpBtn" style="color: #000;" href="javascript:void(0)">Customer</a>
                                        Or <a class="text-decoration-none partnerSignUpBtn" value="Partner" style="color: #000;" href="javascript:void(0)">Partner</a>
                                    </div>
                                    <div class="text-center text-muted">
                                        <hr class="m-2">
                                        <a class="text-success text-decoration-none userSignInOtpBtn fw-600" style="color: #000;" href="javascript:void(0)">Sign In With OTP</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>