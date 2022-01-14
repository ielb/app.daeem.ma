<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Daeem</title>

        <!-- Favicon -->
<link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="/assets/vendor/nucleo/css/nucleo.min.css" rel="stylesheet">
<link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="/assets/css/argon.min.css" rel="stylesheet">
<style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
    </head>

    <body>
        
        <div class="container">
            <div class="row py-5 no-print">
              <div class="col-sm-6 text-center">
                <h1>Invoice Nº: #{{$order->id}} <bR>
            
                </h1>              
                </div>

              <div class="col-sm-6 text-center ">
                <button type="button" id="printBtn" class="btn btn-secondary btn-icon">
                    <span class="btn-inner--icon"><i class="fas fa-print text-primary"></i></span>
                    <span class="btn-inner--text">Print</span>
                </button>
                <button type="button" id="exportBtn" class="btn btn-secondary btn-icon" >
                    <span class="btn-inner--icon "><i class="far fa-file-pdf text-danger"></i></span>
                    <span class="btn-inner--text">Export</span>
                </button>
              </div>
            </div>
            <br>
            <div class="card card-frame" id="area">
                <div class="card-body">
                    <div class="row pt-5 px-5">
                        <div class="col-sm-6">
                            <img class="navbar-brand-img ml-5" src="https://app.daeem.ma/assets/img/brand/daeem_blue.png"  alt="" style="width: 220px;">
                            
                        </div>
                        <div class="col-sm-4 offset-sm-2">
                            <h1>Order #{{$order->code}}</h1>
                            <span class="badge badge-success">Paid</span> <small class="text-muted ml-3">{{$order->created_at->format(config('settings.datetime_display_format'))}}</small> 
                            <br>
                            <small class="text-muted">Payment method: {{  ucfirst($order->payment_method) }}</small>
                        </div>
                      
                    </div>
                    <hr class="text-muted">

                    <div class="row px-5">
                        <div class="col-sm-5 ml-5">
                            <h3>{{ ucfirst($order->client->name)}}</h3>
                            <h4>{{ ucfirst($order->client->email) }}</h4>
                            <h4>{{ ucfirst($order->client->phone) }}</h4>
                            <h4>{{ ucfirst($order->address?$order->address->address:"") }}</h4>
                        </div>
                        <div class="col-sm-2 offset-sm-4">
                            <h3>{{ ucfirst($order->store->name) }}</h3>
                            <h4>{{ ucfirst($order->store->address) }}</h4>
                           <h4>{{ ucfirst($order->store->phone) }}</h4>
                           <h4>{{ ucfirst($order->store->city->name) }}</h4>
                        </div>
                        <div class="col-sm-12 px-5 my-5">
                           <table class="table align-items-center">
                               <thead class="thead-light">
                                   <tr>
                                       <th scope="col" class="sort">Product</th>
                                       <th scope="col" class="sort">Qty</th>
                                       <th scope="col" class="sort">Unit Price</th>
                                       <th scope="col" class="sort">Price</th>
                                   </tr>
                               </thead>
                               <tbody class="list">
                                   @if (count(array($order_products)) > 1)
                                   @foreach ($order_products as $item) 
                                   <tr>

                                       <td>{{ $item->product->name }}</td>
                                       <td>{{ $item->qty }}</td>
                                       <td>{{ number_format($item->product->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                                       <td>{{ number_format($item->qty * $item->product->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>

                                   </tr>
                                   <hr>
                                   @endforeach
                                   @endif

                                       @foreach ($order_products as $key=>$order_product)
                                       
                                      <tr>                                             
                                       <td>{{ $products[$key]->name }}</td>
                                       <td>{{ $order_product->qty }}</td>
                                       <td>{{ number_format($products[$key]->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                                       <td>{{ number_format($order_product->qty * $products[$key]->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                                    </tr>
                                    <br>
                              

                                       @endforeach
                                      
                                      
                                      
                                      
                                

                               </tbody>
                           </table>
                        </div>
                      
                    </div>
                    <div class="row px-5 my-5">
                        <div class="col-6"></div>
                        <div class="col-5 offset-1 text-right">
                            <div class="row">
                            <div class="col-5 offset-2"><h3 class="text-muted">NET</h3></div><div class="col-5 text-left"><h4 class="text-muted" >{{ number_format($order->order_price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></h4></div><br>
                            <div class="col-5 offset-2"><h3 class="text-muted">Delivery</h3></div><div class="col-5 text-left"><h4 class="text-muted" >{{ number_format($order->delivery_price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></h4></div><br>
                            <div class="col-5 offset-2">
                                <h3><b>Total</b></h3></div>
                                <div class="col-5 text-left"><h4><b>{{ number_format($order->order_price + $order->delivery_price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></b></h4>
                                </div>
                            </div>
                        </div>  
                     
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>All Right Reserved © Daeem.ma {{ now()->year }} - {{ now()->year-1 }} </h4>
                        </div> 
                    </div>
                </div>
              </div>
          

          </div>





        <!-- Core -->
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="/assets/js/argon.min.js"></script>
<script type="text/javascript" src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    
    var order="{{ $order->code }}";
    $('#printBtn').on("click", function () {
        
        var element = document.getElementById('area');
        window.print(element);  

    });
    $('#exportBtn').on("click", function () {
        var element = document.getElementById('area');
        var opt = {
           // margin:       1,
            filename:     'order_'+order+'.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        
        //console.log(html2pdf().set(opt).from(element));
        html2pdf().set(opt).from(element).save();
    });
  
</script>
    </body>

</html>