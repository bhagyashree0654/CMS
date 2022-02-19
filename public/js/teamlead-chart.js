$(document).ready(function () {

    'use strict';

    Chart.defaults.global.defaultFontColor = '#75787c';


    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //
    var legendState = true;
    if ($(window).outerWidth() < 576) {
        legendState = false;
    }

    var LINECHART = $('#linechart-employee-tl');
    var myLineChart = new Chart(LINECHART, {
        type: 'line',
        options: {
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        max: 24,
                        min: 0
                    },
                    display: true,
                    gridLines: {
                        display: false
                    }
                }]
            },
            legend: {
                display: legendState
            }
        },
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [
                {
                    label: "Individual Working Hour (Monthly)",
                    fill: true,
                    lineTension: 0.2,
                    backgroundColor: "transparent",
                    borderColor: '#864DD9',
                    pointBorderColor: '#864DD9',
                    pointHoverBackgroundColor: '#864DD9',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [4,3,3,5,6,2,3],
                    spanGaps: false
                },
                {
                    label: "Group Working Hour (Monthly)",
                    fill: true,
                    lineTension: 0.2,
                    backgroundColor: "transparent",
                    borderColor: '#EF8C99',
                    pointBorderColor: '#EF8C99',
                    pointHoverBackgroundColor: '#EF8C99',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [14,13,13,15,16,12,13],
                    spanGaps: false
                },
                {
                    label: "Group Working Hour (Monthly)",
                    fill: true,
                    lineTension: 0.2,
                    backgroundColor: "transparent",
                    borderColor: '#75787c',
                    pointBorderColor: '#EF8C99',
                    pointHoverBackgroundColor: '#EF8C99',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [14,10,18,19,15,10,13],
                    spanGaps: false
                }
            ]
        }
    });



    // ------------------------------------------------------- //
    // Bar Chart
    // ------------------------------------------------------ //
    var BARCHARTEXMPLE    = $('#barchart-employee-tl');
    var barChartExample = new Chart(BARCHARTEXMPLE, {
        type: 'bar',
        options: {
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        color: '#eee'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        color: '#eee'
                    }
                }]
            },
        },
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Data Set 1",
                    backgroundColor: [
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)",
                        "rgba(134, 77, 217, 0.57)"
                    ],
                    borderColor: [
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)",
                        "rgba(134, 77, 217, 1)"
                    ],
                    borderWidth: 1,
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "Data Set 2",
                    backgroundColor: [
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)"
                    ],
                    borderColor: [
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)",
                        "rgba(75, 75, 75, 0.7)"
                    ],
                    borderWidth: 1,
                    data: [35, 40, 60, 47, 88, 27, 30],
                }
            ]
        }
    });


    // ------------------------------------------------------- //
    // Pie Chart 1
    // ------------------------------------------------------ //
    var PIECHART = $('#pieChartHome1');
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
                    data: [300, 50, 100, 60],
                    borderWidth: [0, 0, 0, 0],
                    backgroundColor: [
                        '#6933b9',
                        "#8553d1",
                        "#a372ec",
                        "#be9df1"
                    ],
                    hoverBackgroundColor: [
                        '#6933b9',
                        "#8553d1",
                        "#a372ec",
                        "#be9df1"
                    ]
                }]
        }
    });

    // ------------------------------------------------------- //
    // Pie Chart 2
    // ------------------------------------------------------ //
    var PIECHART = $('#pieChartHome2');
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
                    data: [80, 70, 100, 60],
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
    var PIECHART = $('#pieChartHome3');
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

    var pieChartExample = {
        responsive: true
    };

});
