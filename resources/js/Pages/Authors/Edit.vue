<template>
   <AuthenticatedLayout>

      <Head title="Edit Author" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Author</h2>
            <Back :url="route('authors.index')">Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Author Information</h2>

               <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                  Fill author information with first name and last name.
               </p>
            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="first_name" name="first_name" type="text" class="mb-6" v-model="form.first_name"
               placeholder="First Name" :errorMessage="form.errors.first_name">First Name</Input>

            <Input id="last_name" name="last_name" type="text" class="mb-6" v-model="form.last_name"
               placeholder="Last Name" :errorMessage="form.errors.last_name">Last Name</Input>

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
import { Head} from '@inertiajs/inertia-vue3'

let props = defineProps({
   author: {
      type: Object,
      default: {}
   }
})

let form = useForm({
   first_name: props.author.first_name,
   last_name: props.author.last_name,
});

let submit = () => {
   form.put(`/authors/${props.author.id}`);
};
</script>