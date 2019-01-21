<template>
  <section class="container-fluid d-flex align-items-center flex-column justify-content-start">
    <navigation class="mb-5"/>
    <div
      class="countries col-md-6 w-100 d-flex flex-wrap justify-content-between"
      v-if="results.length > 0"
    >
      <table class="table w-100">
        <thead>
          <tr>
            <th>#Place</th>
            <th>Country</th>
            <th>Name</th>
            <th>Total points</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(result, index) in results" :key="index">
            <td>{{index+1}}</td>
            <td class="h6">
              <img :src="getFlag(result.country.code)">
            </td>
            <td>{{result.country.name}}</td>
            <td>{{result.totalPoints}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <h3>Voting hasn't started yet!</h3>
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
  methods: {
    getFlag(code) {
      return 'https://www.countryflags.io/' + code + '/flat/16.png'
    }
  },

  computed: {
    countries() {
      return this.$store.getters['country/getCountries'] || []
    },
    results() {
      return this.$store.getters['country/getResults'] || []
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
      padding: 4rem 0;
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
  .table {
    width: 100%;
    overflow: scroll;
  }
}
</style>
