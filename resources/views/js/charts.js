/*global $, document*/
$(document).ready(function () {

    'use strict';

    Chart.defaults.global.defaultFontColor = '#75787c';
    var colors = ['rgb(0, 0, 255)','rgb(132, 250, 71)','rgb(255, 165)','rgb(106, 90, 205)','rgb(238, 130, 238)','rgb(132, 26, 186)','rgb(255, 26, 186)',]

    var totalTime = [];
    var projects = [];
    var dsets = [];

    // $.ajax({
    //     type: "get",
    //     url: "projectGraphFetch",
    //     dataType: "json",
    //     success: function (response) {

    //       if(response.dbStatus == "SUCCESS"){
    //         response.aaData.forEach(data => {

    //           console.log(data.proj_code);
    //           const date = new Date();
    //           const isInWeek = isDateInThisWeek(date);
    //           alert(isInWeek)
              
    //         });
    //       }
    //     },
    //     error: function (error) {
    //         console.log(error);
    //     }

    // });
    // check for current week
    function isDateInThisWeek(date) {
        const todayObj = new Date();
        const todayDate = todayObj.getDate();
        const todayDay = todayObj.getDay();
      
        // get first date of week
        const firstDayOfWeek = new Date(todayObj.setDate(todayDate - todayDay));
      
        // get last date of week
        const lastDayOfWeek = new Date(firstDayOfWeek);
        lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 6);
      
        // if date is equal or within the first and last dates of the week
        return date >= firstDayOfWeek && date <= lastDayOfWeek;
      }
    // ------------------------------------------------------- //
    // Bar Chart
    // ------------------------------------------------------ //

// var data = {
//   labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
//   datasets: [{
//     label: "Project1",
//     backgroundColor: 'rgba(132, 250, 71,0.9)',
//     borderWidth: 1,
//     data: [10, 20, 30,40,50,60,70],
//     xAxisID: "bar-x-axis1",
//   }, {
//     label: "Second",
//     backgroundColor: 'rgb(0, 0, 255)',
//     borderWidth: 1,
//     data: [10, 120, 35,44,59,67,170],
//     xAxisID: "bar-x-axis2",
//   }, {
//     label: "Third",
//     backgroundColor: 'rgb(255, 165)',
//     borderWidth: 1,
//     data: [20, 100, 35,49,60,70,80],
//     xAxisID: "bar-x-axis3",
//   }, {
//     label: "Fourth",
//     backgroundColor: 'rgb(106, 90, 205)',
//     borderWidth: 1,
//     data: [25, 90, 35,89,76,65,50],
//     xAxisID: "bar-x-axis4",
//   }, {
//     label: "Fifth",
//     backgroundColor: 'rgb(238, 130, 238)',
//     borderWidth: 1,
//     data: [29, 80, 35,12,23,90,100],
//     xAxisID: "bar-x-axis5",
//   }, {
//     label: "Sixth",
//     backgroundColor: 'rgb(132, 26, 186)',
//     borderWidth: 1,
//     data: [39, 70, 35,80, 35,12,43],
//     xAxisID: "bar-x-axis6",
//   }, {
//     label: "Seventh",
//     backgroundColor: 'rgb(255, 26, 186)',
//     borderWidth: 1,
//     data: [99, 60, 35,12,23,90,78],
//     xAxisID: "bar-x-axis7",
//   }]
// };

// var options = {
//   scales: {
//     xAxes: [{
//       stacked: true,
//       id: "bar-x-axis1",
//       barThickness: 15,
//     }, {
//       display: false,
//       stacked: true,
//       id: "bar-x-axis2",
//       barThickness: 30,
//       // these are needed because the bar controller defaults set only the first x axis properties
//       type: 'category',
//       categoryPercentage: 0.8,
//       barPercentage: 0.9,
//       gridLines: {
//         offsetGridLines: true
//       },
//       offset: true
//     },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis2",
//         barThickness: 45,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis3",
//         barThickness: 60,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis4",
//         barThickness: 75,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis5",
//         barThickness: 90,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis6",
//         barThickness: 105,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       },{
//         display: false,
//         stacked: true,
//         id: "bar-x-axis7",
//         barThickness: 70,
//         // these are needed because the bar controller defaults set only the first x axis properties
//         type: 'category',
//         categoryPercentage: 0.8,
//         barPercentage: 0.9,
//         gridLines: {
//           offsetGridLines: true
//         },
//         offset: true
//       }],
//     yAxes: [{
//       stacked: false,
//       ticks: {
//         beginAtZero: true
//       },
//     }]

//   }
// };

// var ctx = document.getElementById("barChartCustom3").getContext("2d");
// var myBarChart = new Chart(ctx, {
//   type: 'bar',
//   data: data,
//   options: options
// });
    // var BARCHARTEXMPLE    = $('#barChartCustom3');
// ********************************************************************************************

    // setup
    const data = {
      // labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [
          {
              label: "Project1",
              backgroundColor: [
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9"
              ],
              hoverBackgroundColor: [
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9"
              ],
              borderColor: [
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9",
                  "#864DD9"
              ],
              borderWidth: 0.5,
              data: [{x:'2022-01-01', y: '70'},
              {x:'2022-01-02', y: '70'},
              {x:'2022-01-03', y: '70'},
              {x:'2022-01-04', y: '70'},
              {x:'2022-01-05', y: '70'},
              {x:'2022-01-06', y: '70'},
              {x:'2022-01-07', y: '70'}],
          },
          // {
          //     label: "Project2",
          //     backgroundColor: [
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)"
          //     ],
          //     hoverBackgroundColor: [
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)"
          //     ],
          //     borderColor: [
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)",
          //         "rgba(98, 98, 98, 0.5)"
          //     ],
          //     borderWidth: 0.5,
          //     data: [35, 40, 60, 47, 88, 27, 30],
          // }
      ]
    }
    // config
    const config ={
    type: 'bar',
    data,
    options: {
        scales: {
            xAxes: [{
                display: true,
                type: 'time',
                time:{
                  unit:'day',
                },
                gridLines: {
                    color: 'transparent'
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: 'transparent'
                }
            }]
        },
    }
  };
    // render init

    const mychart = new Chart( 
      document.getElementById('barChartCustom3').getContext('2d'),config
    );


    // var ctx = document.getElementById('barChartCustom3'); // node
    // var ctx = document.getElementById('barChartCustom3').getContext('2d'); // 2d context
    // var ctx = $('#barChartCustom3'); // jQuery instance
    // var ctx = 'barChartCustom3'; // element id


    // var barChartExample = new Chart(ctx, {
      
    // });


    // ------------------------------------------------------- //
    // Pie Chart for emp-performance
    // ------------------------------------------------------ //

    // var performancetbl = $('#emp-performance-tbl').DataTable({
    //     "bProcessing": false,
    //     "bServerSide": false,
    //     "bPaginate": true,
    //     "bLengthChange": true,
    //     "bFilter": true,
    //     "bSort": false,
    //     "bInfo": true,
    //     "bAutoWidth": true,
    //     "sAjaxSource": "fetchPerformance",
    //     "bDestroy":false,
    //     "aoColumns": [
    //         {"data" : "no","bSortable":"false"},
    //         {"data" : "emp_name","sClass":"alignCenter"},
    //         {"data" : "total_time",
	// 				"render": function (data) {
	// 					if(data == 'null' || data == null)
	// 					return "00:00:00";
	// 					else
	// 					return data;
	// 				}
				
	// 		},
    //         {"sName" : "action",
    //             "sWidth":"20%",
    //             "data"  : null,
    //             "sClass":"alignCenter",
    //             "defaultContent": "<button id='btmempperformance' action ='btmempperformance' class='btn btn-success'><i class = 'fa fa-pie-chart'></i></button>"
    //         }
    //     ]
    // });

    // var ctx2 = document.getElementById('emp-performance'); // node
    // var ctx2= document.getElementById('emp-performance').getContext('2d'); // 2d context
    // var pieChartExample = new Chart(ctx2, {
    //     type: 'pie',
    //     options: {
    //         legend: {
    //             display: true,
    //             position: "left"
    //         }
    //     },
    //     data: {
    //         labels: [
    //             "A",
    //             "B",
    //             "C",
    //             "D"
    //         ],
    //         datasets: [
    //             {
    //                 data: [300, 50, 100, 80],
    //                 borderWidth: 0,
    //                 backgroundColor: [
    //                     '#723ac3',
    //                     "#864DD9",
    //                     "#9762e6",
    //                     "#a678eb"
    //                 ],
    //                 hoverBackgroundColor: [
    //                     '#723ac3',
    //                     "#864DD9",
    //                     "#9762e6",
    //                     "#a678eb"
    //                 ]
    //             }]
    //         }
    // });

    // var pieChartExample = {
    //     responsive: true
    // };

});

var ctx2 = document.getElementById('emp-performance'); // node
var ctx2= document.getElementById('emp-performance').getContext('2d'); // 2d context
var pieChartExample = new Chart(ctx2, {
    type: 'pie',
    options: {
        legend: {
            display: true,
            position: "left"
        }
    },
    data: chart_data
});
