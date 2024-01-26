<div class="modal fade" id="siteModal" tabindex="-1" role="dialog" aria-labelledby="siteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @if(isset($content) )
              <p>{{ $content }}</p>
            @endif
                @if(isset($ul))
                    <ul>
                        <li> Slider Format: route|param:value;param2:value</li>		
                        <li>Service: services/show|serviceId:147 specific service</li>
                        <li>Refer & Earn: my-rewards	</li>
                        <li> Contact us: support	</li>
                        <li>Wallet:	wallet	</li>
                        <li>WebView: webview|page:Title;url:www.gofinx.com	external link</li>
                    </ul>
                @endif
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
