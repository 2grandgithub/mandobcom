

@component('components.panel_default_with_blank')
    @slot('active') Recipt @endslot
      @slot('page_title') @lang('page.Recipt')  @endslot
    @slot('panel_title') @lang('page.Recipt') @endslot

    @slot('body')
       <style type="text/css">
         @media print
         {
            #CompanySideMemberShip  {display:none;}
            div.page-content {margin-right: 20px; margin-left: 20px;}
            body:not(section#print) {display:none;}

         }
      </style>
             {{--
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Invoice</a></li>
                    <li class="active">#Y14-152</li>
                </ul> --}}
                <!-- END BREADCRUMB -->

        <div class="push-down-10 pull-right">
            <button onclick="make_print()" class="btn btn-default"><span class="fa fa-print"></span> Print</button>
        </div>
        <section id="print">
         <h2>
            <img src="{{auth('Company')->user()->logo}}" width="150px"/>
         </h2>
         <h2 style="color: #5D8E4A;" >INVOICE <!--<strong>#Y14-152</strong>--></h2>

         <!-- INVOICE -->
         <div class="invoice">

             <div class="row ">
                 <div class="col-md-4 ">

                     <div class="invoice-address">
                         <h5>From</h5>
                         <h6> {{auth('Company')->user()["name_$lang"]}} </h6>
                         <p>  {{auth('Company')->user()->phone}} </p>
                         <p>  {{auth('Company')->user()->email}} </p>
                         <p>  {{auth('Company')->user()->aramex_CountryCode}} - {{auth('Company')->user()->aramex_City}} </p>
                     </div>

                 </div>
                 <div class="col-md-4">

                     <div class="invoice-address">
                         <h5>To</h5>
                         <h6>{{$Recipt->buyer_name}}</h6>
                         <p>{{$Recipt->buyer_phone}}</p>
                         <p>{{$Recipt->buyer_email}}</p>
                         <p>{{$Recipt->buyer_location}}</p>
                     </div>

                 </div>
                 <div class="col-md-4">

                     <div class="invoice-address">
                         <h5>Invoice</h5>
                         <table class="table table-striped table-bordered mydir">
                             <tr>
                                 <td width="200">Invoice Number:</td><td class="text-right">{{$Recipt->id}}</td>
                             </tr>
                             <tr>
                                 <td>Invoice Date:</td><td class="text-right">{{$Recipt->created_at}}</td>
                             </tr>
                             {{-- <tr>
                                 <td><strong>Total:</strong></td><td class="text-right"><strong>{{$Recipt->total_price}} @lang('page.JD') </strong></td>
                             </tr> --}}
                         </table>

                     </div>

                 </div>
             </div>

             <div class="table-invoice">
                 <table class="table mydir">
                     <tr>
                         <th>Item Description</th>
                         <th class="text-center">Unit Price</th>
                         <th class="text-center">Quantity</th>
                         <th class="text-center">Total</th>
                     </tr>
                     @foreach ($ReciptItem as $Item)
                        <tr>
                            <td width="50%">
                                <img src="{{$Item->image}}" width="100px">
                                <strong>{{$Item->item_name??$Item->offer_name}}</strong>
                                <p>{{$Item->substring_description}}</p>
                            </td>
                            <td class="text-center">{{$Item->single_price}} @lang('page.JD')</td>
                            <td class="text-center">{{$Item->quantity}}</td>
                            <td class="text-center">{{$Item->total_price}} @lang('page.JD')</td>
                        </tr>
                     @endforeach
                     <tr>
                       <td></td>
                       <td></td>
                       <td> </td>
                       <td>
                         <strong>Total:</strong>
                          <p style="color: #5D8E4A;"> <b> {{$Recipt->total_price}} @lang('page.JD') </b>  </p>
                       </td>
                     </tr>

                 </table>
             </div>


         </div>
         <!-- END INVOICE -->
        </section><!--End print-->

     @endslot

    @slot('script')
      <script>
         function make_print()
         {
            window.print();
              // var prtContent = document.getElementById("print");
              //  var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
              //  WinPrint.document.write(prtContent.innerHTML);
              //  WinPrint.document.close();
              //  WinPrint.focus();
              //  WinPrint.print();
              //  WinPrint.close();
         }
      </script>
    @endslot

    @endcomponent
