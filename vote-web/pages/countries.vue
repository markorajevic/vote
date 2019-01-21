<template>
  <section class="container d-flex align-items-center flex-column justify-content-start">
    <navigation class="mb-5"/>
    <div class="countries w-100 d-flex flex-wrap justify-content-between mt-5">
      <div
        class="country d-flex mb-4 align-items-center justify-content-center"
        v-for="(country, index) in countries"
        :key="index"
      >
        <router-link
          class="h-100 w-100 d-flex align-items-center justify-content-center position-absolute"
          :to="'country/' + country.code"
          v-if="country.voted == 0"
        >
          <img :src="'https://www.countryflags.io/'+ country.code+'/flat/64.png'">
          <span>{{country.voted}}</span>
        </router-link>
        <span class="h-100 h-100 d-flex justify-content-center align-items-center" v-else>
          <img :src="'https://www.countryflags.io/'+ country.code+'/flat/64.png'">
          
          <span>{{country.voted}}</span>
        </span>
      </div>
    </div>
  </section>
</template>

<script>
import Logo from '~/components/Logo.vue'
import api from '~/plugins/api'
import Navigation from '~/components/Navigation.vue'

export default {
  data: () => ({}),

  components: {
    Logo,
    Navigation
  },
  mounted() {},
  methods: {},

  computed: {
    countries() {
      return this.$store.getters['country/getCountries'] || []
    }
  }
}
</script>

<style lang="scss" scoped="">
@import '~/assets/scss/variables.scss';

.container {
  .countries {
    .country {
      border-radius: 5px;
      color: black;
      width: 18%;
      font-size: 2rem;
      border: 1px solid $grey;
      transition: 0.3s all;
      position: relative;
      padding: 5rem 0;
      &.disabled {
        background: $lightGrey;
        cursor: disabled;
        border: 1px solid $lightGrey;

        &:hover {
          background: $grey;
          cursor: not-allowed;
        }
      }
      span {
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 0;
        // border-top: 1px solid $grey;
        text-align: center;
        font-size: 1rem;
        padding: 0.5rem 0;
      }
      &:hover {
        border: 1px solid $lightGrey;
        cursor: pointer;
        background: $lightGrey;
      }
    }
  }
}
</style>
