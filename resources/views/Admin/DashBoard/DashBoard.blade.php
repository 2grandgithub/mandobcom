

@extends('atlant.blank')

@section('content')
      @php($active='DashBoard')

      @permission('DashBoard')

      {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}

      <style media="screen">
          .widget-data
          {
              padding-right: 20px;
          }
      </style>

      <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
      <div class="col-md-12" id="myroot">


        <br>
    <!-- START WIDGETS -->
    <div class="row">
      <div class="col-md-3">

          <!-- START WIDGET MESSAGES -->
          <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Company')}}';" style="cursor: pointer">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
              <div class="widget-data">
                  <div class="widget-int num-count"> {{$Company_count}} </div>
                  <div class="widget-title">  @lang('page.Company')  </div>
                  <div class="widget-subtitle"> @lang('page.All Company') </div>
              </div>
          </div>
          <!-- END WIDGET MESSAGES -->

      </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Buyer')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <span class="fa fa-user"></span>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$Buyer_count}} </div>
                    <div class="widget-title"> @lang('page.Buyer') </div>
                    <div class="widget-subtitle"> @lang('page.All Buyer')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Recycable')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <span class="fa fa-user"></span>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$Recycable_count}} </div>
                    <div class="widget-title"> @lang('page.Recycable') </div>
                    <div class="widget-subtitle">  @lang('page.All Recycable')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('ProducerFamily')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <span class="fa fa-user"></span>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$ProducerFamily_count}} </div>
                    <div class="widget-title">  @lang('page.ProducerFamily') </div>
                    <div class="widget-subtitle">  @lang('page.All ProducerFamily')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
    </div>
    <!-- END WIDGETS -->
    <div class="row">
      <div class="col-md-3">

          <!-- START WIDGET MESSAGES -->
          <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Item')}}';" style="cursor: pointer">
                <div class="widget-item-left">
                    <i class="fa fa-weibo"></i>
                </div>
              <div class="widget-data">
                  <div class="widget-int num-count"> {{$Item_count}} </div>
                  <div class="widget-title">  @lang('page.Item')  </div>
                  <div class="widget-subtitle"> @lang('page.All Item') </div>
              </div>
          </div>
          <!-- END WIDGET MESSAGES -->

      </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Offer')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <i class="fa fa-weibo"></i>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$Offer_count}} </div>
                    <div class="widget-title"> @lang('page.Offer') </div>
                    <div class="widget-subtitle"> @lang('page.All Offer')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('ProducerFamilyProduct')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <i class="fa fa-weibo"></i>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$ProducerFamilyProduct_count}} </div>
                    <div class="widget-title"> @lang('page.ProducerFamilyProduct') </div>
                    <div class="widget-subtitle">  @lang('page.All ProducerFamilyProduct')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('AuctionRequest')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <i class="fa fa-weibo"></i>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$AuctionRequest_count}} </div>
                    <div class="widget-title">  @lang('page.AuctionRequest') </div>
                    <div class="widget-subtitle">  @lang('page.All AuctionRequest')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
    </div>
    <!-- END WIDGETS -->

    {{-- ---------------------------Items charts-------------------------- --}}
  <div class="row">
        <div class="col-md-12">
               @component('components.panel_default')
                  @slot('panel_title')
                      @lang('page.Item') ({{\Carbon\Carbon::now()->year}})
                  @endslot
                  @slot('body')
                        <div id="morris_Items"></div>
                  @endslot
               @endcomponent
        </div><!--End col-md-12-->
  </div><!--End row-->
  {{-- ---------------------------End Items charts-------------------------- --}}

    {{-- ---------------------------scand row charts-------------------------- --}}
    <div class="row">
          <div class="col-md-12">
                 @component('components.panel_default')
                    @slot('panel_title')
                        @lang('page.Offers') ({{\Carbon\Carbon::now()->year}})
                    @endslot
                    @slot('body')
                          <div id="morris_offers"></div>
                    @endslot
                 @endcomponent
          </div><!--End col-md-12-->
    </div><!--End row-->
  {{-- ---------------------------End scand row  charts-------------------------- --}}

    {{-- ---------------------------thired row charts-------------------------- --}}
    <div class="row">
          <div class="col-md-8">
                 @component('components.panel_default')
                    @slot('panel_title')
                        @lang('page.recycables_whenfull_requests') ({{\Carbon\Carbon::now()->year}})
                    @endslot
                    @slot('body')
                          <div id="morris_recycables_whenfull_requests"></div>
                    @endslot
                 @endcomponent
          </div><!--End col-md-8-->

        <div class="col-md-4">

              @component('components.panel_default')
                 @slot('panel_title')
                     @lang('page.Whenfull') ({{\Carbon\Carbon::now()->year}})
                 @endslot
                 @slot('body')
                     <div id="morris_Whenfull_is" style="height:255px" ></div>
                     <table class="table mydirection"  >
                         <tr>
                            <th> @lang('page.Whenfull_is_done') </th>
                            <td> {{$Whenfull_is_done}} </td>
                         </tr>
                         <tr>
                            <th> @lang('page.Whenfull_not_done') </th>
                            <td> {{$Whenfull_not_done}}  </td>
                         </tr>
                     </table>
                 @endslot
              @endcomponent

        </div><!--End col-md-4-->
    </div><!--End row-->
  {{-- ---------------------------End thired row charts-------------------------- --}}

    {{-- ---------------------------thired row charts-------------------------- --}}
    <div class="row">
          <div class="col-md-12">
                 @component('components.panel_default')
                    @slot('panel_title')
                        @lang('page.producer_family_products') ({{\Carbon\Carbon::now()->year}})
                    @endslot
                    @slot('body')
                          <div id="morris_producer_family_products"></div>
                    @endslot
                 @endcomponent
          </div><!--End col-md-12-->

    </div><!--End row-->
  {{-- ---------------------------End thired row charts-------------------------- --}}

    {{-- ---------------------------forth row charts-------------------------- --}}
    <div class="row">
          <div class="col-md-12">
                 @component('components.panel_default')
                    @slot('panel_title')
                        @lang('page.auction_requests') ({{\Carbon\Carbon::now()->year}})
                    @endslot
                    @slot('body')
                          <div id="morris_auction_requests"></div>
                    @endslot
                 @endcomponent
          </div><!--End col-md-12-->

    </div><!--End row-->
  {{-- ---------------------------End forth row charts-------------------------- --}}



      </div><!--End col-md-12 root-->
