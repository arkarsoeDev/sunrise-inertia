<template>

   <Head title="Most loan books" />

   <AuthenticatedLayout>
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Most loan book</h2>
            <Back>Back</Back>
         </div>
      </template>
      <div>
         <DataListLayout :footer="books.meta.last_page > 1">
            <template #header>
            <div class="ml-auto">
               <label for="table-search" class="sr-only">Search</label>
               <div class="relative">
                  <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                     <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                           clip-rule="evenodd"></path>
                     </svg>
                  </div>
                  <input type="text" v-model="search" id="table-search"
                     class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="Search for loans">
               </div>
            </div>
            </template>
            <template #body>
               <table class="w-full text-md text-left text-gray-500 border-b dark:text-gray-400">
                  <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                     <tr>
                        <th scope="col" class="py-3 px-6">
                           #
                        </th>
                        <th scope="col" class="py-3 px-6">
                           book
                        </th>
                        <th scope="col" class="py-3 px-6">
                           total loans
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="book in books.data" :key="book.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                           {{ book.id }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ book.title }}
                        </th>
                        <td class="py-4 px-6">
                           {{ book.total_loans }}
                        </td>
                     </tr>
                     <tr v-if="books.data.length <= 0">
                        <td class="py-9 text-xl bg-white text-center font-bold" colspan="3">There is no loan yet</td>
                     </tr>
                  </tbody>
               </table>
            </template>
            <template #footer>
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ books.meta.from }} to {{ books.meta.to }} in total {{
                     books.meta.total
                  }}
                     items</p>
               </div>
               <Pagination v-if="books && mobile" :mobile="mobile" :links="books.links"></Pagination>
               <Pagination v-if="books && !mobile" :mobile="mobile" :links="books.meta.links"></Pagination>
            </template>
         </DataListLayout>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination/Pagination.vue';
import { isMobile } from '@/helpers/helpers';
import { Inertia } from '@inertiajs/inertia';
import debounce from "lodash/debounce";
import Input from '@/Components/Form/Input.vue'
import { ref, watch } from 'vue';
import DataListLayout from '@/Layouts/DataListLayout.vue';
import Back from '@/Components/Buttons/Back.vue';

let props = defineProps({
   books: Object,
   filters: Object,
});

const mobile = ref(isMobile());

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
   Inertia.get('/most-loan-books', { search: value }, { preserveState: true, replace: true });
}, 300));

</script>