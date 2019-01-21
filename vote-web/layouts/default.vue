<template>
  <div>
    <nuxt/>
  </div>
</template>

<script>
import Navigation from '~/components/Navigation.vue'

export default {
  name: 'basic-comp',

  data: () => ({}),

  props: ['model'],

  mixins: [],

  watch: {},

  mounted() {
    if (this.countries.length < 1) {
      this.$store.dispatch('country/LOAD_COUNTRIES')
      this.$store.dispatch('country/LOAD_RESULTS')
    }
  },

  methods: {},

  computed: {
    countries() {
      return this.$store.getters['country/getCountries'] || []
    }
  },

  components: {
    Navigation
  }
}
</script>

<style lang="scss" scoped="">
@import '~/assets/scss/variables.scss';

.basic-comp {
}
</style>