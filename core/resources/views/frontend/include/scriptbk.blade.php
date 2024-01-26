



<script src="{{ asset('frontend/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="6929ed83b0274e0054fc6acd-|49" ></script>
<script src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039" integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g==" data-cf-beacon='{"rayId":"7eab0f3e9db185a1","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>
<script src="{{asset('frontend/assets/js/custom.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>





<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>
<script src="{{ asset('backend/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{asset('frontend/assets/js/main.js') }}" type="6929ed83b0274e0054fc6acd-text/javascript"></script>
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
                    items: 4
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

    $(document).on('click','.shareBtn',function(){
        $('.copied-msg').removeClass('d-none')
        setTimeout(() => {
            $('.copied-msg').addClass('d-none')
        }, 3000);
        var url = $('#copyUrl').val();
        Clipboard(url);
    });
    function Clipboard(url){
        var specificURL = url;
        // Create a temporary input element to copy the URL to the clipboard
        var tempInput = document.createElement('input');
        tempInput.value = specificURL;
        document.body.appendChild(tempInput);

        // Select the URL text
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the URL to the clipboard
        try {
            // Copy the URL to the clipboard using the Clipboard API
            document.execCommand('copy');
            console.log('URL copied to clipboard:', specificURL);
        } catch (err) {
            console.error('Failed to copy URL:', err);
        }
        // Remove the temporary input element
        document.body.removeChild(tempInput);
    }
    // Hamburger
    document.getElementsByClassName("toggler-navbar")[0].addEventListener("click", toogleClass);

    function toogleClass() {
        document.getElementsByClassName("hamburger-menu")[0].classList.add('open');
        document.getElementsByClassName("sidebar")[0].classList.toggle('open')
    }
    
    $('.mobile-menu-close').on('click', function() {
        $('.sidebar').hide();
        $('.footer-sticky').removeClass('d-none');
        $('.navbar').removeClass('d-none');
    });
    $('.hamburger-menu').on('click', function() {
            // $(this).toggle('open');
            // document.getElementsByClassName("navbar")[0].classList.toggle('d-none')
            // document.getElementsByClassName("footer-sticky")[0].classList.toggle('d-none')
      });
    


    $(document).ready(function() {
    // Show the Register Modal when the "Sign Up" button is clicked
        $('.userSignUpBtn').on('click', function() {
            $('#signInToggle').modal('hide'); // Hide the Sign In Modal
            $('#role').val('User'); // Hide the Sign In Modal
            $('#registerToggle').modal('show'); // Show the Register Modal
        });
        $('.partnerSignUpBtn').on('click', function() {
            $('#signInToggle').modal('hide'); // Hide the Sign In Modal
            $('#role').val('Partner'); // Hide the Sign In Modal
            $('#registerToggle').modal('show'); // Show the Register Modal
        });
        $('.showSignInBtn').on('click', function() {
            $('#registerToggle').modal('hide'); // Show the Register Modal
            $('#signInToggle').modal('show'); // Hide the Sign In Modal
        });
        $('.openShowModal').on('click', function() {
            $('#buyModal').modal('show'); // Show the Register Modal
        });
    });
    
</script>