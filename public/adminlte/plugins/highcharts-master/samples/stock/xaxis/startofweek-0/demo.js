(async () => {

    const usdeur = await fetch(
        'https://www.highcharts.com/samples/data/usdeur.json'
    ).then(response => response.json());

    Highcharts.stockChart('container', {

        chart: {
            width: 800
        },

        xAxis: {
            dateTimeLabelFormats: {
                week: '%a,<br/>%e. %b'
            },
            startOfWeek: 0,
            tickPixelInterval: 70
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