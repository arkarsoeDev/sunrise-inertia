<template>
   <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow rounded-md bg-white h-full">
      <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
         <div class="flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-grow flex-1">
               <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
                  Overview
               </h6>
               <h2 class="text-xl font-semibold">
                  Most Loan Books
               </h2>
            </div>
         </div>
      </div>
      <div class="p-4 flex-auto">
         <!-- Chart -->
         <div class="relative min-h-[400px]">
            <canvas id="mostLoanBooksChart" class="h-full"></canvas>
         </div>
      </div>
      <div class="text-center mb-3">
         <Basic :url="route('most-loan-books.index')">View More
         </Basic>
      </div>
   </div>
</template>

<script setup>
import Basic from '@/Components/Buttons/Basic.vue'
</script>

<script>
import Chart from 'chart.js/auto'

export default {
   name: 'MostLoanBooksChart',
   props: {
      mostLoanBooksTitle: {
         required: true
      },
      mostLoanBooksTotal: {
         required: true
      }
   },
   mounted() {
      const ctx = document.getElementById('mostLoanBooksChart');
      const data = {
         labels: this.mostLoanBooksTitle,
         datasets: [
            {
               label: 'Loans',
               backgroundColor: 'rgba(0, 13, 255,.4)',
               data: this.mostLoanBooksTotal,
            }
         ]
      };

      const config = {
         type: 'bar',
         data: data,
         options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
               legend: {
                  position: 'top',
               },
               title: {
                  display: true,
                  text: 'Most Loan 8 books'
               }
            },
            scales: {
               x: {
                  display: true,
                  title: {
                     display: true,
                     text: 'Titles'
                  }
               }
            }
         },
      };
      new Chart(ctx, config);
   }
}

</script>