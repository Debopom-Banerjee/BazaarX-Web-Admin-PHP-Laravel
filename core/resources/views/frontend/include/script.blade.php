<script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>

<script src="{{asset('frontend/assets/js/custom.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>


<script src="{{ asset('frontend/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="6929ed83b0274e0054fc6acd-|49" defer></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039" integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g==" data-cf-beacon='{"rayId":"7eab0f3e9db185a1","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>

<script src="{{ asset('backend/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
<script src="{{ asset('backend/js/owl-carousel.min.js') }}"></script>
<script src="{{ asset('backend/js/clipboard.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/main.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>
{{-- <script src="{{ asset('backend/js/apple-pay-sdk.js') }}"></script> --}}
{{-- <script src="https://applepay.cdn.apple.com/jsapi/v1/apple-pay-sdk.js"></script> --}}

<script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>


<script>
    $(document).ready(function(){
        $('.slider-section').removeClass('d-none');
    })
</script>
@if (session('success'))
<script>
    $.toast({
        heading: 'SUCCESS',
        text: "{{ session('success') }}",
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    });
</script>
@endif


@if(session('error'))
    <script>
        $.toast({
            heading: 'ERROR',
            text: "{{ session('error') }}",
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f2a654',
            position: 'top-right'
        });
    </script>
@endif
<script>
    $(document).on('click','.add-cart-btn',function(){
        var service_id = $(this).data('id');
        $('.ajax-container').html(' ');
        $('.loading').removeClass('d-none');  
        getServiceData(service_id)
    });
    function getServiceData(service_id){
        $.ajax({
            url: "{{ route('get-service-data') }}",
            data: {
                id: service_id
            },
            dataType: "html",
            method: "GET",
            success: function(data) {
                $('.loading').addClass('d-none');  
                $('.ajax-container').html(data);  
            }
        });
    }
    $(document).ready(function(){
        $('.slider-carousel').owlCarousel({
            loop: true,
            margin: 35,
            lazyLoad: true,
            nav: false,
            navigation : false,
            navText: [
                "<i class='bi bi-chevron-compact-left'></i>",
                "<i class='bi bi-chevron-compact-right'></i>"
            ],
            dots: false,
            autoplayTimeout: 4000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        });
    });
    $(document).ready(function(){
        $('.collection-carousel').owlCarousel({
            loop: true,
            margin: 35,
            lazyLoad: true,
            nav: false,
            navigation : false,
            navText: [
                "<i class='bi bi-chevron-compact-left'></i>",
                "<i class='bi bi-chevron-compact-right'></i>"
            ],
            dots: false,
            autoplayTimeout: 4000,
            responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
        });
    });



    $(document).ready(function ($) {
        $(".explore-carousel").owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            autoplayTimeout: 4000,
            responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }
        });
        var owl = $(".explore-carousel");
        owl.owlCarousel();


        $(".next-btn").click(function () {
            owl.trigger("next.owl.carousel");
        });
        $(".prev-btn").click(function () {
            owl.trigger("prev.owl.carousel");
        });
        $(".prev-btn").addClass("disabled");
        $(owl).on("translated.owl.carousel", function (event) {
            if ($(".owl-prev").hasClass("disabled")) {
                $(".prev-btn").addClass("disabled");
            } else {
                $(".prev-btn").removeClass("disabled");
            }
            if ($(".owl-next").hasClass("disabled")) {
                $(".next-btn").addClass("disabled");
            } else {
                $(".next-btn").removeClass("disabled");
            }
	    });
    });

    $(document).ready(function ($) {
        $(".custom-carousel").owlCarousel({
            autoplay: true,
            margin: 15,
            loop: false,
            center: false,
            responsive: {
            0: {
                items: 3
            },
            600: {
                items: 6
            },
            1000: {
                items: 6
            }
        }
        });
        var owl = $(".custom-carousel");
        owl.owlCarousel();


        $(".next-btn").click(function () {
            owl.trigger("next.owl.carousel");
        });
        $(".prev-btn").click(function () {
            owl.trigger("prev.owl.carousel");
        });
        $(".prev-btn").addClass("disabled");
        $(owl).on("translated.owl.carousel", function (event) {
            if ($(".owl-prev").hasClass("disabled")) {
                $(".prev-btn").addClass("disabled");
            } else {
                $(".prev-btn").removeClass("disabled");
            }
            if ($(".owl-next").hasClass("disabled")) {
                $(".next-btn").addClass("disabled");
            } else {
                $(".next-btn").removeClass("disabled");
            }
	    });
    });


