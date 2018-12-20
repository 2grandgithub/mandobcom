<!-- Vue component -->
<!--  npm install vue-multiselect --save  -->
<!--  register the component vue-multiselect and use   -->
<template>
  <div >
    <input type="text" name="name" :value=" the_model ? the_model.id: null  "  >
    <label class="typo__label" > {{mylabel}}  </label>
    <multiselect v-model="the_model"  deselect-label="Can't remove this value" track-by="no" label="name" :mylabel="'no label'"
                 placeholder="Select one" :options="options" :searchable="true" :allow-empty="false" @Select="dispatchAction()" @input="dispatchAction()" @close="dispatchAction()"   >
        <template slot="singleLabel" slot-scope="{ option }"><strong> {{ option.name }}</strong>  </template>
    </multiselect>
    <pre class="language-json"><code> {{ the_model  }}</code></pre>
  </div>

</template>

<script>
  import Multiselect from 'vue-multiselect'

  // register globally
  Vue.component('multiselect', Multiselect)

  export default {
    // OR register locally
    props: {
        options: Array,
        s_onchange: Function,
        name: '',
        value: "",
        mylabel: '',
        // required: false,
        // readonly: false
    },
    components: { Multiselect },
    data () {
      return {
        the_model: null,
      }
    },
    mounted(){
        if(this.value){
           // this.the_model = this.options.find(obj=>obj.id == this.value);
        }
    },
    watch: {
      value(val){
          this.the_model = this.options.find(obj=>obj.id == val);
      },
    },//End watch
    methods:{
      dispatchAction(actionName, id)
      {
           // this.$emit('s_change');
      }
    }
  }//end all
</script>

<!-- New step!  Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<!-- custom css -->
<style>

</style>


<!-- how to use it -->
<!--

  <vue-multiselect :value="2" deselect-label="Can't remove this value" track-by="name" :mylabel="'outer'" label=""
                   placeholder="Select one" :options="options" :searchable="true" :allow-empty="false" v-on:s_change="chh()">
  </vue-multiselect>

 -->

 <!--
 data:{
     options: [
        { name: 'Vue.js',      id:1 },
        { name: 'Rails',       id:2 },
        { name: 'Sinatra',     id:3 },
        { name: 'Laravel',     id:4 },
        { name: 'Phoenix',     id:5 }
      ],
     value: 1,
 },
 -->
