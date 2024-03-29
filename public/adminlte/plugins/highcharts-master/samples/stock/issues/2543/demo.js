(async () => {

    // Load the dataset
    const data = await fetch(
        'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v10.3.3/samples/data/usdeur.json'
    ).then(response => response.json());

    // Create the chart
    Highcharts.stockChart('container', {


        rangeSelector: {
            selected: 1
        },

        title: {
            text: 'Issue in v1.3.6 caused last flag not to appear'
        },

        tooltip: {
            style: {
                width: '200px'
            },
            valueDecimals: 4
        },

        yAxis: {
            title: {
                text: 'Exchange rate'
            }
        },

        series: [{
            name: 'USD to EUR',
            data: data,
            id: 'dataseries'
        },
        // the event marker flags
        {
            type: 'flags',
            data: [{
                x: data[data.length - 1][0],
                title: 'B',
                text: 'EURUSD: Bearish Trend Change on Tap?'
            }],
            onSeries: 'dataseries',
            shape: 'circlepin',
            width: 16
        }]
    });
})();