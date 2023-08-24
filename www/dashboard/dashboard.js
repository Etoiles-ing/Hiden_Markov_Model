/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'Page #',
        'Page 1',
        'Page 2',
        'Page 3',
        'Page 4'
      ],
      datasets: [{
        data: myDataNext,
        lineTension: 0,
        backgroundColor: 'line',
        borderColor: '#007bff',
        borderWidth: 1,
        pointBackgroundColor: '#007bff'
      },
      {
        data: myDataPrev,
        lineTension: 0,
        backgroundColor: 'line',
        borderColor: '#DE0220',
        borderWidth: 1,
        pointBackgroundColor: '#DE0220'
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          boxPadding: 3
        }
      }
    }
  })
})()
