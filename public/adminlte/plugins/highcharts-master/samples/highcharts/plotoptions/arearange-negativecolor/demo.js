(async () => {

    const data = await fetch(
        'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/range.json'
    ).then(response => response.json());

    Highcharts.chart('container', {

        chart: {
            type: 'arearange'
        },

        title: {
            text: 'Temperature variation by day'
        },

        xAxis: {
            type: 'datetime'
        },

        yAxis: {
            title: {
                text: null
            }
        },

        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: '°C'
        },

        legend: {
            enabled: false
        },

        series: [{
            name: 'Temperatures',
            data: data,
            color: '#FF0000',
            negativeColor: '#0088FF'
        }]

    });

})();