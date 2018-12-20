

@component('components.panel_default_with_blank')
    @slot('active') test @endslot
    @slot('page_title') test  @endslot
    @slot('panel_title') test @endslot

    @slot('body')

        <div id="myVue">

            <!-- - - - - - -End paginate- - - - - - - -->
            <br>
            <!-- - - - - - -START spinner- - - - - - - -->
            <spinner2 v-if="show_spinner"></spinner2>
            <!-- - - - - - -End spinner- - - - - - - -->


            {{-- <div>
              <label class="typo__label">Single select</label>
              <multiselect v-model="value" :options="options" :searchable="true" :close-on-select="true" :show-labels="false" placeholder="Pick a value"></multiselect>

            </div> --}}

            {{-- <div v-for="l in list" >
              <input type="text" name="" value="" v-model="l.id"> @{{l.id}}
              <label class="typo__label">Single select / dropdown</label>
              <multiselect v-model="l"  deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one" :options="options" :searchable="true" :allow-empty="false">
                <template slot="singleLabel" slot-scope="{ option }"><strong>@{{ option.name }}</strong> is written in<strong>  @{{ option.language }}</strong></template>
              </multiselect>
              <pre class="language-json"><code>@{{ value  }}</code></pre>
            </div> --}}

            <vue-multiselect :value="2" deselect-label="Can't remove this value" track-by="name" :mylabel="'outer'" label="" :input="upp()" :name="'goo'"
                             placeholder="Select one" :options="options" :searchable="true" :allow-empty="false" v-on:s_change="chh()">
            </vue-multiselect>

         </div><!--End myVue-->

    @endslot

    @slot('script')

      {{-- <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css"> --}}

        <script>
            var delete_api = '{{url('Item/delete')}}';
            var get_list = '{{url('Item/list')}}';
            var showORhide_api = '{{url('Item/showORhide')}}';
            let accaptanceByAdmin_api = '{{url('Item/accaptance_by_admin')}}';
        </script>
        <script src="{{asset('js/test.js')}}"> </script>
    @endslot

@endcomponent
