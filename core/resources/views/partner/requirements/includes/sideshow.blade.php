<div class="side-slide">
    <div class="">
        <div class="card-header d-flex justify-content-between" style="background-color: #19b5fe">
            <h5 class="text-white mt-2 mb-0"></h5>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card-body lead-details">
            <form class="checkOutForm" action="{{route('panel.partner.leads.checkpoint')}}" method="GET" >
                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                <input type="hidden" name="requirement_id" id="requirement_id" value="">
                <div class="row">
                    <div class="col-12 ml-2">
                        <div class="">
                            <div class="d-flex justify-content-between">
                                <div class="requirementStatusName">
                                </div>
                                <div class="text-muted requirementCreatedAt">
                                </div>
                            </div>
                            <br>
                            <h6 class="fw-700 requirementTitle">
                            </h6> 
                            <div class="d-flex text-muted">
                                <strong class="requirementCategory"></strong> > <strong class="requirementSubCategory"></strong>
                            </div>
                            <div class="mt-1 mb-3">
                                <div class="text-muted requirementLocation">
                                </div>
                            </div> 
                            <div>
                                <ul class="alert-secondary p-2 text-muted list-unstyled" style="background-color: #eee; border-color: #eee;">
                                    <li>
                                        Customer: 
                                        <strong class="customerName">
                                        </strong>
                                    </li>
                                    <li>
                                        Phone: 
                                        <strong class="customerPhone">
                                        </strong>
                                    </li>
                                    <li>
                                        Email: 
                                        <strong class="customerEmail"></strong>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="mt-3 mb-3 ml-1 d-flex justify-content-between">
                                <div class="requirementBudget">
                                </div>
                                <div class="requirementPrice">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="buyBtn">
                </div>
            </form>
            <hr>
        </div>   
        
        
        <div class="card-body lead-loader">
            <div class="m-5 p-5 text-center">
                <i class="fa fa-spin fa-spinner"></i>
                <br>
                Loading lead details
            </div>
        </div>   
        
        <div class="alert alert-warning ml-2 mr-2">
            <i class="fa fa-info-circle"></i>
            BazaarX provides dynamic lead pricing for customers based on the level of engagement with the lead. Based on each sale price defers.
        </div>

    </div>
</div>