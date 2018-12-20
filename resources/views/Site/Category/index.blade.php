@extends('Site.layout.blank')


@section('content')

<section id="Category_list" >

  <br>
  <!-- Content -->

      <h2> <center>  @lang('page.'.ucfirst($type).' categories') </center> </h2>
      <br>
  <section class="top-items padding-bottom-60">
    <ul class="row">

        <li class="col-md-3 cats" v-for="Category in Categories">
            <a :href="item_url(Category.value)">
            <img class="img-responsive" :src="Category.logo" > <!-- style="width:386px;height:400px" -->
             <h3> @{{Category.label}} </h3>
            </a>
        </li>

    </ul>
  </section>


  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>
        let get_type = '{{$type}}'; //item , offer

        let root = new Vue({
            el: '#root',
            data:{
                loading: true,
                Categories: Categories_and_subCategories_list,
                type: get_type //item , offer
            },
            mounted(){
                this.loading = false;
               console.log('mounted');
            },
            methods:{
              item_url(id){
                 if(this.type == 'item')
                    return base_url+'/item/'+id;
                 if(this.type == 'offer')
                    return base_url+'/offer/'+id;
              }
            }
        });

    </script>
    {{-- <script src="{{asset('js_site/Item.js')}}"> </script> --}}
@endsection
