const chart = Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    series: [{
        data: [29.9, 71.5, 106.4, 129.2]
    }]
});

// button handler
document.getElementById('button').addEventListener('click', () => {
    const series = chart.series[0];
    if (series.data.length) {
        chart.series[0].data[0].remove();
    }
});
