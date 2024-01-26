
    {{-- <div class="row"> --}}
        <div class="row">
            @if($requirements->count() > 0)
                @foreach($requirements as $key =>  $requirement)
                    <input type="hidden" class="key" value="{{ $key }}">
                    <div class="col-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="badge badge-{{ getRequirementStatus($requirement->status)['color'] }}">{{getRequirementStatus($requirement->status)['name']}}</div>

                                        <div class="text-muted">
                                        <i class="ik ik-clock"></i> {{ getFormattedDate($requirement->created_at) }}
                                        </div>
                                    </div>
                                </div>
                                <h6 class="fw-700 mb-0">
                                    {{$requirement->title}}
                                </h6>

                                <span class="text-muted">
                                    <div class="text-muted">
                                        <span class="categoryName">{{fetchFirst('App\Models\Category',$requirement->category_id,'name','--')}}
                                            > {{fetchFirst('App\Models\Category',$requirement->sub_category_id,'name','--')}}
                                        </span>
                                    </div>
                                </span> 
                                
                            
                                <div class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Z"/></svg>
                                    {{ $requirement->location ?? ' --' }}
                            </div>
                            

                                <div class="mt-2">
                                    <ul class="alert-secondary p-2 text-muted list-unstyled" style="background-color: #eee; border-color: #eee;">
                                        <li>
                                            Customer: 
                                            <strong>
                                                {{ $requirement->customer_info['name'] }}
                                                {{-- {{stringMasker($requirement->customer_info['name'], 1,2) }} --}}
                                            </strong>
                                        </li>
                                        @if($requirement->customer_info['phone'])
                                            <li>
                                                Phone: 
                                                <strong>
                                                    {{ $requirement->customer_info['phone'] }}
                                                    {{-- {{stringMasker($requirement->customer_info['phone'], 3,2) }} --}}
                                                </strong>
                                            </li>
                                        @endif
                                        @if($requirement->customer_info['email'])
                                            <li>
                                                Email: 
                                                <strong>
                                                    {{ $requirement->customer_info['email'] }}
                                                </strong>
                                            </li>
                                        @endif
                                    </ul>
                                    
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between fw-700 pt-2 text-primary">
                                            <div>
                                                <span class="text-muted">
                                                    Budget:
                                                </span> 
                                                ₹{{$requirement->getBudget->name }}
                                            </div>
        
                                        </div>
                                        <div>
                                            @if($requirement->customer_info['email'])
                                                <a href="mailto:{{ $requirement->customer_info['email'] }}" type="button" data-requirement_id="{{ $requirement->id }}" class="btn btn-outline-success off-canvas leadInfo mr-2"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                            @endif
                                            @if($requirement->customer_info['email'])
                                                <a href="tel:{{ $requirement->customer_info['phone'] }}" type="button" data-requirement_id="{{ $requirement->id }}" class="btn btn-outline-primary off-canvas leadInfo"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                @endforeach
                <div class="col-12  d-flex justify-content-between mt-4">
                    <div class="pagination">
                        {{ $requirements->appends(request()->except('page'))->links() }}
                    </div>
                    <div>
                        @if($requirements->lastPage() > 1)
                            <label for="">Jump To: 
                                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                                    @for ($i = 1; $i <= $requirements->lastPage(); $i++)
                                        <option value="{{ $i }}" {{ $requirements->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </label>
                        @endif
                    </div>
                </div>
            @else 
                <div class="col-12">
                    <div class="card" style="min-height: 357px;">
                        <div class="text-center my-auto text-muted">
                            <i class="fa fa-box-open" style="font-size: 35px;"></i>
                            <p>No Leads Found!</p>
                        </div>
                    </div>
                </div>
            @endif
    </div>




