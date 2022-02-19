$(document).ready(function () {

    'use strict';

    Chart.defaults.global.defaultFontColor = '#75787c';

    var LINECHARTEXMPLE   = $('#linechart-employee');
    var lineChartExample = new Chart(LINECHARTEXMPLE, {
        type: 'line',
        options: {
            legend: {labels:{fontColor:"#777", fontSize: 12}},
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        color: 'transparent'
                    }
                }],
                yAxes: [{
                    ticks: {
                        max: 60,
                        min: 0
                    },
                    display: true,
                    gridLines: {
                        color: 'transparent'
                    }
                }]
            },
        },
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "emp_name",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: "rgba(134, 77, 217, 0.88)",
                    borderColor: "rgba(134, 77, 217, 088)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBorderColor: "rgba(134, 77, 217, 0.88)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(134, 77, 217, 0.88)",
                    pointHoverBorderColor: "rgba(134, 77, 217, 0.88)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [30, 20, 17, 40, 30, 22, 30],
                    spanGaps: false
                }
            ]
        }
    });


    var BARCHARTEXMPLE    = $('#barchart-employee');
    var barChartExample = new Chart(BARCHARTEXMPLE, {
        type: 'bar',
        options: {
            scales: {
                xAxes: [{
                    display: true,
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
        },
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [
                {
                    label: "name",
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
                    data: [65, 59, 80, 81, 56, 55, 40],
                }
             ]
        }
    });


    // ------------------------------------------------------- //
    // Pie Chart 1
    // ------------------------------------------------------ //
    var PIECHART = $('#workingHourEmployee');
    var myPieChart = new Chart(PIECHART, {
        type: 'doughnut',
        options: {
            cutoutPercentage: 90,
            legend: {
                display: false
            }
        },
        data: {
            labels: [
                "First",
                "Second",
                "Third",
                "Fourth",
                "Fifth",
                "Sixth",
                "Seventh"
            ],
            datasets: [
                {
                    data: [300, 50, 100, 60,20,40,50],
                    borderWidth: [0, 0, 0, 0,0,0,0],
                    backgroundColor: [
                        '#6933b9',
                        "#8553d1",
                        '#6933b9',
                        "#8553d1",
                        '#6933b9',
                        "#8553d1",
                        "#be9df1"
                    ],
                    hoverBackgroundColor: [
                        '#6933b9',
                        "#8553d1",
                        '#6933b9',
                        "#8553d1",
                        '#6933b9',
                        "#a372ec",
                        "#be9df1"
                    ]
                }]
        }
    });
// ------------------------------------------------------- //
    // Pie Chart 2
    // ------------------------------------------------------ //
    var PIECHART = $('#projectAssignedEmployee');
    var myPieChart = new Chart(PIECHART, {
        type: 'doughnut',
        options: {
            cutoutPercentage: 90,
            legend: {
                display: false
            }
        },
        data: {
            labels: [
                "First",
                "Second"
            ],
            datasets: [
                {
                    data: [80, 70],
                    borderWidth: [0, 0, 0, 0],
                    backgroundColor: [
                        '#9528b9',
                        "#b046d4",
                        "#c767e7",
                        "#e394fe"
                    ],
                    hoverBackgroundColor: [
                        '#9528b9',
                        "#b046d4",
                        "#c767e7",
                        "#e394fe"
                    ]
                }]
        }
    });

    // ------------------------------------------------------- //
    // Pie Chart 3
    // ------------------------------------------------------ //
    var PIECHART = $('#eventsEmployee');
    var myPieChart = new Chart(PIECHART, {
        type: 'doughnut',
        options: {
            cutoutPercentage: 90,
            legend: {
                display: false
            }
        },
        data: {
            labels: [
                "First",
                "Second",
                "Third",
                "Fourth"
            ],
            datasets: [
                {
                    data: [120, 90, 77, 95],
                    borderWidth: [0, 0, 0, 0],
                    backgroundColor: [
                        '#da4d60',
                        "#e96577",
                        "#f28695",
                        "#ffb6c1"
                    ],
                    hoverBackgroundColor: [
                        '#da4d60',
                        "#e96577",
                        "#f28695",
                        "#ffb6c1"
                    ]
                }]
        }
    });


});
