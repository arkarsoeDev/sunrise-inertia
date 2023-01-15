<template>
   <AuthenticatedLayout>

      <Head title="Create New Fine Payment" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Fine Payment</h2>
            <Back>Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Fine Payment Information</h2>

            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="fine_id" name="fine_id" type="text" class="mb-6" v-model="form.fine_id" placeholder="Fine Id"
               :errorMessage="form.errors.fine_id">Fine Id</Input>
            <Input id="member_id" name="member_id" type="text" class="mb-6" v-model="form.member_id"
               placeholder="Member Id" :errorMessage="form.errors.member_id">Member Id</Input>
            <Input id="payment_date" name="payment_date" type="date" class="mb-6" v-model="form.payment_date"
               placeholder="Payment Date" :errorMessage="form.errors.payment_date">Payment Date</Input>
            <Input id="payment_amount" name="payment_amount" type="text" class="mb-6"
               v-model="form.payment_amount" placeholder="Payment Amount" :errorMessage="form.errors.payment_amount">Payment Amount</Input>

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

let props = defineProps({
   member_id: String,
   fine_id: String,
   payment_amount: String,
})

let form = useForm({
   member_id: props.member_id ? props.member_id : '',
   fine_id: props.fine_id ? props.fine_id : '',
   payment_amount: props.payment_amount ? props.payment_amount : '',
   payment_date: '',
});

let submit = () => {
   form.transform((data) => ({
      ...data,
      payment_date: Math.floor((new Date(`${data.payment_date}`)).getTime() / 1000)
   })).post('/fine-payments');
};
</script>