</div><!--End row -->
</div><!--End page-content-wrap-->
<!-- END PANEL WITH STATIC CONTROLS -->


@else
  <br><br>
  <div class="container">
      <h2> @lang('page.you dont have a permissions') </h2>
  </div>
@endpermission



@endsection


@section('script')

  <script type="text/javascript" src="{{asset('atlant/js/plugins/morris/raphael-min.js')}}"></script>
  <script type="text/javascript" src="{{asset('atlant/js/plugins/morris/morris.min.js')}}"></script>

  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.js"></script> --}}

  <script>

    morris_Items_MorrisArea();
    morris_offers_MorrisArea();
    morris_recycables_whenfull_requests_MorrisArea();
    Whenfull_is_Donut();
    producer_family_products_MorrisArea();
    morris_auction_requests_MorrisArea();


   function morris_Items_MorrisArea()
   {
       var current_year = '{{\Carbon\Carbon::now()->year}}';
       @if (app()->getLocale() == 'ar')
           var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
       @else
           var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
       @endif

       Morris.Area({
        element: 'morris_Items',
        data:
        [
               { month: current_year+'-1', count: 0 },
               { month: current_year+'-2', count: 0 },
               { month: current_year+'-3', count: 0 },
               { month: current_year+'-4', count: 0 },
               { month: current_year+'-5', count: 0 },
               { month: current_year+'-6', count: 0 },
               { month: current_year+'-7', count: 0 },
               { month: current_year+'-8', count: 0 },
               { month: current_year+'-9', count: 0 },
               { month: current_year+'-10', count: 0 },
               { month: current_year+'-11', count: 0 },
               { month: current_year+'-12', count: 0 },
                @foreach ($morris_Items as $row)
                 {
                    month:current_year+'-{{$row->month}}',
                    count:'{{$row->count}}'
                 },
               @endforeach
        ],
       lineColors: ['#33414E', '#E0EEF9', '#ff758e'],
       xkey: 'month',
       ykeys: ['count'],
       labels: ["@lang('Patient')"],
       xLabelFormat:function(x) {
           var month=months[x.getMonth()];
           return month
       },
           dateFormat:function(x) {
               var month=months[new Date(x).getMonth()];
               return month
       },
       pointSize: 0,
       lineWidth: 0,
       resize: true,
       fillOpacity: 0.8,
       behaveLikeLine: true,
       gridLineColor: '#e0e0e0',
       hideHover: 'auto'
       });
   }

