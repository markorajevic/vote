<template>
  <section class="container d-flex align-items-center flex-column justify-content-center mt-4">
    <logo class="mb-5"/>
    <div class="links d-flex">
      <router-link
        class="link d-flex align-items-center justify-content-between mr-4"
        :to="'/results'"
      >
        <i class="fa fa-hand-stop-o mr-2"></i>
        <span>Results</span>
      </router-link>
      <router-link class="link" :to="'/countries'">
        <i class="fa fa-globe mr-2"></i>
        <span>Countries</span>
      </router-link>
    </div>
  </section>
</template>

<script>
import Logo from '~/components/Logo.vue'

export default {
  components: {
    Logo
  }
}
</script>

<style lang="scss" scoped="">
@import '~/assets/scss/variables.scss';

.container {
  .links {
    .link {
      border-radius: 5px;
      padding: 2rem 5rem;
      color: black;
      font-size: 1rem;
      border: 1px solid $grey;
      transition: 0.3s all;
      position: relative;
      span {
        // position: absolute;
        // width: 100%;
        // left: 0;
        // bottom: 0;
        // // border-top: 1px solid $grey;
        // text-align: center;
        // font-size: 1rem;
        // padding: 0.5rem 0;
      }
      &:hover,
      &.nuxt-link-active {
        text-decoration: none;
        border: 1px solid $lightGrey;
        background: $lightGrey;
      }
    }
  }
}
</style>
