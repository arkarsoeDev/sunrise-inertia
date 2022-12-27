<template>
   <Link :href="link.url ? link.url : null" :disabled="!link.url"
      class="flex items-center py-3 px-3 ml-0 leading-tight border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-800 dark:hover:text-white"
      :class="{
         'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:text-white': link.active
         , 'text-gray-500 bg-white hover:bg-gray-100': !link.active,
         'cursor-not-allowed bg-gray-100 text-gray-300': link.url === null,
         'hover:text-gray-700': link.url !== null,
         'rounded-l-lg': prev,
         'rounded-r-lg': next
      }">
      <span v-if="prev">
         Prev
      </span>
      <span v-else-if="next">
         Next
      </span>
      <span v-else v-text="link.label"></span>
   </Link>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps(['prev', 'next', 'link'])
</script>