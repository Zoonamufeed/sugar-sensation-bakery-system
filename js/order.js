const ctx3 = document.querySelectorAll('.chart-bar-stacked');

const data = {
  labels: [
    "2015",
    "2016",
    "2017",
    "2018",
    "2019",
    "2020"
  ],
  datasets: [
    {
      label: "Expired",
      backgroundColor: "#FF7F32",

      data: [
        9000,
        5000,
        5240,
        3520,
        2510,
        3652
      ]
    },
    {
      label: "Good",
      backgroundColor: "#FF9E3D",
      data: [
        3000,
        4000,
        6000,
        3500,
        3600,
        8060
      ]
    },
    {
      label: "Fresh ",
      backgroundColor: "#FFB54D",
      data: [
        6000,
        7200,
        6500,
        4600,
        3600,
        9200
      ]
    }
  ]
};

const options = {
  scales: {
    yAxes: [
       { 
           stacked: true,  
           ticks: { fontSize: 14, lineHeight: 3, fontColor: "#adb5bd" }, 
           gridLines: { display: false }
     
        }],
    xAxes: [
      {
        stacked: true,
        ticks: {  fontSize: 14, lineHeight: 3, fontColor: "#adb5bd" }
      }
    ]
  }
};

const chart = new Chart(ctx3[ctx3.length-1], {
  // The type of chart we want to create
  type: "bar",
  // The data for our dataset
  data: data,
  // Configuration options go here
  options: options
});
//salesoverview
var ctx2 = document.querySelectorAll(".chart-line");

    new Chart(ctx2[ctx2.length-1], {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Black Friday Sale",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#FF7F32",
              borderWidth: 3,
              backgroundColor: "transparent",
              data: [20, 60, 20, 50, 90, 220, 440, 380, 500],
              maxBarThickness: 6
            },
            {
              label: "Monthly sales",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#212b36",
              borderWidth: 3,
              backgroundColor: "transparent",
              data: [30, 90, 40, 140, 290, 290, 240, 270, 230],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            enabled: true,
            mode: "index",
            intersect: false,
          },
          scales: {
            yAxes: [{
              gridLines: {
                borderDash: [2],
                borderDashOffset: [2],
                color: '#dee2e6',
                zeroLineColor: '#dee2e6',
                zeroLineWidth: 1,
                zeroLineBorderDash: [2],
                drawBorder: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 10,
                fontSize: 11,
                fontColor: '#adb5bd',
                lineHeight: 3,
                fontStyle: 'normal',
                fontFamily: "Public Sans",
              },
            }, ],
            xAxes: [{
              gridLines: {
                zeroLineColor: 'rgba(0,0,0,0)',
                display: false,
              },
              ticks: {
                padding: 10,
                fontSize: 11,
                fontColor: '#adb5bd',
                lineHeight: 3,
                fontStyle: 'normal',
                fontFamily: "Public Sans",
              },
            }, ],
          },
        },
      });
//best food
var ctx = document.getElementById("chart-pie");

  var chartPie = new ApexCharts(ctx, {
    chart: {
       width: 380,
       type: 'donut',
     },
     dataLabels: {
       enabled: false
     },
     plotOptions: {
        pie: {
          customScale: 1,
          expandOnClick: false,
          donut: {
            size: "80%",
          }
        },
      },
    legend: {
        position: "right",
        verticalAlign: "center",
        containerMargin: {
          left: 35,
          right: 60
        }
      },
     series: [66, 55, 43, 33],
     labels: ['Potatoe Wedges', 'Strawberry Cheesecake', 'Mojito', 'Pizza'],
     colors: ['#FF7F32', '#FF9E3D', '#FFB54D', '#FFCC66'],
     donut: {
       size: "100%"
     },
     responsive: [
        {
           breakpoint: 1550,
           options: {
             chart: {
                width: 340,
             },
             legend: {
                 position: "bottom",
                 verticalAlign: "bottom",
                 containerMargin: {
                   left: 'auto',
                   right: 'auto'
                 }
               },
           }
        },
        {
           breakpoint: 1450,
           options: {
             chart: {
                width: 300,
             },
           }
        }
      ]
  });

  chartPie.render();