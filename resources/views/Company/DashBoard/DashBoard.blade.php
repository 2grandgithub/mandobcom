

@extends('atlant.blank')

@section('content')
      @php($active='DashBoard')
      @companyPermission('DashBoard')

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
    <div class="row">
      <div class="col-md-3">

          <!-- START WIDGET MESSAGES -->
          <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Company/Item')}}';" style="cursor: pointer">
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
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Company/Offer')}}';" style="cursor: pointer">
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
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Company/Recipt')}}';" style="cursor: pointer">
                  <div class="widget-item-left">
                      <i class="fa fa-weibo"></i>
                  </div>
                <div class="widget-data">
                    <div class="widget-int num-count"> {{$Recipt_count}} </div>
                    <div class="widget-title"> @lang('page.Recipt') </div>
                    <div class="widget-subtitle">  @lang('page.All Recipt')  </div>
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('Company/AuctionRequest')}}';" style="cursor: pointer">
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


    {{-- ---------------------------thired row charts-------------------------- --}}
    <div class="row">
          <div class="col-md-8">
                 @component('components.panel_default')
                    @slot('panel_title')
                        @lang('page.Recipt') ({{\Carbon\Carbon::now()->year}})
                    @endslot
                    @slot('body')
                          <div id="morris_Recipt"></div>
                    @endslot
                 @endcomponent
          </div><!--End col-md-8-->

        <div class="col-md-4">

              @component('components.panel_default')
                 @slot('panel_title')
                     @lang('page.Whenfull') ({{\Carbon\Carbon::now()->year}})
                 @endslot
                 @slot('body')
                     <div id="morris_Recipt_donate" style="height:255px" ></div>
                     <table class="table mydirection"  >
                         <tr>
                            <th> @lang('page.Recipt_not_finshed_count') </th>
                            <td> {{$Recipt_not_finshed_count}} </td>
                         </tr>
                         <tr>
                            <th> @lang('page.Recipt_finshed_count') </th>
                            <td> {{$Recipt_finshed_count}}  </td>
                         </tr>
                     </table>
                 @endslot
              @endcomponent

        </div><!--End col-md-4-->
    </div><!--End row-->
  {{-- ---------------------------End thired row charts-------------------------- --}}


      </div><!--End col-md-12 root-->
</div><!--End row -->
</div><!--End page-content-wrap-->
<!-- END PANEL WITH STATIC CONTROLS -->



@endcompanyPermission

@endsection


@section('script')

  <script type="text/javascript" src="{{asset('atlant/js/plugins/morris/raphael-min.js')}}"></script>
  <script type="text/javascript" src="{{asset('atlant/js/plugins/morris/morris.min.js')}}"></script>

  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.js"></script> --}}

  <script>

    morris_Recipt_MorrisArea();
    Recipt_Donut();


   function morris_Recipt_MorrisArea()
   {
       var current_year = '{{\Carbon\Carbon::now()->year}}';
       @if (app()->getLocale() == 'ar')
           var months=["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغستوس", "سبتمبر", "اكتوبر", "نوفمبير", "ديسمبر"];
       @else
           var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
       @endif

       Morris.Area({
        element: 'morris_Recipt',
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
                @foreach ($morris_recipt as $row)
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

function Recipt_Donut()
{
      Morris.Donut({
          element: 'morris_Recipt_donate',
          data: [{
                  label: ' @lang('page.Recipt_not_finshed_count') ',
                  value: {{$Recipt_not_finshed_count}}
              }, {
                  label: ' @lang('page.Recipt_finshed_count') ',
                  value: {{$Recipt_finshed_count}}
              }
          ],
          colors: ['#b0dd91', '#660000' ],
          formatter: function(y) {
              return y
          }
      });
}



  </script>

@endsection
