<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatsCard from '@/Components/StatsCard.vue';
import LoanChart from '@/Components/Chart/LoanChart.vue';
import MostLoanBooksChart from '@/Components/Chart/MostLoanBookChart.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { UsersIcon, BookOpenIcon, ClipboardDocumentListIcon, CurrencyDollarIcon } from '@heroicons/vue/24/outline'
defineProps({
    bookCount: [Number, String],
    memberCount: [Number, String],
    loanCount: [Number, String],
    fineCount: [Number, String],
    loanCountPerDay: [Array, Object],
    mostLoanBooks: [Array,Object]
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="grid grid-cols-1 gap-5 mb-5 md:grid-cols-2 xl:grid-cols-4">
            <StatsCard :url="route('books.index')" title="Book Count" :count="bookCount">
                <template v-slot:icon>
                    <BookOpenIcon class="w-12 h-12 text-sky-500"></BookOpenIcon>
                </template>
            </StatsCard>
            <StatsCard :url="route('members.index')" title="Member Count" :count="memberCount">
                <template v-slot:icon>
                    <UsersIcon class="w-12 h-12 text-sky-500"></UsersIcon>
                </template>
            </StatsCard>
            <StatsCard :url="route('loans.index')" title="Loan Count" :count="loanCount">
                <template v-slot:icon>
                    <ClipboardDocumentListIcon class="w-12 h-12 text-sky-500"></ClipboardDocumentListIcon>
                </template>
            </StatsCard>
            <StatsCard :url="route('fines.index')" title="Fine Count" :count="fineCount">
                <template v-slot:icon>
                    <CurrencyDollarIcon class="w-12 h-12 text-sky-500"></CurrencyDollarIcon>
                </template>
            </StatsCard>
        </div>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
            <LoanChart :loanData="loanCountPerDay.total" :loanDate="loanCountPerDay.date"></LoanChart>

            <MostLoanBooksChart :mostLoanBooksTotal="mostLoanBooks.total" :mostLoanBooksTitle="mostLoanBooks.title">
            </MostLoanBooksChart>
        </div>
    </AuthenticatedLayout>
</template>
