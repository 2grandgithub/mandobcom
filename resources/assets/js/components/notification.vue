<template>
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-comments"></span></a>
        <div class="informer informer-danger"> {{count}}</div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-comments"></span> الاشعارات </h3>
                <div class="pull-right">
                    <span class="label label-danger">{{count}} new</span>
                </div>
            </div>
            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                <a v-for="msg in unreaded_notification" @click="mark_as_seen(msg)"  class="list-group-item">

                    <div class="list-group-status status-online"></div>
                    <!-- <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/> -->

                  <!--  .........Start AuctionMatchedWithCompany...........-->
                    <span class="contacts-title" v-if="msg.type=='App\\Notifications\\AuctionMatchedWithCompany'"> مناقصة قد تنفعك </span>
                    <p v-if="msg.type=='App\\Notifications\\AuctionMatchedWithCompany'" >
                      {{msg.data.title}} <br>
                      <span> رقم المزاد :</span>  {{msg.data.auction_id}} <br>
                      <span> الكمية المطلوبة: </span> {{msg.data.required_quantity}}
                    </p>
                  <!--  .........END AuctionMatchedWithCompany...........-->

                  <!--  .........Start MembershipConfirmed...........-->
                    <span class="contacts-title" v-if="msg.type=='App\\Notifications\\MembershipConfirmed'"> {{msg.data.title}} </span>
                    <p v-if="msg.type=='App\\Notifications\\MembershipConfirmed'"  v-html="msg.data.message"> </p>
                  <!--  .........END MembershipConfirmed...........-->

                  <!--  .........Start MembershipConfirmed...........-->
                    <span class="contacts-title" v-if="msg.type=='App\\Notifications\\AuctionHasNewOffer'"> {{msg.data.title}} </span>
                    <p v-if="msg.type=='App\\Notifications\\AuctionHasNewOffer'"  v-html="msg.data.message"> </p>
                  <!--  .........END MembershipConfirmed...........-->

                </a>
            </div>
            <div class="panel-footer text-center">
                <!-- <a href="pages-messages.html">Show all messages</a> -->
                <a> الاشعارات </a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['unreaded','base_url'],
        data(){
          return {
            unreaded_notification: JSON.parse(this.unreaded),
            count:0,
          }
        },
        mounted() {
            this.count = this.unreaded_notification.length;
            console.log('notification vue Component mounted.');
        },
        methods:{
            mark_as_seen(row)
            {
                 $.get(this.base_url+'/Company/mark_notification_seen/'+row.id ,(r)=>{
                     if (row.type=='App\\Notifications\\AuctionMatchedWithCompany')
                     {
                        window.location.href = this.base_url+'/Company/AuctionRequest';
                     }
                 });
            }
        }//End methods
    }
</script>
