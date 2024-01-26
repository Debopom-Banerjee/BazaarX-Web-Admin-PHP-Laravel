<div class="modal fade" id="rejeactPayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rejeactPaymentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('panel.payment.reject')}}" method="POST" >
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejeactPaymentLabel">Give Reason to Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="paymentId" name="id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Reason</label>
                                <textarea placeholder="Enter Your Reason here.." class="form-control" name="reason" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Cancel Payment</button>
                </div>
            </div>
        </form>
    </div>
</div>