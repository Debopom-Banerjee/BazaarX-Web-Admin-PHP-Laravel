<div class="modal fade" id="registerToggle" aria-hidden="true" aria-labelledby="registerToggleLabel"
        tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered login-popup-main register-modal">
        <div class="modal-content border-0 shadow overflow-hidden rounded">
            <div class="modal-body p-0">
                <div class="login-popup">
                    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="row g-0">
                        <div class="d-md-flex col-md-6 col-lg-6 showcase">
                            <img src="{{ asset('frontend/assets/img/icons/user-login.jpg') }}" alt="">
                            <div class="overlay">
                                <div class="px-5 pt-5rem">
                                    <h2 class="register-text-h2">
                                        <i class="bi bi-quote"></i>
                                        <br>
                                       Raj Said,
                                    </h2>
                                    <h4 class="register-text-p">🤝 Partnering with BazaarX has been a game-changer! Our profits have soared, thanks to their exceptional strategies.  Their expertise attracted numerous new customers. Thrilled to continue this lucrative journey with them! </h4>
                                    <div style="text-align: left">
                                       - Founder/CEO Xyz
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="register px-5 pt-5 pb-3">
                                <h5 class="text-center">Join BazaarX Business! Start Getting Orders!</h5>
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                                <form method="POST" action="{{ url('register') }}" class="mt-3 mb-1">
                                    @csrf
                                    <input type="hidden" id="setPartnerRole" name="role">
                                    <div class="form-group">
                                        <label class="mb-2">Name<span class="text-danger">*</span></label>
                                        <div class="input-group bg-white border mb-2">
                                            <input required name="full_name" type="text" class="form-control br-0 border-0 px-2" placeholder="Enter Full Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2">Email<span class="text-danger">*</span></label>
                                        <div class="input-group bg-white border mb-2">
                                           <input required name="email" type="email" class="form-control br-0 border-0 px-2" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2">Phone<span class="text-danger">*</span></label>
                                        <div class="input-group bg-white border mb-2">
                                           <input required name="phone" type="number" class="form-control br-0 border-0 px-2" placeholder="Enter Phone" oninput="checkNumberLength(this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2">Password<span class="text-danger">*</span></label>
                                        <div class="input-group bg-white border mb-2">
                                           <input required name="password" type="password" class="form-control br-0 border-0 px-2" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2">Confirm Password<span class="text-danger">*</span></label>
                                        <div class="input-group bg-white border mb-2">
                                           <input required name="password_confirmation" type="password" class="form-control br-0 border-0 px-2" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="form-check d-flex justify-content-between mb-1">
                                        <div>
                                            <input type="checkbox" class="form-check-input" id="partnerRemember">
                                            <label class="form-check-label small text-muted border-end pe-1" for="partnerRemember">Remember me</label>
                                        </div>
                                       
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success rounded w-100">Register</button>
                                </form>

                                <div class="mt-2 text-center" >
                                    By clicking Sign Up, you agree to our <a target="_blank" href="{{url('/page/privacy')}}" class="text-decoration-none text-center text-muted">Terms</a>, <a target="_blank" href="{{url('/page/privacy')}}" class="text-decoration-none text-center text-muted">Privacy Policy</a>. You may receive SMS notifications from us and can opt out at any time.
                                    
                                </div>
                                {{-- <div class="text-center text-muted mt-1">
                                    Already registered?<a class="text-decoration-none showSignInBtn" style="color: #000;" href="javascript:void(0)"> Sign In Now</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkNumberLength(input) {
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); // Limit to 10 digits
        }
    }
    </script>