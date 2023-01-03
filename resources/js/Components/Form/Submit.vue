<template>
   <div class="relative">
      <button :disabled="submitting" type="submit"
         class="group inline-block px-7 py-3 rounded-lg bg-indigo-900 text-white select-none font-medium text-sm leading-snug uppercase shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out w-full disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-200 disabled:text-gray-400 disabled:opacity-70 disabled:hover:shadow-md">
         <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <slot name="icon"></slot>
         </span>
         <slot class="ml-2">Submit</slot>
      </button>
      <template v-if="submitting">
         <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
            <Loading class="text-gray-900 w-6 h-6 cursor-not-allowed"></Loading>
         </div>
      </template>
   </div>
</template>

<script setup>
import Loading from '@/components/Loading.vue';

defineProps({
   submitting: {
      type: Boolean,
      default: false,
   }
}) 
</script>