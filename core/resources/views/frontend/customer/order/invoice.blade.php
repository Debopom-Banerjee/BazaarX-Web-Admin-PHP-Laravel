@extends('backend.layouts.empty')
@section('title', 'Invoice')
@section('content')
<style>
    @media print {
  .noPrint{
    display:none;
  }
  #myPrntbtn {
        display :  none;
    }
    #printbtn,#printpagebutton{
        display :  none;
    }


}
.table td, .table th {
    padding: 1px !important;
}
.wrapper .page-wrap .main-content{
    padding: 0px !important;

}
</style>
    @php
    $tax =  $order->price*$order->tax;
    $taxres = $tax/100;
    @endphp
    <div class="container-fluid" id="invoice_page">

        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 justify-content-center mx-auto mt-4">
                <div class="card mb-0">
                    <div class="card-header"><h3 class="d-block w-100">
                        <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" style="width: 50px; heigth:auto;" />
                    <small class="float-right">Date:{{$order->date}}</small></h3></div>
                    <div class="card-body">
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <span>{{$from_invoice->name ?? 'GoFinx'}}</span><br>
                                    <span>{{$from_invoice->address_line_1 ?? ''}}</span><br>
                                    <span>{{$from_invoice->address_line_2 ?? ''}}</span><br>
                                    <span>{{$from_invoice->email ?? ''}}</span><br>
                                    <span>{{$from_invoice->phone ?? ''}}</span><br>
                                    <span>{{$from_invoice->gst ?? ''}}</span><br>
                                    
                                    {{-- <span>{{getSetting('frontend_footer_email')}}</span><br>
                                    <span>{{getSetting('frontend_footer_phone')}}</span><br> --}}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <span>{{$to_invoice->name ?? 'User Name'}}</span><br>
                                    <span>{{$to_invoice->address_line_1 ?? 'NA'}}</span><br>
                                    <span>{{$to_invoice->address_line_2 ?? 'NA'}}</span><br>
                                  <span>{{$to_invoice->address_line_2 ?? ''}}</span><br>
                                  <span>{{$to_invoice->phone ?? 'Phone'}}</span><br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <span>{{ __('Invoice #')}}
                                    <strong> {{ $order->txn_no }}</strong>
                                 </span>
                                <br>
                                {{-- <b>{{ __('Order ID:')}}</b> {{ "ORD".$order->id}}<br> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 ">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Item Type')}}</th>
                                            <th>{{ __('Services')}}</th>
                                            {{-- <th>{{ __('Qty')}}</th> --}}
                                            <th>{{ __('Price')}}</th>
                                            {{-- <th>{{ __('Amount')}}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                             $subtotal = 0;
                                            ?>
                                        {{-- @foreach ($orders as $item) --}}
                                            <tr>
                                                <td> {{$order->type}} </td>
                                                {{-- <td>{{ $item->item_id }} (Product Name or title from table)</td> --}}
                                                <td>{{ fetchFirst('App\Models\Service',$order->type_id,'title','')}}</td>

                                                {{-- <td>{{ $item->qty }}</td> --}}
                                                <td>{{format_price($order->price-$taxres) }}</td>

                                            </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                {{-- <p class="lead">{{ __('Amount Due ')}} {{ getFormattedDate($order->created_at) }}</p> --}}
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>GST ({{$order->tax}}%)</th>
                                            <td>

                                                {{ format_price($taxres)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sub Total</th>
                                            <td>

                                                {{ format_price($order->sub_total)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Promo Code <br>
                                                <small>{{$order->promo_code ?? ''}}</small>

                                            </th>
                                            <td>
                                                {{format_price($order->discount)}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Total')}}:</th>
                                            <td>
                                                {{format_price( $order->total )}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row no-print">
                            <div class="col-12">
                                {{-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> {{ __('Submit Payment')}}</button>
                                <button type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i> {{ __('Generate PDF')}}</button>
                                {{-- <button type="button"  onclick="window.print();" class="btn btn-primary pull-right"><i class="fa fa-download"></i> {{ __('Print')}}</button>
                                <button type="button" id="print_invoice_btn" class="btn btn-primary pull-right"><i class="fa fa-download"></i> {{ __('Print')}}</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 p-0" style="position:relative;top:-40px;">
        <div class="col-lg-8 col-md-8 col-12 justify-content-center mx-auto m-0 p-0">

            <button type="button" id="print_invoice_btn" class="btn btn-primary pull-right">
                <i class="fa fa-download"></i> {{ __('Print')}}</button>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript" src="https://superal.github.io/canvas2image/canvas2image.js"></script>
    <script>

        //Create PDf from HTML...
        // function CreatePDFfromHTML() {
        //     var HTML_Width = $(".html-content").width();
        //     var HTML_Height = $(".html-content").height();
        //     var top_left_margin = 15;
        //     var PDF_Width = HTML_Width + (top_left_margin * 2);
        //     var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        //     var canvas_image_width = HTML_Width;
        //     var canvas_image_height = HTML_Height;

        //     var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        //     html2canvas($(".html-content")[0], {background :'#FFFFFF',}).then(function (canvas) {
        //         var imgData = canvas.toDataURL("image/jpeg", 1.0);
        //         var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        //         pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        //         for (var i = 1; i <= totalPDFPages; i++) {
        //             pdf.addPage(PDF_Width, PDF_Height);
        //             pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        //         }
        //         pdf.save(invoice_Id);
        //     });
        // }

        // function print_page() {
        //     var ButtonControl = document.getElementById("btnprint");
        //     ButtonControl.style.visibility = "hidden";
        //     window.print();
        // }
        // const download = () => {
        //     html2canvas(document.querySelector('#invoice_page')).then(canvas => {
        //         document.body.appendChild(canvas);
        //         var canvas1 = document.querySelector("canvas");
        //         if (canvas1.getContext) {
        //             var ctx = canvas1.getContext("2d");
        //             var myImage = canvas1.toDataURL("image/png");
        //         }
        //       //  var imageElement = document.getElementById("MyPix");
        //         imageElement.src = myImage;
        //     });
        // }

        // function invoice_takeshot(){
        //      let invoice_page = $('#invoice_page')[0]
        //     html2canvas(invoice_page).then(function(canvas){

        //     })
        // }

        document.querySelector('#print_invoice_btn').addEventListener('click', function() {
        html2canvas(document.querySelector('#invoice_page'), {
            onrendered: function(canvas) {
                // document.body.appendChild(canvas);
                 return Canvas2Image.saveAsPNG(canvas);
              }
            });
        });
    </script>

@endpush


