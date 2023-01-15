<template>
   <Link :href="url">
      <div
         class="relative flex flex-col justify-center min-w-[200px] min-h-[80px] break-words rounded-md   bg-white shadow bg-clip-border hover:-translate-y-3 transition-transform cursor-pointer">
         <div class="flex items-center flex-wrap -mx-3 p-4">
            <div class="w-2/3 max-w-full px-3">
               <div>
                  <p class="mb-0 font-sans font-semibold leading-normal text-md">{{ title }}</p>
                  <h5 class="mb-0 font-bold">
                     {{ count }}
                     <!-- <span class="leading-normal text-md font-weight-bolder text-lime-500">+55%</span> -->
                  </h5>
               </div>
            </div>
            <div class="max-w-full px-3 m-auto text-right">
               <slot name="icon"></slot>
            </div>
         </div>
      </div>
   </Link>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
   title: {
      type: String,
      required: true,
   },
   count: {
      type: [String, Number],
      required: true,
   },
   url: {
      required: true,
   }
})

</script>