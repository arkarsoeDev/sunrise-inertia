<template>
   <AuthenticatedLayout>

      <Head title="Edit Category" />
      <template #header>
         <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Category</h2>
            <Back>Back</Back>
         </div>
      </template>
      <div class="p-4 bg-white shadow rounded-lg">
         <div class="mb-6">
            <header>
               <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Category Information</h2>
            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="title" name="title" type="text" class="mb-6" v-model="form.title" placeholder="Title"
               :errorMessage="form.errors.title">Title</Input>


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
   category: {
      type: Object,
      default: {}
   }
})

let form = useForm({
   title: props.category.title,
});

let submit = () => {
   form.put(`/categories/${props.category.id}`);
};
</script>