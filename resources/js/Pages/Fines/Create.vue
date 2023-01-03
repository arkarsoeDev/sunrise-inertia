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
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="loan_id" name="loan_id" type="text" class="mb-6" v-model="form.loan_id" placeholder="Loan Id"
               :errorMessage="form.errors.loan_id">Loan Id</Input>
            <Input id="member_id" name="member_id" type="text" class="mb-6" v-model="form.member_id"
               placeholder="Member Id" :errorMessage="form.errors.member_id">Member Id</Input>
            <Input id="fine_date" name="fine_date" type="date" class="mb-6" v-model="form.fine_date"
               placeholder="Fine Date" :errorMessage="form.errors.fine_date">Fine Date</Input>
            <Input id="fine_amount" name="fine_amount" type="text" class="mb-6"
               v-model="form.fine_amount" placeholder="Fine Amount" :errorMessage="form.errors.fine_amount">Fine Amount</Input>

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
   loan_id: String,
})

let form = useForm({
   member_id: props.member_id ?? '',
   loan_id: props.loan_id ?? '',
   fine_date: '',
   fine_amount: '5',
});

let submit = () => {
   form.transform((data) => ({
      ...data,
      fine_date: Math.floor((new Date(`${data.fine_date}`)).getTime() / 1000)
   })).post('/fines');
};
</script>