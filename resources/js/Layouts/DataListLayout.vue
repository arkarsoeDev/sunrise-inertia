<template>
   <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
      <div class="flex justify-between items-center bg-white p-4">
         <slot name="header"></slot>
      </div>
      <div>
         <slot name="body"></slot>
      </div>

      <div v-if="footer" class="sm:flex sm:items-center sm:justify-between bg-white p-4">
         <slot name="footer"></slot>
      </div>
   </div>
</template>

<script setup>
defineProps(['footer'])
</script>

<style lang="scss" scoped>

</style>
