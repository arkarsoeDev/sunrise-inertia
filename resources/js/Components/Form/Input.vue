<template>
   <div>
      <template v-if="label">
         <label :for="id" class="block mb-2 text-sm font-medium dark:text-white"
            :class="{ 'text-red-700 dark:text-red-500': errorMessage }">
            <slot></slot>
         </label>
      </template>
      <input :disabled="disabled" :id="id" :name="name" :type="type"
         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:bg-gray-200"
         :class="{ 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500': errorMessage }"
         :value="modelValue" :placeholder="placeholder" @input="$emit('update:modelValue', $event.target.value)" @blur="$emit('blur')">
      <p v-if="errorMessage" class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium"></span>{{
            errorMessage
      }}</p>
   </div>
</template>

<script setup>
defineProps({
   id: {
      type: String,
   },
   name: {
      type: String,
   },
   label: {
      type: Boolean,
      default: true,
   },
   placeholder: {
      type: String,
      default: '',
   },
   type: {
      type: String,
      default: "text",
   },
   modelValue: {
      type: [String,Number,Date],
   },
   errorMessage: {
      default: false
   },
   disabled: {
      type: Boolean,
      default: false
   }
})

defineEmits(['update:modelValue','blur'])
</script>