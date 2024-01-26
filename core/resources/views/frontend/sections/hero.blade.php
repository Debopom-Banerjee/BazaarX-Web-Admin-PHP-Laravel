<section class="main-banner bg-white pt-1" style="background-image: url({{asset('storage/backend/constant-management/sliders/'.$slider->image)}}); ">
    <div class="container mx-auto h-full flex flex-col text-center px-6 home-content mb-4 py-5" >
        <h2 class="intro-subtitle " >{{ $slider->title }}</h2><!-- End .h3 intro-subtitle -->
        <p class="intro-subdescription">{{Str::limit($slider->description,400) }}</p><!-- End .intro-title -->
        
        <form action="{{ route('search.index') }}" method="get" class="searchForm">
            <div class="col-12">
                <div class="d-flex gap-3 align-items-center">
                    <div class="input-group input-group-lg border-0 p-1 bg-white shadow-sm rounded-3 homeSearch"style="margin-left: 30px;
                    margin-top: 40px;">
                        <span class="input-group-text bg-white border-0"><i class="icofont-search"></i></span>
                        <input name="search" type="text" class="form-control bg-white border-0 ps-0" placeholder="Search by Service Name..." aria-label="Username" aria-describedby="basic-addon1" style="font-size: 1rem;    line-height: 1.5rem;">
                    </div>
                </div>
            </div>
        </form>

        <div class="row justify-content-around mt-5">
            <div class="col-md-3 col-sm-6 border-right">
                <h6 class="statistics-title count-up" data-count="{{ $customersCount }}">{{ $customersCount }}</h6>
                <span>Customers Served</span> 
            </div>
            <div class="col-md-3 col-sm-6 border-right">
                <h6 class="statistics-title" data-count="{{ $totalOrdersValue }}">{{ thousandsCurrencyFormat($totalOrdersValue) }}</h6>
                <span>Ordered Value</span> 
            </div>
            <div class="col-md-3 col-sm-6 border-right">
                <h6 class="statistics-title count-up"data-count="{{ $deliveredOrders }}">{{ $deliveredOrders }}</h6>
                <span class="mobile-no-wrap">Sucessful Deliveries</span> 
            </div>
            <div class="col-md-3 col-sm-6 mobile-w-50">
                <h6 class="statistics-title count-up" data-count="{{ $serviceOfferings }}">{{ $serviceOfferings }}</h6>
                <span>Service Offering</span> 
            </div>
        </div>
    </div>     
</section>