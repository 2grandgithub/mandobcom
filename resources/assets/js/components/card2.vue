<style scoped>
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,600,700,900);
body {
 background: #dce1df;
 color: #4f585e;
 font-family: 'Source Sans Pro', sans-serif;
 text-rendering: optimizeLegibility;
}
a.btn {
 background: #0096a0;
 border-radius: 4px;
 box-shadow: 0 2px 0px 0 rgba(0, 0, 0, 0.25);
 color: #ffffff;
 display: inline-block;
 padding: 6px 30px 8px;
 position: relative;
 text-decoration: none;
 transition: all 0.1s 0s ease-out;
}
.no-touch a.btn:hover {
 background: #00a2ad;
 box-shadow: 0px 8px 2px 0 rgba(0, 0, 0, 0.075);
 -webkit-transform: translateY(-2px);
         transform: translateY(-2px);
 transition: all 0.25s 0s ease-out;
}
.no-touch a.btn:active,
a.btn:active {
 background: #008a93;
 box-shadow: 0 1px 0px 0 rgba(255, 255, 255, 0.25);
 -webkit-transform: translate3d(0, 1px, 0);
         transform: translate3d(0, 1px, 0);
 transition: all 0.025s 0s ease-out;
}
div.cards {
 margin: 80px auto;
 max-width: 960px;
 text-align: center;
}
div.card {
 background: #ffffff;
 display: inline-block;
 margin: 8px;
 max-width: 300px;
 -webkit-perspective: 1000;
         perspective: 1000;
 position: relative;
 text-align: left;
 transition: all 0.3s 0s ease-in;
 z-index: 1;
}
div.card img {
 max-width: 300px;
}
div.card div.card-title {
 background: #ffffff;
 padding: 6px 15px 10px;
 position: relative;
 z-index: 0;
}
div.card div.card-title a.toggle-info {
 border-radius: 32px;
 height: 32px;
 padding: 0;
 position: absolute;
 right: 15px;
 top: 10px;
 width: 32px;
}
div.card div.card-title a.toggle-info span {
 background: #ffffff;
 display: block;
 height: 2px;
 position: absolute;
 top: 16px;
 transition: all 0.15s 0s ease-out;
 width: 12px;
}
div.card div.card-title a.toggle-info span.left {
 right: 14px;
 -webkit-transform: rotate(45deg);
         transform: rotate(45deg);
}
div.card div.card-title a.toggle-info span.right {
 left: 14px;
 -webkit-transform: rotate(-45deg);
         transform: rotate(-45deg);
}
div.card div.card-title h2 {
 font-size: 24px;
 font-weight: 700;
 letter-spacing: -0.05em;
 margin: 0;
 padding: 0;
}
div.card div.card-title h2 small {
 display: block;
 font-size: 18px;
 font-weight: 600;
 letter-spacing: -0.025em;
}
div.card div.card-description {
 padding: 0 15px 10px;
 position: relative;
 font-size: 14px;
}
div.card div.card-actions {
 box-shadow: 0 2px 0px 0 rgba(0, 0, 0, 0.075);
 padding: 10px 15px 20px;
 text-align: center;
}
div.card div.card-flap {
 background: #d9d9d9;
 position: absolute;
 width: 100%;
 -webkit-transform-origin: top;
         transform-origin: top;
 -webkit-transform: rotateX(-90deg);
         transform: rotateX(-90deg);
}
div.card div.flap1 {
 transition: all 0.3s 0.3s ease-out;
 z-index: -1;
}
div.card div.flap2 {
 transition: all 0.3s 0s ease-out;
 z-index: -2;
}
div.cards.showing div.card {
 cursor: pointer;
 opacity: 0.6;
 -webkit-transform: scale(0.88);
         transform: scale(0.88);
}
.no-touch div.cards.showing div.card:hover {
 opacity: 0.94;
 -webkit-transform: scale(0.92);
         transform: scale(0.92);
}
div.card.show {
 opacity: 1 !important;
 -webkit-transform: scale(1) !important;
         transform: scale(1) !important;
}
div.card.show div.card-title a.toggle-info {
 background: #ff6666 !important;
}
div.card.show div.card-title a.toggle-info span {
 top: 15px;
}
div.card.show div.card-title a.toggle-info span.left {
 right: 10px;
}
div.card.show div.card-title a.toggle-info span.right {
 left: 10px;
}
div.card.show div.card-flap {
 background: #ffffff;
 -webkit-transform: rotateX(0deg);
         transform: rotateX(0deg);
}
div.card.show div.flap1 {
 transition: all 0.3s 0s ease-out;
}
div.card.show div.flap2 {
 transition: all 0.3s 0.2s ease-out;
}

</style>

<template>
  <!-- <div class="cards"> -->

<div class="card">
 <img src="http://s4c.cymru/temp/wave1.jpg">
 <div class="card-title">
   <a href="#" class="toggle-info btn">
     <span class="left"></span>
     <span class="right"></span>
   </a>
   <h2>
       Card title
       <small> <slot name="title"> ff </slot> </small>

   </h2>
 </div>
 <div class="card-flap flap1">
   <div class="card-description">
     This grid is an attempt to make something nice that works on touch devices. Ignoring hover states when they're not available etc.
   </div>
   <div class="card-flap flap2">
     <div class="card-actions">
       <a href="#" class="btn">Read more</a>
     </div>
   </div>
 </div>
</div>


<!-- </div> -->

</template>

<script>

    export default {
        mounted() {


            $(document).ready(function(){
        var zindex = 10;

        $("div.card").click(function(e){
          e.preventDefault();

          var isShowing = false;

          if ($(this).hasClass("show")) {
            isShowing = true
          }

          if ($("div.cards").hasClass("showing")) {
            // a card is already in view
            $("div.card.show")
              .removeClass("show");

            if (isShowing) {
              // this card was showing - reset the grid
              $("div.cards")
                .removeClass("showing");
            } else {
              // this card isn't showing - get in with it
              $(this)
                .css({zIndex: zindex})
                .addClass("show");

            }

            zindex++;

          } else {
            // no cards in view
            $("div.cards")
              .addClass("showing");
            $(this)
              .css({zIndex:zindex})
              .addClass("show");

            zindex++;
          }

        });
      });

        }//End mounted
    }
</script>
