<template>
   <button @click="back"
      class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-50 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
      <div class="flex">
            <ArrowLeftIcon class="w-5 h-5 mr-3"></ArrowLeftIcon>
            <slot></slot>
      </div>
   </button>
</template>

<script setup>
import { ArrowLeftIcon } from '@heroicons/vue/20/solid';

const back = function () {
   window.history.back()
}
</script>