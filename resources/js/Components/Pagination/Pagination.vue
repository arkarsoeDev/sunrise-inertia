<template>
   <nav aria-label="Page navigation example">
      <ul class="flex justify-between" v-if="mobile">
         <li>
            <PaginationItem class="rounded-lg"
               :link="{ active: false, url: links.prev_page_url, label: 'Prev' }">
            </PaginationItem>
         </li>
         <li>
            <PaginationItem class="rounded-lg"
               :link="{ active: false, url: links.next_page_url, label: 'Next' }">
            </PaginationItem>
         </li>
      </ul>
      <ul class="inline-flex -space-x-px" v-else>
         <li v-for="(link, index) in links" :key="index">
            <PaginationItem :prev="index === 0" :next="index === links.length - 1"
               :link="link">
            </PaginationItem>
         </li>
      </ul>
   </nav>
</template>

<script setup>
import PaginationItem from '@/Components/Pagination/PaginationItem.vue';

const { links, mobile } = defineProps(['links', 'mobile'])
</script>