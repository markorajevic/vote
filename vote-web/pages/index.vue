<template>
  <section class="container d-flex align-items-center flex-column justify-content-center">
    <navigation class="mb-5"/>
  </section>
</template>

<script>
import Navigation from '~/components/Navigation.vue'

export default {
  components: {
    Navigation
  }
}
</script>

<style lang="scss" scoped="">
@import '~/assets/scss/variables.scss';

.container {
  min-height: 100vh;
  .links {
    .link {
      border-radius: 5px;
      padding: 5rem;
      color: black;
      font-size: 2rem;
      border: 1px solid $grey;
      transition: 0.3s all;
      position: relative;
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

        background: $lightGrey;
      }
    }
  }
}
</style>
