<?php  use \App\Http\Controllers\Admin\CountController;  ?>
<style>
p#MembershipType {
  color: white;
}
p#MembershipType.Bronze{ background-color: #cd7f32; }
p#MembershipType.Silver{ background-color: #848080; }
p#MembershipType.Golden{ background-color: #D4AF37; }
span.badge.Bronze{ background-color: #cd7f32; }
span.badge.Silver{ background-color: #848080; }
span.badge.Golden{ background-color: #D4AF37; }
</style>

<!-- START PAGE SIDEBAR -->
<div class="page-sidebar page-sidebar-fixed scroll">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            {{-- <a href="index.html">ATLANT</a> --}}
            <a href="#">   mandobcom </a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
              <a href="#" class="profile-mini">
                  <img src="{{asset('atlant/assets/images/users/avatar.jpg')}}" style="width: 100px;height: 100px;"/>
              </a>
              <div class="profile">
              @if (auth('Company')->check())
                <div class="profile-image">
                    <img src="{{auth('Company')->user()->logo}}" alt="John Doe"/>
                </div>
              @endif

                  <div class="profile-data">
                     @if (auth('Admin')->check())
                       <div class="profile-data-name"> {{auth('Admin')->user()->name}} </div>
                       <div class="profile-data-title">{{auth('Admin')->user()->email}}</div>
                     @elseif (auth('Company')->check())
                        @php( $CompanyMembership = \App\Functions::company_membership_info() )
                        @isset ($CompanyMembership->see_auctions)
                            <p id="MembershipType" class="{{\App\Functions::get_membership_class_name($CompanyMembership)}}">
                              {{$CompanyMembership->membership_name}} -
                              <span> {{\App\Functions::get_membership_reming_dayes($CompanyMembership)}} @lang('page.remaining day') </span>
                            </p>
                        @else
                            @php( $CompanyMembership = null )
                        @endisset


                       <div class="profile-data-name"> {{auth('Company')->user()->name_en}} </div>
                       <div class="profile-data-title">{{auth('Company')->user()->email}}</div>
                     @endif

                  </div>
                  <div class="profile-controls">
                      {{-- <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                      <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a> --}}
                  </div>
              </div>
        </li>
        @if (!isset($active))
          @php($active = '')
        @endif
          <li class="xn-title"> التحكم </li>

          @if (auth('Company')->check())
          <!--.....................if Company..........................-->

            <li class="{{($active == 'DashBoard')?'active':''}}" >
                <a href="{{url('Company/DashBoard')}}" >  <span class="xn-text"> @lang('page.DashBoard') </span> <span class="fa fa-home mydir"></span>  </a>
            </li>

            <li class="{{($active == 'Item')?'active':''}}" >
                <a href="{{url('Company/Item')}}" >  <span class="xn-text">  @lang('page.Company products') </span>
                  <span class="fa fa-tag mydir"></span>  </a>
            </li>

            <li class="{{($active == 'Offer')?'active':''}}" >
                <a href="{{url('Company/Offer')}}" >  <span class="xn-text">  @lang('page.Company offers sn') </span>
                  <span class="fa fa-gift mydir"></span>  </a>
            </li>

            <li class="{{($active == 'Recipt')?'active':''}}" >
                <a href="{{url('Company/Recipt')}}" >  <span class="xn-text">  @lang('page.Recipt')</span> <span class="fa fa-clipboard mydir"></span>  </a>
            </li>
            @isset ($CompanyMembership->see_auctions)
              <li class="{{($active == 'AuctionRequest')?'active':''}}" >
                  <a href="{{url('Company/AuctionRequest')}}" class="mydir">
                    <span class="xn-text">  @lang('page.AuctionRequest') </span> <span class="fa fa-align-center mydir"></span>
                    <span class="badge badge-danger {{\App\Functions::get_membership_class_name($CompanyMembership)}}"  >  . </span>
                  </a>
              </li>
            @endisset
            <li class="{{($active == 'MyAuctionRequest')?'active':''}}" >
                <a href="{{url('Company/MyAuctionRequest')}}" class="mydir">
                  <span class="xn-text">  @lang('page.MyAuctionRequest')  </span> <span class="fa fa-align-center mydir"></span>
                </a>
            </li>
            <li>
                <a href="{{url('Site/Company/details/'.auth('Company')->id())}}" target="_blank"  >  <span class="xn-text">   @lang('page.my page on the site') </span> <span class="fa fa-link mydir"></span>  </a>
            </li>

          @elseif (auth('Admin')->check())
          <!--.....................if Admin..........................-->


          @permission('DashBoard')
          <li class="{{($active == 'DashBoard')?'active':''}}" >
              <a href="{{url('DashBoard')}}"   >
                  <span class="xn-text"> @lang('page.DashBoard') </span> <span class="fa fa-home mydir"></span>
              </a>
          </li>
          @endpermission
            <li class="xn-openable {{($active == 'Company'||$active == 'Buyer'||$active == 'Recycable'||$active == 'ProducerFamily')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.users')</span> <i class="fa fa-users mydir"></i> </a>
              <ul>
                  @permission('Company')
                  <li class="{{($active == 'Company')?'active':''}}" >
                      <a href="{{url('Company')}}" class="mydir">
                        <span class="xn-text"> @lang('page.Company')</span> <i class="fa fa-users mydir"></i>
                        <span class="badge badge-danger">  {{CountController::count_Company()}} </span>
                      </a>
                  </li>
                  @endpermission
                  @permission('Buyer')
                  <li class="{{($active == 'Buyer')?'active':''}}" >
                      <a href="{{url('Buyer')}}" class="mydir">
                        <span class="xn-text"> @lang('page.Buyer')</span> <i class="fa fa-users mydir"></i>
                        <span class="badge badge-danger">  {{CountController::count_Buyer()}} </span>
                      </a>
                  </li>
                  @endpermission
                  @permission('Recycable')
                  <li class="{{($active == 'Recycable')?'active':''}}" >
                      <a href="{{url('Recycable')}}" class="mydir" >
                        <span class="xn-text"> @lang('page.Recycable')</span> <i class="fa fa-users mydir"></i>
                        <span class="badge badge-danger">  {{CountController::count_Recycable()}} </span>
                      </a>
                  </li>
                  @endpermission
                  @permission('ProducerFamily')
                  <li class="{{($active == 'ProducerFamily')?'active':''}}" >
                      <a href="{{url('ProducerFamily')}}" class="mydir"  >
                        <span class="xn-text"> @lang('page.ProducerFamily')</span> <i class="fa fa-users mydir"></i>
                        <span class="badge badge-danger">  {{CountController::count_ProducerFamily()}} </span>
                     </a>
                  </li>
                  @endpermission
              </ul>
          </li>

          <li class="xn-openable {{($active == 'City'||$active == 'Governorate')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.Location')</span> <i class="fa fa-location-arrow mydir"></i>    </a>
              <ul>
                  @permission('City')
                  <li class="{{($active == 'City')?'active':''}}" >
                      <a href="{{url('City')}}" >  <span class="xn-text">
                        @lang('page.City')</span> <i class="fa fa-location-arrow mydir"></i>  </a>
                  </li>
                  @endpermission
                  @permission('Governorate')
                  <li class="{{($active == 'Governorate')?'active':''}}" >
                      <a href="{{url('Governorate')}}" >  <span class="xn-text">
                        @lang('page.Governorate')</span> <i class="fa fa-location-arrow mydir"></i>  </a>
                  </li>
                  @endpermission
              </ul>
          </li>
          @permission('Category')
          <li class="{{($active == 'Category')?'active':''}}" >
              <a href="{{url('Category')}}" >  <span class="xn-text"> @lang('page.Category') </span> <span class="fa fa-briefcase mydir"></span>  </a>
          </li>
          @endpermission

          @permission('SubCategory')
          <li class="{{($active == 'SubCategory')?'active':''}}" >
              <a href="{{url('SubCategory')}}" >  <span class="xn-text"> @lang('page.SubCategory') </span> <span class="fa fa-briefcase mydir"></span>  </a>
          </li>
          @endpermission

          <li class="xn-openable {{($active == 'Item'||$active == 'Offer')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.Company')</span> <i class="fa fa-building-o mydir"></i>    </a>
              <ul>
                    @permission('Item')
                    <li class="{{($active == 'Item')?'active':''}}" >
                        <a href="{{url('Item')}}" class="mydir" >  \
                           <span class="xn-text"> منتجات الشركات </span> <span class="fa fa-tag mydir"></span>
                           <span class="badge badge-danger">  {{CountController::count_Item()}} </span>
                        </a>
                    </li>
                    @endpermission
                    @permission('Offer')
                    <li class="{{($active == 'Offer')?'active':''}}" >
                        <a href="{{url('Offer')}}" class="mydir" >
                          <span class="xn-text"> عروض الشركات </span> <span class="fa fa-gift mydir"></span>
                          <span class="badge badge-danger">  {{CountController::count_Offer()}} </span>
                       </a>
                    </li>
                    @endpermission
              </ul>
          </li>

          <li class="xn-openable {{($active == 'RecycablesNews'||$active == 'RecycablesWhenfullRequests')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.Recycling')</span> <i class="fa fa-gears mydir"></i>    </a>
              <ul>
                    @permission('RecycablesNews')
                    <li class="{{($active == 'RecycablesNews')?'active':''}}" >
                        <a href="{{url('RecycablesNews')}}" >  <span class="xn-text"> @lang('page.RecycablesNews')  </span>
                          <span class="fa fa-file-o mydir"></span>  </a>
                    </li>
                    @endpermission
                    @permission('RecycablesWhenfullRequests')
                    <li class="{{($active == 'RecycablesWhenfullRequests')?'active':''}}" >
                        <a href="{{url('RecycablesWhenfullRequests')}}" class="mydir"  >
                           <span class="xn-text"> @lang('page.WhenfullRequests')  </span> <span class="fa fa-gears mydir"></span>
                           <span class="badge badge-danger">  {{CountController::count_RecycablesWhenfullRequests()}} </span>
                        </a>
                    </li>
                    @endpermission
              </ul>
          </li>

          <li class="xn-openable {{($active == 'Membership'||$active == 'CompanyMembership')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.Membership')</span> <i class="fa fa-gears mydir"></i>    </a>
              <ul>
                  @permission('Membership')
                  <li class="{{($active == 'Membership')?'active':''}}" >
                      <a href="{{url('Membership')}}" >  <span class="xn-text"> @lang('page.Membership') </span> <span class="fa fa-tag mydir"></span>  </a>
                  </li>
                  @endpermission
                  @permission('CompanyMembership')
                  <li class="{{($active == 'CompanyMembership')?'active':''}}" >
                      <a href="{{url('CompanyMembership')}}" class="mydir">
                        <span class="xn-text"> اشتراك الشركات </span> <span class="fa fa-tag mydir"></span>
                        <span class="badge badge-danger">  {{CountController::count_CompanyMembership()}} </span>
                     </a>
                  </li>
                  @endpermission
              </ul>
          </li>



          @permission('ProducerFamilyProduct')
          <li class="{{($active == 'ProducerFamilyProduct')?'active':''}}" >
              <a href="{{url('ProducerFamilyProduct')}}" >  <span class="xn-text"> منتجات الاسر المنتجة </span> <span class="fa fa-tag mydir"></span>  </a>
          </li>
          @endpermission
          @permission('AuctionRequest')
          <li class="{{($active == 'AuctionRequest')?'active':''}}" >
              <a href="{{url('AuctionRequest')}}" class="mydir" >
                 <span class="xn-text"> طلبات المناقصات </span> <span class="fa fa-align-center mydir"></span>
                 <span class="badge badge-danger">  {{CountController::count_AuctionRequest()}} </span>
              </a>
          </li>
          @endpermission
          @permission('Recipt')
          <li class="{{($active == 'Recipt')?'active':''}}" >
              <a href="{{url('Recipt')}}" >  <span class="xn-text"> الفواتير </span> <span class="fa fa-clipboard mydir"></span>  </a>
          </li>
          @endpermission

          @permission('chat')
            <li class="xn-openable {{($active == 'Chat'||$active == 'Chat')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.chat')</span> <i class="fa fa-comments mydir"></i>   </a>
              <ul>
                  <li class="{{($active == 'Chat')?'active':''}}" >
                      <a href="{{url('Chat\Buyer')}}">
                        <span class="xn-text"> شات المشتري </span> <span class="fa fa-comments mydir"></span>
                      </a>
                  </li>
                  <li class="{{($active == 'Chat')?'active':''}}" >
                      <a href="{{url('Chat\Recycable')}}">
                        <span class="xn-text"> شات اعادت التدوير</span> <span class="fa fa-comments mydir"></span>
                      </a>
                  </li>
                  <li class="{{($active == 'Chat')?'active':''}}" >
                      <a href="{{url('Chat\ProducerFamily')}}">
                        <span class="xn-text"> شات الاسر المنتجة</span> <span class="fa fa-comments mydir"></span>
                      </a>
                  </li>
              </ul>
          </li>
          @endpermission

          @permission('Setting')
          <li class="{{($active == 'Setting')?'active':''}}" >
              <a href="{{url('Setting')}}" >  <span class="xn-text"> الاعدادات </span> <span class="fa fa-cog mydir"></span>  </a>
          </li>
          @endpermission

         @permission('mainSuperAdmin')
          <li class="xn-openable {{($active == 'Admin'||$active == 'Role')?'active':''}}">
            <a href="#"><span class="xn-text">@lang('page.Admin')</span> <i class="fa fa-gavel mydir"></i>   </a>
            <ul>
                <li class="{{($active == 'Admin')?'active':''}}" >
                    <a href="{{url('Admin')}}" >  <span class="xn-text"> @lang('page.Admin')</span>
                        <i class="fa fa-gavel mydir"></i>
                    </a>
                </li>
                <li class="{{($active == 'Role')?'active':''}}" >
                    <a href="{{url('Role')}}" >  <span class="xn-text"> @lang('page.Role')</span>
                        <i class="fa fa-gavel mydir"></i>
                    </a>
                </li>

            </ul>
        </li>
        @endpermission

        @permission('Slider')
        <li class="{{($active == 'Slider')?'active':''}}" >
            <a href="{{url('Slider')}}" >  <span class="xn-text"> سلايدر الصور  </span> <span class="fa fa-cog mydir"></span>  </a>
        </li>
        @endpermission

        @permission('Advertising')
        <li class="{{($active == 'Advertising')?'active':''}}" >
            <a href="{{url('Advertising')}}" >  <span class="xn-text"> الاعلانات  </span> <span class="fa fa-cog mydir"></span>  </a>
        </li>
        @endpermission

        @permission('ContactUs')
        <li class="{{($active == 'Advertising')?'active':''}}" >
            <a href="{{url('ContactUs')}}" >  <span class="xn-text">  تواصل معنا </span> <span class="fa fa-cog mydir"></span>  </a>
        </li>
        @endpermission

    @endif {{-- END if Admin --}}

            {{-- <li class="xn-openable {{($active == 'Country'||$active == 'Governorate'||$active == 'Area')?'active':''}}">
              <a href="#"><span class="xn-text">@lang('page.Location')</span> <i class="fa fa-location-arrow mydir"></i>    </a>
              <ul>

                    <li class="{{($active == 'Country')?'active':''}}" >
                        <a href="{{url('Country')}}" >  <span class="xn-text">
                          @lang('page.Country')</span> <i class="fa fa-location-arrow mydir"></i>  </a>
                    </li>



                    <li class="{{($active == 'Governorate')?'active':''}}" >
                        <a href="{{url('Governorate')}}"><span class="xn-text">
                          @lang('page.Governorate') </span> <i class="fa fa-location-arrow mydir"></i> </a>
                    </li>

                    <li class="{{($active == 'Area')?'active':''}}" >
                        <a href="{{url('Area')}}"><span class="xn-text">
                          @lang('page.Area') </span> <i class="fa fa-location-arrow mydir"></i> </a>
                    </li>

              </ul>
          </li> --}}


      </li>
<!--===================================================End care=========================================================-->

<!--===================================================End NotificationNotification=========================================================-->
     <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->
