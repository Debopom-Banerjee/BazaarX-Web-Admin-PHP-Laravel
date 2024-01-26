<section id="contact" class="bg-primary spacer-double-lg">
    <div class="container position-relative z-index-2">
        <div class="row justify-content-lg-between align-items-center">
            <div class="col-lg-5  text-white mb-7 mb-lg-0">
                <div class="mb-6">
                    <h2 class="h1 text-white ">We're here to help, get in touch with us</h2>
                    <p class="text-white">For more info about our products and pricing please feel free to get in touch true our <a class="text-info font-weight-medium" href="#">Help Center.</a></p>
                </div>
                <div class="row ">
                    <div class="col-sm-6 mb-5">
                        <span class="rounded-icon-size-1 bg-soft-white rounded-circle mb-3 d-block">
                <span class="fas fa-envelope icon-rounded-inner"></span>
                        </span>
                        <h4 class="h5 mb-0 text-white">General enquiries</h4>
                        <a class="text-white-70 font-size-15" href="#">hello@foxecoaching.com</a>
                    </div>
                    <div class="col-sm-6 mb-5">
                        <span class="rounded-icon-size-1 bg-soft-white rounded-circle mb-3 d-block">
                <span class="fas fa-phone icon-rounded-inner"></span>
                        </span>
                        <h4 class="h5 mb-0 text-white">Phone Number</h4>
                        <a class="text-white-70 font-size-15" href="#">(513) 352-3209 </a>
                    </div>
                    <div class="col-sm-6">
                        <span class="rounded-icon-size-1 bg-soft-white rounded-circle mb-3 d-block">
                <span class="fas fa-map-marker-alt icon-rounded-inner"></span>
                        </span>
                        <h4 class="h5 mb-0 text-white">Address</h4>
                        <a class="text-white-70 font-size-15" href="#">Central Park New York, USA </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <form method="POST" action="{{ route('contact.store') }}" class="card border-0 shadow-soft p-6">
                    @csrf
                    <input type="hidden" name="status" value="0">
                    <div class="mb-4">
                        <h3 class="h5">Drop us a message</h3>
                    </div>
                    <div class="row mx-gutters-2">
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="Full name" aria-label="Full name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="Your email" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <select class="custom-select" name="category_id" id="category_id">
                                    @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 7) as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="contact_number" placeholder="Phone number" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="sr-only">How can we help you?</label>
                        <div class=" input-group">
                            <textarea class="form-control" rows="4" name="description" placeholder="Hi there, I would like to ..." aria-label="Hi there, I would like to ..." required></textarea>
                        </div>
                    </div>
                    {{-- <div class=" mb-3">
                        <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                            <input type="checkbox" class="custom-control-input" id="newsletterCheckbox" name="newsletterCheckbox">
                            <label class="custom-control-label" for="newsletterCheckbox">
                            <small>Receive Newsletters from foxecoach.</small>
                            </label>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-secondary btn-radius-bottom-right"><span class="mn-top">Send message</span></button>
                </form>
            </div>
        </div>
    </div>
</section>