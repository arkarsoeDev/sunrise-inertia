<template>
   <AuthenticatedLayout>

      <Head title="Edit Fine Payment" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Fine Payment</h2>
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
            <Input type="text" :disabled="true" class="mb-6" v-model="oldDate">Old Fine Date</Input>
            <Input id="payment_date" name="payment_date" type="date" class="mb-6" v-model="form.payment_date"
               placeholder="Payment Date" :errorMessage="form.errors.payment_date">Payment Date</Input>
            <Input id="payment_amount" name="payment_amount" type="text" class="mb-6" v-model="form.payment_amount"
               placeholder="Payment Amount" :errorMessage="form.errors.payment_amount">Payment Amount</Input>


            <div class="w-4/12">
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
import { Head } from '@inertiajs/inertia-vue3'

let props = defineProps({
   fine_payment: {
      type: Object,
      default: {}
   }
})

let oldDate = props.fine_payment.data.payment_date;

let form = useForm({
   member_id: props.fine_payment.data.member_id,
   fine_id: props.fine_payment.data.fine_id,
   payment_date: '',
   payment_amount: props.fine_payment.data.payment_amount,
});

let submit = () => {
   form.transform((data) => ({
      ...data,
      payment_date:
         data.payment_date == '' ?
            Math.floor((new Date(`${props.fine_payment.data.payment_date}`)).getTime() / 1000) :
            Math.floor((new Date(`${data.payment_date}`)).getTime() / 1000),
   })).put(`/fine-payments/${props.fine_payment.data.id}`);
};
</script>