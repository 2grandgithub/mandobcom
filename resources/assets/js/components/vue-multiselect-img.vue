<!-- Vue component -->
<template>

  <div>
    <input type="hidden" name="name" :value=" the_model ? the_model.id: null  "  >
    <label class="typo__label">{{mylabel}}</label>
    <multiselect v-model="value" placeholder="Fav No Man’s Sky path" label="title" track-by="title" :options="options" :option-height="104" :custom-label="customLabel" :show-labels="false">
      <template slot="singleLabel" slot-scope="props"><img class="option__image" :src="props.option.img" alt="No Man’s Sky"><span class="option__desc"><span class="option__title">{{ props.option.title }}</span></span></template>
      <template slot="option" slot-scope="props"><img class="option__image" :src="props.option.img" alt="No Man’s Sky">
        <div class="option__desc"><span class="option__title">{{ props.option.title }}</span><span class="option__small">{{ props.option.desc }}</span></div>
      </template>
    </multiselect>
    <pre class="language-json"><code>{{ value }}</code></pre>
  </div>

</template>

<script>
  import Multiselect from 'vue-multiselect'

  // register globally
  Vue.component('multiselect', Multiselect)

  export default {
    // OR register locally
    props: ['options','name','value','mylabel'],
    components: { Multiselect },
    data () {
      return {
        the_model: null,
      }
    },
    mounted(){
        if(this.value){
           this.the_model = this.options.find(obj=>obj.id == this.value);
        }
    },
    watch: {
      value(val){
          this.the_model = this.options.find(obj=>obj.id == val);
      }
    }//End watch
  }//end all
</script>

<!-- New step!  Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>

</style>
