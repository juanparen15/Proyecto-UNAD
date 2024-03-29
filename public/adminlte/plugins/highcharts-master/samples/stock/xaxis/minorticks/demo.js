(async () => {

    const usdeur = await fetch(
        'https://www.highcharts.com/samples/data/usdeur.json'
    ).then(response => response.json());

    Highcharts.stockChart('container', {

        yAxis: {
            minorGridLineWidth: 0,
            minorTickInterval: 'auto',
            minorTickColor: '#000000',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside'
        },

        rangeSelector: {
            selected: 1
        },

        series: [{
            name: 'USD to EUR',
            data: usdeur
        }]
    });
})();