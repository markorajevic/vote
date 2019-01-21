<template>
  <section class="d-flex align-items-center flex-column justify-content-center mt-4 w-100">
    <logo class="mb-5"/>
    <div class="links d-flex pl-2 pr-2">
      <router-link
        class="link d-flex align-items-center justify-content-between mr-4"
        :to="'/results'"
      >
        <i class="fa fa-hand-stop-o mr-2"></i>
        <span>Results</span>
      </router-link>
      <router-link class="link d-flex align-items-center justify-content-betwee" :to="'/countries'">
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
@import '~bootstrap/scss/functions';
@import '~bootstrap/scss/variables';
@import '~bootstrap/scss/mixins';
@import '~/assets/scss/variables.scss';

.container {
}
</style>
