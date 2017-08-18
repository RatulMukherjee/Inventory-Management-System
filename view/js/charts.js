$(document).ready(function(){
    var ctx = document.getElementById('myChart1').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Sales",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    },
        options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                         return value +'k';
                    }
                }
            }]
        }
    }
    
});
                var ctx1 = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Profits",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 2, 3, 2, 5,6, 8],
        }]
    },
        options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                         return value +'k';
                    }
                }
            }]
        }
    }
    
}); 
    
});