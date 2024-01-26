<div class="modal fade" id="ekycVerification" role="dialog" aria-labelledby="ekycVerificationTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ekycVerificationTitle">eKyc Verification Form</h5>
           <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close" style="padding: 0px 20px;font-size: 20px;">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
          @if (auth()->user()->ekyc_status == 2)
            @php
                $kyc_data = json_decode(auth()->user()->ekyc_info);
            @endphp
            @if(!is_null($kyc_data) && $kyc_data->admin_remark != null)
              <div style="font-size: 16px;" class="alert alert-danger d-flex justify-content-between" role="alert">
                <span class="m-0 p-0" style="line-height: 40px;">
                  {{ $kyc_data->admin_remark ?? '' }}
                </span> 
              </div>
            @endif
              
          @endif
  
            <form action="{{ route('customer.ekyc.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              {{-- @dump($kyc_data) --}}
                <div class="row">
                  <div class="col-md-6 col-12"> 
                      <div class="form-group">
                          <label for="document_type">Document Type<span class="text-danger">*</span></label>
                          <select class="form-control" name="document_type" required >
                              <option value="" readonly>Select Type</option>
                              <option @if(isset($kyc_data) && $kyc_data->document_type == "Pan Card") selected @endif value="Pan Card" readonly>PAN CARD</option>
                              <option @if(isset($kyc_data) && $kyc_data->document_type == "Aadhar Card") selected @endif value="Aadhar Card" readonly>AADHAR CARD</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6 col-12"> 
                      <div class="form-group">
                          <label for="document_number">Document Number<span class="text-danger">*</span></label>
                           <input class="form-control" name="document_number" @if(isset($kyc_data) && $kyc_data->document_number != null) value="{{$kyc_data->document_number }}" @endif required type="text">
                      </div>
                  </div>
                  <div class="col-md-6 col-12"> 
                      <div class="form-group">
                          <label class="mt-2" for="document_front_attachment">Document Front Photo<span class="text-danger">*</span></label>
                           <input class="form-control" name="document_front_attachment" required type="file">
                      </div>
                  </div>
                  <div class="col-md-6 col-12"> 
                      <div class="form-group">
                          <label class="mt-2" for="document_back_attachment">Document Back Photo<span class="text-danger">*</span></label>
                           <input class="form-control" name="document_back_attachment" required type="file">
                      </div>
                  </div>
                  <div class="col-12 text-right mt-4">
                    <button type="submit" class="btn btn-outline-primary">Submit Verify Request</button>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>