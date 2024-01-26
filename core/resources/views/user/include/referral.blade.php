<div class="card-body pt-3">
    <div class="row">
        <div class="col d-flex justify-content-end">
            <div class="alert alert-info mb-2 py-1 px-2">
                <div class="mb-0" style="font-size: 15px">
                    Referral Code : <strong>{{ $user->referal_code }}</strong>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-between mb-2">

                <div>
                    <label for="">Show
                        <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                            <option value="10" {{ $referrals->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $referrals->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $referrals->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $referrals->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        entries
                    </label>
                </div>
                <div>
                    <button type="button" id="export_button" class="btn btn-success btn-sm" data-table="referralTable">Excel</button>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Column Visibility
                    </button>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item p-0 col-btn" data-val="pr_col_2"><a href="javascript:void(0);"class="btn btn-sm">Inviter</a></li>
                    </ul>
                </div>
                <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
            </div>
            <div class="table-responsive">
                <table class="table" id="referralTable">
                    <thead>
                    <tr>
                        <th>Actions</th>
                        <th>ID</th>
                        <th class="pr_col_2">Inviter</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($referrals->count() > 0)
                        @foreach ($referrals as $referral)
                            <tr>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i
                                                    class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('panel.user_inviters.edit', $referral->id) }}"
                                               title="Edit Referrals" class="btn btn-sm dropdown-item">
                                                <li class=" p-0">Edit</li>
                                            </a>
                                            <li class="dropdown-item p-0">
                                                <a href="{{ route('panel.user_inviters.destroy', [$referral->id,1]) }}"
                                                   title="Delete Referrals" class="btn btn-sm delete-item">
                                                    Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><a href="{{route('panel.user_inviters.edit', $referral->id) }}"
                                       class="btn btn-link">#RE{{getPrefixZeros($referral->id)}}</a></td>
                                <td class="pr_col_2">{{fetchFirst('App\User',$referral->inviter_id,'name','')}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-danger col-12 text-center" colspan="5">Data Not Found !</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $referrals->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if ($referrals->lastPage() > 1)
            <label for="">Jump To:
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="jumpTo">
                    @for ($i = 1; $i <= $referrals->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $referrals->currentPage() == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </label>
        @endif
    </div>
</div>