$(document).on('click', '.shareBtn', function() {
    $('.copied-msg').removeClass('d-none');
    
    setTimeout(() => {
        $('.copied-msg').addClass('d-none');
    }, 3000);

    var url = $('#copyServiceUrl').val();
    copyToClipboard(url); // Corrected function name
});

function copyToClipboard(text) {
    // Check if the Clipboard API is available
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text)
            .then(function() {
                console.log('Text copied to clipboard: ' + text);
            })
            .catch(function(err) {
                console.error('Unable to copy text to clipboard: ', err);
            });
    } else {
        console.error('Clipboard API is not available in this browser.');
    }
}


$(document).on('click','.openShowModal',function() {
    $('#buyModal').modal('show'); // Show the Register Modal
});

$(document).ready(function() {
    $(document).on('click', '.newsletter-submit', function() {
        var email = $('#newsletterEmail').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if(email != null){
            $.ajax({
                type: "POST",
                url: "{{ url('newsletter/store') }}",
                data: { email: email },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    $('#newsletterEmail').val('');
                    $('.showSuccessDiv').removeClass('d-none');
                    $('.showSuccessDiv').fadeOut(5000);
    
                    // Handle the response, show a success message to the user, etc.
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Log the error response if needed
                }
            });
        }

    });
});

$(document).ready(function() {
// Show the Register Modal when the "Sign Up" button is clicked
    $('.userSignUpBtn').on('click', function() {
        $('#signInToggle').modal('hide'); // Hide the Sign In Modal
        $('#setUserRole').val('User'); // Hide the Sign In Modal
        $('#userRegisterToggle').modal('show'); // Show the Register Modal
    });
    $('.partnerSignUpBtn').on('click', function() {
        $('#signInToggle').modal('hide'); // Hide the Sign In Modal
        $('#setPartnerRole').val('Partner'); // Hide the Sign In Modal
        $('#registerToggle').modal('show'); // Show the Register Modal
    });
    $('.showSignInBtn').on('click', function() {
        $('#registerToggle').modal('hide'); // Show the Register Modal
        $('#userRegisterToggle').modal('hide'); // Show the Register Modal
        $('#signInToggle').modal('show'); // Hide the Sign In Modal
    });
    $('.searchItemBtn').on('click', function() {
        $('#searchItemModal').modal('show'); // Show the Search Modal
    });
    $('.userSignInOtpBtn').on('click', function() {
        $('#signInToggle').modal('hide');
        $('#signInOtp').modal('show');
    });
});



//Search Modal in mobile

$(document).ready(function() {
    $(document).on('click', '.filter-btn', function() {
        $('.category-filter').removeClass('d-none');
        $('.category-filter').addClass('mb-4');
        $('.cross-icon').removeClass('d-none');
        $(this).addClass('d-none');
    });
    $(document).on('click', '.cross-icon', function() {
        $('.category-filter').addClass('d-none');
        $('.category-filter').removeClass('mb-4');
        $('.filter-btn').removeClass('d-none');
        $(this).addClass('d-none');
    });
    $(document).on('click', '#search-btn', function() {
        $('#search-overlay').fadeIn();
        $('body').addClass('overflow-hidden-index');
        $('.osahan-header').addClass('hide-header');
        $('.mobile-search-input').focus();
    });
    $('.submit-search-form').click(function() {
        $('#mobileSearchForm').submit();
    });
 
    window.addEventListener('mouseup',function(event){
        var pol = document.getElementById('search-overlay');
        if(event.target == pol){
            $('#search-overlay').fadeOut();
            $('body').removeClass('overflow-hidden-index');
             $('.osahan-header').removeClass('hide-header');
        }
    }); 
});


