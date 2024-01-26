<div class="modal fade" id="add-payout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Request Refund</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <form  method="post" action="{{ route('customer.payout.store') }}">
                    @csrf   
                    <input type="hidden" name="type" value="0">
                    <label class="form-label">How much money you want to request</label>
                    <div class="form-icon position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user fea icon-sm icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input name="amount" required min="1" max="{{ auth()->user()->wallet_balance }}"  type="number" class="form-control ps-5" placeholder="Enter Amount">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Your current wallet amount </h6>
                        <span class="badge bg-info">{{ format_price(auth()->user()->wallet_balance ?? 0) }}</span>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>