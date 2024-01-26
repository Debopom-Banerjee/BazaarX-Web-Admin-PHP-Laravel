<div id="search-overlay" class="block">
  <div class="centered">
    <div class="px-2">
        <form action="{{ route('search.index') }}" method="get"id="mobileSearchForm">
            <div class="col-12 search-modal">
                <div class="d-flex gap-3 align-items-center">
                    <div class="input-group input-group-lg border-0 px-2 bg-white shadow-sm br-37">
                        <input name="search" type="text" class="form-control bg-white border-0 ps-0 mobile-search-input" placeholder="Search by Service Name..." aria-label="Username" aria-describedby="basic-addon1">
                        <span class="input-group-text bg-white border-0 submit-search-form"><i class="icofont-search"></i></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>