//Owl Carousels
    (function () {
            "use strict";

    var carousels = function () {
        $(".testimonials-carousel1").owlCarousel({
        loop: false,
        margin: 0,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            680: {
            items: 2,
            nav: false,
            loop: false
            },
            1000: {
            items: 3,
            nav: true
            }
        }
        });
    };

        (function ($) {
            carousels();
            })(jQuery);
    })();


    $(document).ready(function ($) {
        $(".partner-carousel1").owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: false,
            autoplay: false,
            autoplayTimeout: 3000, // Set the autoplay interval to 3 seconds
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1500: {
                    items: 1
                },
                2000: {
                    items: 1
                }
            }
        });
    });

    $(document).ready(function () {
        // Iterate through all elements with the 'statistics-title' class
        $(".count-up").each(function () {
            const $this = $(this);
            const endValue = parseFloat($this.data("count")); // Get the data-count attribute value

            const duration = 2000; // Animation duration in milliseconds

            $({ countNum: 0 }).animate(
                { countNum: endValue },
                {
                    duration: duration,
                    easing: "linear",
                    step: function () {
                        // Update the text of the current element
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        // Ensure the final value is accurate
                        $this.text(endValue);
                    },
                }
            );
        });
    });
    
    $(document).ready(function(){
        $(document).on('click','.getOtpBtn', function(e) {
            var phone = $('.phone').val();
            $.ajax({
                type: "GET",
                url: "{{ route('send-number-to-get-otp') }}",
                data: {phone:phone},
                success: function(response) {
                    if (response.status == 'success') {
                        $('.phoneCol').addClass('d-none');
                        $('.otpCol').removeClass('d-none');
                        $('.errorMsg').addClass('d-none');
                        setTime();
                    } else {
                        $('.errorMsg').removeClass('d-none');
                        $('.errorMsg').html(response.message);
                    }
                },
                error: function(xhr) {
                    $('.errorMsg').removeClass('d-none');
                    $('.errorMsg').html('The given data was invalid.');
                }
            });
        });
        $('#loginOtpForm').on('submit',function(e){
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            $.ajax({
                type: method,
                url: route,
                data: data,
                contentType: false, // Set content type to false as FormData handles it
                processData: false,
                success: function(response) {
                    $('#Timer').hide();
                    if (response.status == 'success') {
                        var redirectUrl = "{{ url('/panel/dashboard') }}";
                        window.location.href = redirectUrl;
                    } else {
                        $('.errorMsg').removeClass('d-none');
                        $('.errorMsg').html(response.message);
                    }
                },
                error: function(xhr) {
                    $('.errorMsg').removeClass('d-none');
                    $('.errorMsg').html('Phone must be 10 digit.');
                }
            });
        });
    });
    function setTime(){
        $('#Timer').show();
        $('#resendOtp').html('Resend OTP in ');
        var timeLeft = 30;
        var elem = document.getElementById('Timer');

        var timerId = setInterval(countdown, 1000);

        function countdown() {
            if (timeLeft == 0) {
                clearTimeout(timerId);
                $('#Timer').hide();
                $('#resendOtp').html('<span class="getOtpBtn text-success">Resend OTP</span>');
            } else {
                elem.innerHTML = timeLeft + ' seconds';
                timeLeft--;
            }   
        }
    }

    
    // Hamburger
    document.getElementsByClassName("toggler-navbar")[0].addEventListener("click", toogleClass);

    function toogleClass() {
        document.getElementsByClassName("mobile-nav-sidebar")[0].classList.toggle('open')
        $('.osahan-header').addClass('hide-header');
        $('body').addClass('overflow-hidden-index');

    }

    $('.mobile-menu-close').on('click', function() {
        document.getElementsByClassName("mobile-nav-sidebar")[0].classList.toggle('open')
        $('.osahan-header').removeClass('hide-header');
        $('body').removeClass('overflow-hidden-index');
    });
</script>