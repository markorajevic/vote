<template>
  <section class="container-fluid d-flex align-items-center flex-column justify-content-start">
    <navigation class="mb-5"/>

    <div v-if="country.voted != 1">
      <div class="countries w-100 d-flex flex-wrap justify-content-between">
        <h2 class="text-center w-100 mb-5">Hi {{country.name}}!</h2>
        <div class="row d-flex">
          <div class="col-md-6">
            <div class="d-flex flex-wrap justify-content-between">
              <div
                v-for="(vote, index) in votes"
                :key="index"
                class="vote-holder d-flex flex-column pl-3 pr-3"
              >
                <div class="flag" v-if="selected[vote]">
                  <img :src="getFlag(selected[vote].code)">
                </div>
                <span :class="{'invalid': !selected[vote] && !valid}" class="mb-5">{{vote}}</span>
                <multiselect
                  v-model="selected[vote]"
                  deselect-label="Can't remove this value"
                  track-by="name"
                  label="name"
                  placeholder="Select country"
                  :options="countries"
                  :searchable="true"
                  :allow-empty="false"
                ></multiselect>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="alert alert-danger" role="alert" v-if="!valid">
              <span class="h6">
                <strong>Oh snap!</strong> Please select all countries!
              </span>
            </div>
            <div class="d-flex mb-5">
              <div class="col-md-6 align-items-center justify-content-between d-flex">
                <router-link :to="'/countries'" class="btn btn-secondary w-100">Go back</router-link>
              </div>
              <div class="col-md-6 align-items-center justify-content-center d-flex">
                <span @click="vote" class="btn btn-primary w-100">Vote</span>
              </div>
            </div>
            <table class="table w-100" v-if="selectedVotes.length > 0">
              <thead>
                <tr>
                  <th scope="col">Flag</th>
                  <th scope="col">Name</th>
                  <th scope="col">Points</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(country, index) in selectedVotes" :key="index">
                  <td class="h6">
                    <img :src="getFlag(country.code)">
                  </td>
                  <td class="h6">{{country.name}}</td>
                  <td class="h6">{{country.points}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row"></div>
      <div class="row w-100 mt-5"></div>
    </div>
    <div v-else>
      <logo class="mt-5 mb-5 logo m-auto mb-4"/>
      <div class="countries w-100 d-flex flex-wrap justify-content-between">
        <h2 class="text-center w-100">Hi {{country.name}}! You already voted!</h2>
        <router-link :to="'/countries'" class="btn btn-primary w-100 mt-4">Go back</router-link>
      </div>
    </div>
  </section>
</template>

<script>
import Logo from '~/components/Logo.vue'
import api from '~/plugins/api'
import Multiselect from 'vue-multiselect'
import Navigation from '~/components/Navigation.vue'

export default {
  data: () => ({
    country: {},
    value: '',
    valid: true,
    votes: [1, 2, 3, 4, 5, 6, 7, 8, 10, 12],
    selected: {}
  }),

  components: {
    Logo,
    Multiselect,
    Navigation
  },
  mounted() {
    this.getCountry()
  },
  computed: {
    countries() {
      let self = this
      let countries = this.$store.getters['country/getCountries'] || []
      countries = _.filter(countries, country => {
        if (country.code == self.country.code) {
          return false
        }
        return _.isEmpty(self.selected)
          ? true
          : !_.includes(self.selected, country)
      })
      return countries
    },
    selectedVotes() {
      let items = []
      _.each(this.selected, (item, key) => {
        item.points = +key
        items.push(item)
      })
      items = _.orderBy(items, 'points', 'desc')
      return items
    }
  },
  methods: {
    setVoted() {
      this.$store.dispatch('country/SET_VOTED', {
        id: this.country.id
      })
    },
    getFlag(code) {
      return 'https://www.countryflags.io/' + code + '/flat/32.png'
    },
    getCountry() {
      let id = this.$route.params.id
      api.getCountry(id).then(data => {
        this.country = data.data
      })
    },
    prepareData() {
      let data = []
      let self = this
      _.each(this.selected, (item, key) => {
        data.push({
          voting_country: self.country.id,
          voted_country: item.id,
          points: +key
        })
      })
      return data
    },
    vote() {
      let self = this
      let data = []
      let numOfOptions = Object.keys(this.selected).length
      if (numOfOptions != 10) {
        self.valid = false
        setTimeout(() => {
          self.valid = true
        }, 3000)
        return
      } else {
        data = this.prepareData()
        api.vote(data).then(data => {
          self.setVoted()
          self.$router.push('/countries')
        })
      }
    }
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped="">
@import '~/assets/scss/variables.scss';
@import '~bootstrap/scss/functions';
@import '~bootstrap/scss/variables';
@import '~bootstrap/scss/mixins';

.vote-holder {
  width: 32%;
  padding: 1rem 0 2rem 0;
  margin-bottom: 2rem;
  text-align: center;
  border: 1px solid $lightGrey;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  @include media-breakpoint-down(lg) {
    width: 48%;
  }
  .flag {
    position: absolute;
    right: 0;
    top: -8px;
    right: -2px;
  }
  span {
    border-radius: 50%;
    width: 3rem;
    display: block;
    height: 3rem;
    line-height: 3rem;
    background: $blue;
    color: #fff;
    &.invalid {
      background: $red;
    }
  }
}
.alert {
  position: fixed;
  top: 1rem;
  right: 1rem;
}
</style>
