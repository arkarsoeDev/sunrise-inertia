<template>

   <Head title="Loan Counts" />

   <AuthenticatedLayout>
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Loan Counts</h2>
            <Back>Back</Back>
         </div>
      </template>
      <div>
         <DataListLayout :footer="loansCount.meta.last_page > 1">
            <template #header>
               <div class="flex space-x-3 items-center justify-end w-full">
                  <Input id="from" name="from" type="date" class="flex items-center space-x-3" v-model="from"
                     placeholder="From Date">From</Input>
                  <Input id="to" name="to" type="date" class="flex items-center space-x-3" v-model="to"
                     placeholder="To Date">To</Input>
                  <Link as="button" @click="search"
                     class="px-3 py-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-300 hover:bg-gray-50 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                  Search
                  </Link>
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
                           Total
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Date
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="(count, index) in loansCount.data" :key="index"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                           {{ index }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ count.total }}
                        </th>
                        <td class="py-4 px-6">
                           {{ formatDate(count.date) }}
                        </td>
                     </tr>
                     <tr v-if="loansCount.data.length <= 0">
                        <td class="py-9 text-xl bg-white text-center font-bold" colspan="7">There is no loan yet</td>
                     </tr>
                  </tbody>
               </table>
            </template>
            <template #footer>
               <div v-if="!mobile" class="font-semibold">
                  <p>Showing from {{ loansCount.meta.from }} to {{ loansCount.meta.to }} in total {{
                     loansCount.meta.total
                  }}
                     items</p>
               </div>
               <Pagination v-if="loansCount && mobile" :mobile="mobile" :links="loansCount.links"></Pagination>
               <Pagination v-if="loansCount && !mobile" :mobile="mobile" :links="loansCount.meta.links"></Pagination>
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
import Input from '@/Components/Form/Input.vue'
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import DataListLayout from '@/Layouts/DataListLayout.vue';
import { formatDate, timestampForLara } from "@/helpers/helpers";
import Back from '@/Components/Buttons/Back.vue';

let props = defineProps({
   loansCount: Object,
   filters: Array,
});


const from = ref();
const to = ref();

const mobile = ref(isMobile());

const search = function () {
   Inertia.get('/daily-loan-count', {
      from: from.value ? timestampForLara(new Date(`${from.value}`)) : null
      , to: to.value ? timestampForLara(new Date(`${to.value}`)) : null
   }, { preserveState: true, replace: true });
}

</script>