function morris_offers_MorrisArea()
{
    var current_year = '{{\Carbon\Carbon::now()->year}}';
    // $('h2#report').append(' '+current_year);
    // $('.current_year').append(' '+current_year);
    @if (app()->getLocale() == 'ar')
        var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
    @else
        var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    @endif

    Morris.Area({
        element: 'morris_offers',
        data:
        [
          { month: current_year+'-1', count: 0 },
          { month: current_year+'-2', count: 0 },
          { month: current_year+'-3', count: 0 },
          { month: current_year+'-4', count: 0 },
          { month: current_year+'-5', count: 0 },
          { month: current_year+'-6', count: 0 },
          { month: current_year+'-7', count: 0 },
          { month: current_year+'-8', count: 0 },
          { month: current_year+'-9', count: 0 },
          { month: current_year+'-10', count: 0 },
          { month: current_year+'-11', count: 0 },
          { month: current_year+'-12', count: 0 },
          @foreach ($morris_offers as $row)
           {
              month:current_year+'-{{$row->month}}',
              count:'{{$row->count}}'
           },
         @endforeach
    ],
    lineColors: ['#003333', '#E0EEF9', '#ff758e'],
    xkey: 'month',
    ykeys: ['count'],
    labels: ["@lang('Offer')"],
    xLabelFormat:function(x) {
        var month=months[x.getMonth()];
        return month
    },
        dateFormat:function(x) {
            var month=months[new Date(x).getMonth()];
            return month
    },
    pointSize: 0,
    lineWidth: 0,
    resize: true,
    fillOpacity: 0.8,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    hideHover: 'auto'
    });
}

function Whenfull_is_Donut()
{
      Morris.Donut({
          element: 'morris_Whenfull_is',
          data: [{
                  label: ' @lang('page.Whenfull_is_done') ',
                  value: {{$Whenfull_is_done}}
              }, {
                  label: ' @lang('page.Whenfull_not_done') ',
                  value: {{$Whenfull_not_done}}
              }
          ],
          colors: ['#b0dd91', '#660000' ],
          formatter: function(y) {
              return y
          }
      });
}


function morris_recycables_whenfull_requests_MorrisArea()
{
    var current_year = '{{\Carbon\Carbon::now()->year}}';
    // $('h2#report').append(' '+current_year);
    // $('.current_year').append(' '+current_year);
    @if (app()->getLocale() == 'ar')
        var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
    @else
        var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    @endif

    Morris.Area({
        element: 'morris_recycables_whenfull_requests',
        data:
        [
          { month: current_year+'-1', count: 0 },
          { month: current_year+'-2', count: 0 },
          { month: current_year+'-3', count: 0 },
          { month: current_year+'-4', count: 0 },
          { month: current_year+'-5', count: 0 },
          { month: current_year+'-6', count: 0 },
          { month: current_year+'-7', count: 0 },
          { month: current_year+'-8', count: 0 },
          { month: current_year+'-9', count: 0 },
          { month: current_year+'-10', count: 0 },
          { month: current_year+'-11', count: 0 },
          { month: current_year+'-12', count: 0 },
          @foreach ($morris_recycables_whenfull_requests as $row)
           {
              month:current_year+'-{{$row->month}}',
              count:'{{$row->count}}'
           },
         @endforeach
    ],
    lineColors: ['#191967', '#E0EEF9', '#ff758e'],
    xkey: 'month',
    ykeys: ['count'],
    labels: ["@lang('page.Recycable')"],
    xLabelFormat:function(x) {
        var month=months[x.getMonth()];
        return month
    },
        dateFormat:function(x) {
            var month=months[new Date(x).getMonth()];
            return month
    },
    pointSize: 0,
    lineWidth: 0,
    resize: true,
    fillOpacity: 0.8,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    hideHover: 'auto'
    });
}

