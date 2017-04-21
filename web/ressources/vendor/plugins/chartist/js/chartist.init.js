/**
 Template Name: Upbond
 Chartist chart
 */

var chart = new Chartist.Line("#chart-with-area", {
    labels: ["Mars"],
    series: [
        [75]
    ]
}, { low: 0, showArea: !0, plugins: [Chartist.plugins.tooltip()] });