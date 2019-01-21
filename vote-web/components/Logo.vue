<template>
  <div>
    <logo ref="logic" id="my-svg" class="logo"/>
  </div>
</template>

<script>
import Logo from '@/assets/svg/logo.svg'
import Vivus from 'vivus'

export default {
  components: {
    Logo
  },
  mounted() {}
}
</script>

<style>
.logo {
  width: 100%;
}
</style>
