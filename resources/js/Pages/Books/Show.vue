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
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import Basic from '@/Components/Buttons/Basic.vue'
import InfoItem from '@/Components/Partial/InfoItem.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Back from '@/Components/Buttons/Back.vue'
import { formatDate } from '@/helpers/helpers'
import { Head } from '@inertiajs/inertia-vue3'
import { computed } from 'vue';

let props = defineProps({
   book: {
      type: Object,
   },
})

let canLoan = computed(() => {
   return props.book.data.available >= 1 
})

</script>