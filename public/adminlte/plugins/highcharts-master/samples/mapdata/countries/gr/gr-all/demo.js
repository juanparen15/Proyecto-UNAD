(async () => {

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/gr/gr-all.topo.json'
    ).then(response => response.json());

    // Prepare demo data. The data is joined to map using value of 'hc-key'
    // property by default. See API docs for 'joinBy' for more info on linking
    // data and map.
    const data = [
        ['gr-as', 10], ['gr-ii', 11], ['gr-at', 12], ['gr-pp', 13],
        ['gr-ts', 14], ['gr-an', 15], ['gr-gc', 16], ['gr-cr', 17],
        ['gr-mc', 18], ['gr-ma', 19], ['gr-mt', 20], ['gr-gw', 21],
        ['gr-mw', 22], ['gr-ep', 23]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: topology
        },

        title: {
            text: 'Highcharts Maps basic demo'
        },

        subtitle: {
            text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/gr/gr-all.topo.json">Greece</a>'
        },

        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 0
        },

        series: [{
            data: data,
            name: 'Random data',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }]
    });

})();