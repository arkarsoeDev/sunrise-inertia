<template>
   <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow rounded-md bg-white h-full">
      <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
         <div class="flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-grow flex-1">
               <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
                  Overview
               </h6>
               <h2 class="text-xl font-semibold">
                  Loan Count Per Day
               </h2>
            </div>
         </div>
      </div>
      <div class="p-4 flex-auto">
         <!-- Chart -->
         <div class="relative min-h-[400px]">
            <canvas id="loanChart" class="h-full"></canvas>
         </div>
      </div>
      <div class="text-center mb-3">
         <Basic
            :url="route('daily-loan-count.index')">View More
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
   name: 'SaleChart',
   props: {
      loanDate: {
         required: true
      },
      loanData: {
         required: true
      }
   },
   mounted() {
      const ctx = document.getElementById('loanChart');
      const data = {
         labels: this.loanDate.reverse(),
         datasets: [
            {
               label: 'Total earn',
               backgroundColor: 'rgba(103, 110, 245,.3)',
               borderColor: 'rgba(0, 13, 255,.4)',
               data: this.loanData.reverse(),
               fill: true,
            }
         ]
      };

      const config = {
         type: 'line',
         data: data,
         options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
               title: {
                  display: true,
                  text: 'Loan count for last 9 days'
               },
            },
            interaction: {
               mode: 'index',
               intersect: false
            },
            scales: {
               x: {
                  display: true,
                  title: {
                     display: true,
                     text: 'Days'
                  }
               },
               y: {
                  beginAtZero: true,
                  display: true,
               }
            }
         },
      };
      new Chart(ctx, config);
   }
}

</script>