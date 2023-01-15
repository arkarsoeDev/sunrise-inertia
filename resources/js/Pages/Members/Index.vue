<template>

   <Head title="Members" />

   <AuthenticatedLayout>
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Members</h2>
            <Alternative :url="route('members.create')">New Member</Alternative>
         </div>
      </template>

      <div>
         <DataListLayout :footer="members.meta.last_page > 1">
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
                        placeholder="Search for members">
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
                     <tr v-for="member in members.data" :key="member.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                           {{ member.id }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ member.first_name }}
                        </th>
                        <td class="py-4 px-6">
                           {{ member.last_name }}
                        </td>
                        <td class="py-4 px-6">
                           {{ formatDate(member.created_at) }}
                        </td>
                        <td class="py-4 px-6">
                           <Link :href="route('members.edit', member.id)"
                              class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                           <Link :href="route('members.destroy', member.id)" method="delete" as="button"
                              class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                           </Link>
                        </td>
                     </tr>
                     <tr v-if="members.data.length <= 0">
                        <td class="py-9 text-xl bg-white text-center font-bold" colspan="5">There is no member yet</td>
                     </tr>
                  </tbody>
               </table>
            </template>
            <template #footer>
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ members.meta.from }} to {{ members.meta.to }} in total {{ members.meta.total }}
                     items</p>
               </div>
               <Pagination v-if="members && mobile" :mobile="mobile" :links="members"></Pagination>
               <Pagination v-if="members && !mobile" :mobile="mobile" :links="members.meta.links"></Pagination>
            </template>
         </DataListLayout>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataListLayout from '@/Layouts/DataListLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination/Pagination.vue';
import { isMobile } from '@/helpers/helpers';
import { Inertia } from '@inertiajs/inertia';
import debounce from "lodash/debounce";
import { ref, watch } from 'vue';
import Alternative from '@/Components/Buttons/Alternative.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { formatDate } from '@/helpers/helpers'

let props = defineProps({
   members: Object,
   filters: Object,
});

const mobile = ref(isMobile());

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
   Inertia.get('/members', { search: value }, { preserveState: true, replace: true });
}, 300));

</script>