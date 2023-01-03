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

               <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                  Fill book information.
               </p>
            </header>
         </div>
         <form @submit.prevent="submit" class="max-w-md">

            <Input id="title" name="title" type="text" class="mb-6" v-model="form.title" placeholder="Title"
               :errorMessage="form.errors.title">Title</Input>
            <Input id="publication_date" name="publication_date" type="text" class="mb-6"
               v-model="form.publication_date" placeholder="Publication Date"
               :errorMessage="form.errors.publication_date">Publication Date</Input>
            <Input id="copies_owned" name="copies_owned" type="text" class="mb-6" v-model="form.copies_owned"
               placeholder="Copies Owned" :errorMessage="form.errors.copies_owned">Copies Owned</Input>
            <Input id="available" name="available" type="text" class="mb-6" v-model="form.available"
               placeholder="Available" :errorMessage="form.errors.available">Available</Input>

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
   book: {
      type: Object,
      default: {}
   }
})

let form = useForm({
   title: props.book.title,
   publication_date: props.book.publication_date,
   copies_owned: props.book.copies_owned,
   available: props.book.available,
});

let submit = () => {
   form.put(`/books/${props.book.id}`);
};
</script>