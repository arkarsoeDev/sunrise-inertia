<template>
   <AuthenticatedLayout>

      <Head title="Create New reservation" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Reservation</h2>
            <Back :url="route('reservations.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Reservation Information</h2>

            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="book_id" name="book_id" type="text" class="mb-6" v-model="form.book_id" placeholder="Loan Id"
               :errorMessage="form.errors.book_id">Book Id</Input>
            <Input id="member_id" name="member_id" type="text" class="mb-6" v-model="form.member_id"
               placeholder="Member Id" :errorMessage="form.errors.member_id">Member Id</Input>
            <Input id="reservation_date" name="reservation_date" type="date" class="mb-6" v-model="form.reservation_date"
               placeholder="reservation Date" :errorMessage="form.errors.reservation_date">Reservation Date</Input>

            <div class="w-4/12">
               <Submit :submitting="form.processing">
                  <template v-slot:icon>
                     <PlusIcon class="h-5 w-5 text-white group-hover:text-gray-200 group-disabled:text-white"
                        aria-hidden="true" />
                  </template>
                  Create
               </Submit>
            </div>
         </form>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PlusIcon } from '@heroicons/vue/20/solid';
import Input from '@/Components/Form/Input.vue'
import Submit from '@/Components/Form/Submit.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Back from '@/Components/Buttons/Back.vue'

let form = useForm({
   member_id: '',
   book_id: '',
   reservation_date: '',
});

let submit = () => {
   form.transform((data) => ({
      ...data,
      reservation_date: Math.floor((new Date(`${data.reservation_date}`)).getTime() / 1000)
   })).post('/reservations');
};
</script>