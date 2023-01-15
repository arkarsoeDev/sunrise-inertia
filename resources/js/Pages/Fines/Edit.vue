<template>
   <AuthenticatedLayout>

      <Head title="Edit Fine" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Fine</h2>
            <Back>Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Fine Information</h2>
            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="loan_id" name="loan_id" type="text" class="mb-6" v-model="form.loan_id" placeholder="Loan Id"
               :errorMessage="form.errors.loan_id">Loan Id</Input>
            <Input id="member_id" name="member_id" type="text" class="mb-6" v-model="form.member_id"
               placeholder="Member Id" :errorMessage="form.errors.member_id">Member Id</Input>
            <Input type="text" :disabled="true" class="mb-6" v-model="oldDate">Old Fine Date</Input>
            <Input id="fine_date" name="fine_date" type="date" class="mb-6" v-model="form.fine_date"
               placeholder="fine Date" :errorMessage="form.errors.fine_date">New Fine Date</Input>
            <Input id="fine_amount" name="fine_amount" type="text" class="mb-6" v-model="form.fine_amount"
               placeholder="Fine Amount" :errorMessage="form.errors.fine_amount">Fine Amount</Input>

            <div class="inline-block">
               <Basic :url="route('fine-payments.create', { 'member_id': fine.data.member_id, 'fine_id': fine.data.id,'payment_amount' : fine.data.fine_amount })">Payment
               </Basic>
            </div>
            <div class="w-4/12 inline-block">
               <Submit :submitting="form.processing">
                  <template v-slot:icon>
                     <PlusIcon class="h-5 w-5 text-white group-hover:text-gray-200 group-disabled:text-white"
                        aria-hidden="true" />
                  </template>
                  Update
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
import Back from '@/Components/Buttons/Back.vue'
import Basic from '@/Components/Buttons/Basic.vue'
import { Head } from '@inertiajs/inertia-vue3'

let props = defineProps({
   fine: {
      type: Object,
      default: {}
   }
})

let oldDate = props.fine.data.fine_date;

let form = useForm({
   member_id: props.fine.data.member_id,
   loan_id: props.fine.data.loan_id,
   fine_date: '',
   fine_amount: props.fine.data.fine_amount,
});

let submit = () => {
   form.transform((data) => (
      {
         ...data,
         fine_date: data.fine_date == '' ?
            Math.floor((new Date(`${props.fine.data.fine_date}`)).getTime() / 1000) :
            Math.floor((new Date(`${data.fine_date}`)).getTime() / 1000),
      }
   )).put(`/fines/${props.fine.data.id}`);
};
</script>