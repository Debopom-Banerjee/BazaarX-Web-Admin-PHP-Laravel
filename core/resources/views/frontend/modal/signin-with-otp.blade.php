{{-- Enter Number Modal --}}

<div class="modal fade" id="signInOtp" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered login-popup-main signin-modal">
        <div class="modal-content border-0 shadow overflow-hidden rounded">
            <div class="modal-body p-0">
                <div class="login-popup">
                    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="row g-0">
                        <div class="d-none d-md-flex col-md-6 col-lg-6 showcase">
                            <img src="{{ asset('storage/backend/constant-management/sliders/image_41223.png') }}" style="object-fit: contain" alt="">
                            <div class="overlay">
                                <div class="px-5 mobile-d-none">
                                    <h2 class="register-text-h2" style="margin-top: 85px">
                                        <i class="bi bi-quote"></i>
                                        <br>
                                        Empowering Your Business Success
                                    </h2>
                                    <h4 class="register-text-p"> Discover a comprehensive solution for all your business requirements at Gofinx! From financial strategies to marketing brilliance, we've got you covered. Elevate your business with BazaarX today! 📈 </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 py-lg-5 phoneCol">
                            <div class="login p-5">
                                <div class="mb-1 pb-2">
                                    <h5 class="mb-2 fw-bold">Hey! what’s your number?</h5>
                                    <p class="text-muted mb-0">Please login with this number the next time you
                                        sign-in</p>
                                </div>
                                <div class="alert alert-danger d-none errorMsg p-2 fade show" role="alert">
                                </div>
                                <form action="{{ route('send-number-to-get-otp') }}" method="GET">
                                    <div class="input-group bg-white border rounded mb-3 p-2">
                                        <span class="input-group-text bg-white border-0"><i class="bi bi-phone pe-2"></i> +91 </span>
                                        <input required name="phone" type="number" minlength="10" class="form-control bg-white border-0 ps-0 phone" placeholder="Enter phone number">
                                    </div>
                                    <button type="button" class="btn btn-success btn-lg py-3 px-4 text-uppercase w-100 mt-2 getOtpBtn">Get OTP <i
                                            class="bi bi-arrow-right ms-2"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 py-lg-5 otpCol d-none">
                            <div class="login p-5">
                                <div class="mb-4 pb-2">
                                    <h5 class="mb-2 fw-bold">Enter OTP</h5>
                                    <p class="text-muted mb-0">Enter the 4 digit OTP we’ve sent by SMS 
                                    </p>
                                </div>
                                <div class="alert alert-danger d-none errorMsg p-2 fade show" role="alert">
                                </div>
                                <form action="{{ route('login-with-otp') }}" method="POST" id="loginOtpForm">
                                    @csrf
                                    <div class="d-flex gap-3 text-center">
                                        <div class="input-group bg-white border rounded mb-3 p-2">
                                            <input type="number" name="otp[]" class="form-control bg-white border-0 text-center otp-input" minlength="1" maxlength="1">
                                        </div>
                                        <div class="input-group bg-white border rounded mb-3 p-2">
                                            <input type="number" name="otp[]" class="form-control bg-white border-0 text-center otp-input" minlength="1" maxlength="1">
                                        </div>
                                        <div class="input-group bg-white border rounded mb-3 p-2">
                                            <input type="number" name="otp[]" class="form-control bg-white border-0 text-center otp-input" minlength="1" maxlength="1">
                                        </div>
                                        <div class="input-group bg-white border rounded mb-3 p-2">
                                            <input type="number" name="otp[]" class="form-control bg-white border-0 text-center otp-input" minlength="1" maxlength="1">
                                        </div>
                                    </div>
                                    <div class="form-check ps-0">
                                        <label class="small text-muted">
                                            <span id="resendOtp">Resend OTP in  </span>
                                            <span id="Timer"></span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg py-3 px-4 text-uppercase w-100 mt-2">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const otpInputs = document.querySelectorAll('.otp-input');
    
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1) {
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            } else if (e.target.value.length === 0) {
                if (index > 0) {
                    otpInputs[index - 1].focus();
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.value.length === 0) {
                if (index > 0) {
                    otpInputs[index - 1].focus();
                }
            }
        });
    });
</script>