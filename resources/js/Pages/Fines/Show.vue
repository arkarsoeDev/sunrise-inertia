<template>
   <AuthenticatedLayout>

      <Head title="Create New Fine" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Fine</h2>
            <Back :url="route('fines.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Fine Information</h2>
            </header>

            <div class="space-y-6 my-6 max-w-md">
               <InfoItem label="Id" :value="fine.data.id"></InfoItem>
               <InfoItem label="Book Id" :value="fine.data.loan_id"></InfoItem>
               <InfoItem label="Member Id" :value="fine.data.member_id"></InfoItem>
               <InfoItem label="Paid" :value="fine.data.paid ? true : false"></InfoItem>
               <InfoItem label="Fine Date" :value="formatDate(fine.data.fine_date)"></InfoItem>
               <InfoItem label="Fine Amount" :value="fine.data.fine_amount"></InfoItem>
            </div>
         </div>
         <Basic v-if="!fine.data.paid" :url="route('fine-payments.create', { 'member_id': fine.data.member_id, 'fine_id': fine.data.id })">
            Payment
         </Basic>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import Basic from '@/Components/Buttons/Basic.vue'
import InfoItem from '@/Components/Partial/InfoItem.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { formatDate } from '@/helpers/helpers'
import Back from '@/Components/Buttons/Back.vue'

let props = defineProps({
   fine: Object
})
</script>