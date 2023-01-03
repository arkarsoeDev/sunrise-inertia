<template>
   <AuthenticatedLayout>

      <Head title="Edit Loan" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Loan Info</h2>
            <Back :url="route('loans.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6 border-b border-gray-200">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Loan Information</h2>
            </header>

            <div class="space-y-6 my-6 max-w-md">
               <InfoItem label="Id" :value="loan.data.id"></InfoItem>
               <InfoItem label="Book Id" :value="loan.data.book_id"></InfoItem>
               <InfoItem label="Member Id" :value="loan.data.member_id"></InfoItem>
               <InfoItem label="Loan Date" :value="formatDate(loan.data.loan_date)"></InfoItem>
               <InfoItem label="Return Date" :value="formatDate(loan.data.return_date)"></InfoItem>
               <InfoItem label="Returned Date"
                  :value="loan.data.returned_date ? formatDate(loan.data.returned_date) : 'not return yet'"></InfoItem>
            </div>

         </div>
         <template v-if="loan.data.fine">
            <div class="mb-6">
               <header>
                  <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Fine Information For Current Loan
                  </h2>
               </header>
               <div class="space-y-6 my-6 max-w-md">
                  <InfoItem label="Id" :value="loan.data.fine.id"></InfoItem>
                  <InfoItem label="Fine Amount" :value="loan.data.fine.fine_amount"></InfoItem>
                  <InfoItem label="Paid" :value="loan.data.fine.paid ? true : false"></InfoItem>
                  <InfoItem label="Fine Date" :value="formatDate(loan.data.fine.fine_date)"></InfoItem>
               </div>
            </div>
         </template>
         <Basic v-if="!fined && overdue && !returned"
            :url="route('fines.create', { 'member_id': loan.data.member_id, 'loan_id': loan.data.id })">Fine
         </Basic>
         <Basic v-if="canReturn" method="post"
            :url="route('returns.store', { 'book_id': loan.data.book_id, 'loan_id': loan.data.id, 'returned_date': currentDate })">
            Return Book
         </Basic>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Back from '@/Components/Buttons/Back.vue'
import Basic from '@/Components/Buttons/Basic.vue'
import InfoItem from '@/Components/Partial/InfoItem.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { computed } from "vue";
import { formatDate, timestampForLara } from "@/helpers/helpers";

let currentDate = timestampForLara(new Date());

let props = defineProps({
   loan: {
      type: Object,
      default: {}
   }
})

let overdue = computed(() => {
   return props.loan.data.return_date < currentDate
})

let returned = computed(() => {
   return props.loan.data.returned_date ? true : false
})

let fined = computed(() => {
   return props.loan.data.fine ? true: false
})

let canReturn = computed(() => {
   return (!overdue.value && !returned.value) || (overdue.value && fined.value && !returned.value)
})

</script>