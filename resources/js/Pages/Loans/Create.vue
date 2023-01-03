<template>
   <AuthenticatedLayout>

      <Head title="Create New Loan" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Loan</h2>
            <Back :url="route('loans.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Loan Information</h2>

            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">
            <div v-if="form.errors.message" class="p-3 bg-red-300 rounded mb-6">
               {{ form.errors.message }}
            </div>

            <Input id="book_id" name="book_id" type="text" class="mb-6" v-model="form.book_id" placeholder="Book Id"
               :errorMessage="form.errors.book_id">Book Id</Input>
            <Input id="member_id" name="member_id" type="text" class="mb-6" v-model="form.member_id"
               placeholder="Member Id" :errorMessage="form.errors.member_id">Member Id</Input>
            <Input id="loan_date" :disabled="true" name="loan_date" type="text" class="mb-6" v-model="form.loan_date"
               placeholder="Loan Date" :errorMessage="form.errors.loan_date">Loan Date</Input>
            <Input @blur="calcReturnDate" id="duration" name="duration" type="text" class="mb-6" v-model="duration"
               placeholder="Duration" :errorMessage="form.errors.duration">Duration</Input>
            <Input id="return_date" :disabled="true" name="return_date" type="text" class="mb-6"
               v-model="form.return_date" placeholder="Return Date" :errorMessage="form.errors.return_date">Return
            Date</Input>

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
import { formatDate } from "@/helpers/helpers";
import { ref, computed } from "vue";

let props = defineProps({
   member_id: String,
   book_id: String,
})

let duration = ref(7);
let loanDate = new Date();
const newReturnDate = ref();

const returnTimestamp = ref();

const calcReturnDate = function () {
   duration.value = duration.value > 1 ? duration.value : 7
   let returnDate = new Date();
   returnDate.setDate(returnDate.getDate() + Number(duration.value))
   newReturnDate.value = formatDate(Math.floor((returnDate).getTime() / 1000))
   returnTimestamp.value = Math.floor((returnDate).getTime() / 1000)
}

calcReturnDate()

let form = useForm({
   member_id: props.member_id ? props.member_id : '' ,
   book_id: props.book_id ? props.book_id : '',
   duration: duration,
   loan_date: formatDate(Math.floor((loanDate).getTime() / 1000)),
   return_date: newReturnDate,
});

let submit = () => {
   form.transform((data) => ({
      ...data,
      return_date: returnTimestamp.value,
      loan_date: Math.floor((new Date()).getTime() / 1000)
   })).post('/loans');
};
</script>