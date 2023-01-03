<template>

   <Head title="Authors" />

   <AuthenticatedLayout>
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Authors</h2>
            <Alternative :url="route('authors.create')">New Author</Alternative>
         </div>
      </template>

      <div>
         <DataListLayout :footer="authors.last_page > 1">
            <template #header>
               <div>
                  <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                     class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                     type="button">
                     <svg class="mr-2 w-4 h-4 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                           clip-rule="evenodd"></path>
                     </svg>
                     Last 30 days
                     <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                     </svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="dropdownRadio"
                     class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                     data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                     style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                     <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownRadioButton">
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input id="filter-radio-example-1" type="radio" value="" name="filter-radio"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="filter-radio-example-1"
                                 class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                 day</label>
                           </div>
                        </li>
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="filter-radio-example-2"
                                 class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                 7
                                 days</label>
                           </div>
                        </li>
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input id="filter-radio-example-3" type="radio" value="" name="filter-radio"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="filter-radio-example-3"
                                 class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                 30
                                 days</label>
                           </div>
                        </li>
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input id="filter-radio-example-4" type="radio" value="" name="filter-radio"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="filter-radio-example-4"
                                 class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                 month</label>
                           </div>
                        </li>
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input id="filter-radio-example-5" type="radio" value="" name="filter-radio"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="filter-radio-example-5"
                                 class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                 year</label>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <label for="table-search" class="sr-only">Search</label>
               <div class="relative">
                  <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                     <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                           clip-rule="evenodd"></path>
                     </svg>
                  </div>
                  <input type="text" v-model="search" id="table-search"
                     class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="Search for authors">
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
                           First Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Last Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Created At
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Action
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="author in authors.data" :key="author.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                           {{ author.id }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ author.first_name }}
                        </th>
                        <td class="py-4 px-6">
                           {{ author.last_name }}
                        </td>
                        <td class="py-4 px-6">
                           {{ author.created_at }}
                        </td>
                        <td class="py-4 px-6">
                           <Link :href="route('authors.edit', author.id)"
                              class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                           <Link :href="route('authors.destroy', author.id)" method="delete" as="button"
                              class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                           </Link>
                        </td>
                     </tr>
                     <tr v-if="authors.data.length <= 0">
                        <td class="py-9 text-xl bg-white text-center font-bold" colspan="5">There is no author yet</td>
                     </tr>
                  </tbody>
               </table>
            </template>
            <template #footer>
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ authors.from }} to {{ authors.to }} in total {{ authors.total }}
                     items</p>
               </div>
               <Pagination v-if="authors && mobile" :mobile="mobile" :links="authors"></Pagination>
               <Pagination v-if="authors && !mobile" :mobile="mobile" :links="authors.links"></Pagination>
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
import { ref, watch } from 'vue';
import Alternative from '@/Components/Buttons/Alternative.vue'
import { Link } from '@inertiajs/inertia-vue3'
import DataListLayout from '@/Layouts/DataListLayout.vue';

let props = defineProps({
   authors: Object,
   filters: Object,
});

const mobile = ref(isMobile());

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
   Inertia.get('/authors', { search: value }, { preserveState: true, replace: true });
}, 300));

</script>