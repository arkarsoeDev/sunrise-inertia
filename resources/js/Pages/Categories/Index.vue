<template>

   <Head title="Categories" />

   <AuthenticatedLayout>
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>
            <Alternative :url="route('categories.create')">New Category</Alternative>
         </div>
      </template>

      <div>
         <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <div class="flex justify-between items-center bg-white p-4">
               <div class="ml-auto">
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
                        placeholder="Search for category">
                  </div>
               </div>
            </div>
            <!-- table -->
            <table class="w-full text-md text-left text-gray-500 border-b dark:text-gray-400">
               <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                     <th scope="col" class="py-3 px-6">
                        #
                     </th>
                     <th scope="col" class="py-3 px-6">
                        Title
                     </th>
                     <th scope="col" class="py-3 px-6">
                        Slug
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
                  <tr v-for="category in categories.data" :key="category.id"
                     class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                     <td class="py-4 px-6">
                        {{ category.id }}
                     </td>
                     <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ category.title }}
                     </th>
                     <td class="py-4 px-6">
                        {{ category.slug }}
                     </td>
                     <td class="py-4 px-6">
                        {{ category.created_at }}
                     </td>
                     <td class="py-4 px-6">
                        <Link :href="route('categories.edit', category.id)"
                           class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                        <Link :href="route('categories.destroy', category.id)" method="delete" as="button"
                           class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                        </Link>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div v-if="categories.last_page_url > 1" class="sm:flex sm:items-center sm:justify-between bg-white p-4">
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ categories.from }} to {{ categories.to }} in total {{ categories.total }}
                     items</p>
               </div>
               <Pagination v-if="categories && mobile" :mobile="mobile" :links="categories"></Pagination>
               <Pagination v-if="categories && !mobile" :mobile="mobile" :links="categories.links"></Pagination>
            </div>
         </div>
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

let props = defineProps({
   categories: Object,
   filters: Object,
});

const mobile = ref(isMobile());

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
   Inertia.get('/categories', { search: value }, { preserveState: true, replace: true });
}, 300));

</script>