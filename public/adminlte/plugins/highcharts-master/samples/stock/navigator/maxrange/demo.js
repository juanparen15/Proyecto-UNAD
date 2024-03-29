(async () => {

    const usdeur = await fetch(
        'https://www.highcharts.com/samples/data/usdeur.json'
    ).then(response => response.json());

    Highcharts.stockChart('container', {

        xAxis: {
            range: 1.5 * 360 * 24 * 3600000,
            minRange: 1.0 * 360 * 24 * 3600000,
            maxRange: 2.0 * 360 * 24 * 3600000
        },

        series: [{
            name: 'USD to EUR',
            data: usdeur
        }]
    });
})();