function producer_family_products_MorrisArea()
{
    var current_year = '{{\Carbon\Carbon::now()->year}}';
    // $('h2#report').append(' '+current_year);
    // $('.current_year').append(' '+current_year);
    @if (app()->getLocale() == 'ar')
        var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
    @else
        var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    @endif

    Morris.Area({
        element: 'morris_producer_family_products',
        data:
        [
          { month: current_year+'-1', count: 0 },
          { month: current_year+'-2', count: 0 },
          { month: current_year+'-3', count: 0 },
          { month: current_year+'-4', count: 0 },
          { month: current_year+'-5', count: 0 },
          { month: current_year+'-6', count: 0 },
          { month: current_year+'-7', count: 0 },
          { month: current_year+'-8', count: 0 },
          { month: current_year+'-9', count: 0 },
          { month: current_year+'-10', count: 0 },
          { month: current_year+'-11', count: 0 },
          { month: current_year+'-12', count: 0 },
          @foreach ($morris_producer_family_products as $row)
           {
              month:current_year+'-{{$row->month}}',
              count:'{{$row->count}}'
           },
         @endforeach
    ],
    lineColors: ['#660000', '#E0EEF9', '#ff758e'],
    xkey: 'month',
    ykeys: ['count'],
    labels: ["@lang('page.ProducerFamily')"],
    xLabelFormat:function(x) {
        var month=months[x.getMonth()];
        return month
    },
        dateFormat:function(x) {
            var month=months[new Date(x).getMonth()];
            return month
    },
    pointSize: 0,
    lineWidth: 0,
    resize: true,
    fillOpacity: 0.8,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    hideHover: 'auto'
    });
}

function morris_auction_requests_MorrisArea()
{
    var current_year = '{{\Carbon\Carbon::now()->year}}';
    // $('h2#report').append(' '+current_year);
    // $('.current_year').append(' '+current_year);
    @if (app()->getLocale() == 'ar')
        var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
    @else
        var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    @endif

    Morris.Area({
        element: 'morris_auction_requests',
        data:
        [
          { month: current_year+'-1', count: 0 },
          { month: current_year+'-2', count: 0 },
          { month: current_year+'-3', count: 0 },
          { month: current_year+'-4', count: 0 },
          { month: current_year+'-5', count: 0 },
          { month: current_year+'-6', count: 0 },
          { month: current_year+'-7', count: 0 },
          { month: current_year+'-8', count: 0 },
          { month: current_year+'-9', count: 0 },
          { month: current_year+'-10', count: 0 },
          { month: current_year+'-11', count: 0 },
          { month: current_year+'-12', count: 0 },
          @foreach ($morris_auction_requests as $row)
           {
              month:current_year+'-{{$row->month}}',
              count:'{{$row->count}}'
           },
         @endforeach
    ],
    lineColors: ['#2795ec', '#E0EEF9', '#ff758e'],
    xkey: 'month',
    ykeys: ['count'],
    labels: ["@lang('page.AuctionRequest')"],
    xLabelFormat:function(x) {
        var month=months[x.getMonth()];
        return month
    },
        dateFormat:function(x) {
            var month=months[new Date(x).getMonth()];
            return month
    },
    pointSize: 0,
    lineWidth: 0,
    resize: true,
    fillOpacity: 0.8,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    hideHover: 'auto'
    });
}


  </script>

@endsection
