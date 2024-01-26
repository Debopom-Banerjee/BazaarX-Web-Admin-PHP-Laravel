<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="walletModal" tabindex="-1"  role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Balance</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('panel.wallet_logs.users.wallet.update') }}" method="post">
        <input type="hidden" value="" name="user_id" id="uuid">
        @csrf
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-radio">
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="type" value="credit">
                                <i class="helper"></i>{{ __('Credit')}}
                            </label>
                        </div>
                       
                    </div>  
                </div>
                <div class="col-lg-6">
                    <div class="form-radio">
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="type" value="debit" >
                                <i class="helper"></i>{{ __('Debit')}}
                            </label>
                        </div>
                    </div>    
                </div>
                <div class="col-lg-12">
                    <input required min="1" type="number" class="form-control" placeholder="Please Enter Amount" name="amount">
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
     </form>
    </div>
  </div>
</div>
