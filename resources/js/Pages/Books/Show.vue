<template>
   <AuthenticatedLayout>

      <Head title="Edit Book" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Book</h2>
            <Back :url="route('books.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Book Information</h2>
            </header>

            <div class="space-y-6 my-6 max-w-md">
               <InfoItem label="Id" :value="book.data.id"></InfoItem>
               <InfoItem label="Publication Date" :value="formatDate(book.data.publication_date)"></InfoItem>
               <InfoItem label="Copies Owned" :value="book.data.copies_owned"></InfoItem>
               <InfoItem label="Available" :value="book.data.available"></InfoItem>
               <InfoItem label="Created At" :value="formatDate(book.data.created_at)"></InfoItem>
            </div>
         </div>

         <Basic v-if="canLoan" :url="route('loans.create', { 'book_id': book.data.id })">
            Loan
         </Basic>
         <Basic v-if="book.data.available <= 0"
            :url="route('reservations.create', { 'member_id': book.data.member_id, 'book_id': book.data.id })">
            Reservation
         </Basic>
      </div>

      <div class="mt-6">
         <DataListLayout :footer="reservations.meta.last_page > 1">
            <template #header>
               <div class="mb-3">
                     <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Reservation list for current book</h2>
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
                  <input type="text" v-model="reservationSearch" id="table-search"
                     class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="Search for reservations">
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
                           Book id
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Member id
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Active
                        </th>
                        <th scope="col" class="py-3 px-6">
                           reservation date
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Action
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="reservation in reservations.data" :key="reservation.id" :class="{
                              'bg-yellow-100': reservation.active && !reservation.book_available >= 1,
                              'bg-green-100': reservation.book_available >= 1,
                           }"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                           {{ reservation.id }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ reservation.book_id }}
                        </th>
                        <td class="py-4 px-6">
                           {{ reservation.member_id }}
                        </td>
                        <td class="py-4 px-6">
                           {{ reservation.active ? true : false }}
                        </td>
                        <td class="py-4 px-6">
                           {{ formatDate(reservation.reservation_date) }}
                        </td>
                        <td class="py-4 px-6">
                           <Link :href="route('reservations.edit', reservation.id)"
                              class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                           <Link :href="route('reservations.destroy', reservation.id)" method="delete" as="button"
                              class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                           </Link>
                        </td>
                     </tr>
                     <tr v-if="reservations.data.length <= 0">
                        <td class="py-9 text-xl bg-white text-center font-bold" colspan="6">There is no reservation yet
                        </td>
                     </tr>
                  </tbody>
               </table>
            </template>
            <template #footer>
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ reservations.meta.from }} to {{ reservations.meta.to }} in total {{
                     reservations.meta.total
                     }}
                     items</p>
               </div>
               <Pagination v-if="reservations && mobile" :mobile="mobile" :links="reservations.links"></Pagination>
               <Pagination v-if="reservations && !mobile" :mobile="mobile" :links="reservations.meta.links">
               </Pagination>
            </template>
         </DataListLayout>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import DataListLayout from '@/Layouts/DataListLayout.vue';
import Pagination from '@/Components/Pagination/Pagination.vue';
import Basic from '@/Components/Buttons/Basic.vue'
import InfoItem from '@/Components/Partial/InfoItem.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Back from '@/Components/Buttons/Back.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { formatDate } from '@/helpers/helpers'
import { Head } from '@inertiajs/inertia-vue3'
import { ref, watch, computed } from 'vue';
import debounce from "lodash/debounce";
import { Inertia } from '@inertiajs/inertia';

let props = defineProps({
   book: {
      type: Object,
   },
   reservations: Object,
   filters: Object,
})
console.log(props.reservations.data.length)
let canLoan = computed(() => {
   return props.book.data.available >= 1 && props.reservations.data.length < props.book.data.available
})

let reservationSearch = ref(props.filters.reservation_search);

watch(reservationSearch, debounce(function (value) {
   Inertia.get(`/books/${props.book.data.id}`, { reservation_search: value }, { preserveState: true, replace: true });
}, 300));

</script>