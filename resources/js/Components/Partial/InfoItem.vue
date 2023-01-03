<template>
   <div>
      <div class="block mb-2 text-md font-medium dark:text-white">
         {{ label }}
      </div>
      <div
         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white disabled:bg-gray-200">
         {{ value }}
      </div>
   </div>
</template>

<script setup>
defineProps({
   label: String,
   value: {
      required: true
   }
})
</script>

<style lang="scss" scoped>

</style>