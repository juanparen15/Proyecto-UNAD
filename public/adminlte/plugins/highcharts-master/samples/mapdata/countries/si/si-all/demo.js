(async () => {

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/si/si-all.topo.json'
    ).then(response => response.json());

    // Prepare demo data. The data is joined to map using value of 'hc-key'
    // property by default. See API docs for 'joinBy' for more info on linking
    // data and map.
    const data = [
        ['si-1439', 10], ['si-457', 11], ['si-1395', 12], ['si-1396', 13],
        ['si-1451', 14], ['si-1457', 15], ['si-1416', 16], ['si-1460', 17],
        ['si-1404', 18], ['si-423', 19], ['si-425', 20], ['si-448', 21],
        ['si-426', 22], ['si-471', 23], ['si-436', 24], ['si-438', 25],
        ['si-442', 26], ['si-443', 27], ['si-1441', 28], ['si-1405', 29],
        ['si-1380', 30], ['si-446', 31], ['si-447', 32], ['si-449', 33],
        ['si-450', 34], ['si-452', 35], ['si-453', 36], ['si-475', 37],
        ['si-456', 38], ['si-460', 39], ['si-458', 40], ['si-461', 41],
        ['si-462', 42], ['si-465', 43], ['si-459', 44], ['si-455', 45],
        ['si-469', 46], ['si-427', 47], ['si-472', 48], ['si-473', 49],
        ['si-474', 50], ['si-1443', 51], ['si-479', 52], ['si-480', 53],
        ['si-481', 54], ['si-482', 55], ['si-485', 56], ['si-486', 57],
        ['si-487', 58], ['si-874', 59], ['si-416', 60], ['si-877', 61],
        ['si-878', 62], ['si-483', 63], ['si-1373', 64], ['si-1372', 65],
        ['si-1374', 66], ['si-415', 67], ['si-1379', 68], ['si-1375', 69],
        ['si-1381', 70], ['si-1402', 71], ['si-451', 72], ['si-1382', 73],
        ['si-1385', 74], ['si-1386', 75], ['si-1390', 76], ['si-1463', 77],
        ['si-1392', 78], ['si-445', 79], ['si-1394', 80], ['si-1377', 81],
        ['si-470', 82], ['si-1398', 83], ['si-7300', 84], ['si-1400', 85],
        ['si-1393', 86], ['si-1401', 87], ['si-454', 88], ['si-1406', 89],
        ['si-1408', 90], ['si-1409', 91], ['si-1411', 92], ['si-1387', 93],
        ['si-1413', 94], ['si-1417', 95], ['si-1418', 96], ['si-1412', 97],
        ['si-1419', 98], ['si-429', 99], ['si-1420', 100], ['si-1423', 101],
        ['si-7301', 102], ['si-1424', 103], ['si-1427', 104], ['si-1429', 105],
        ['si-1430', 106], ['si-1431', 107], ['si-1432', 108], ['si-1434', 109],
        ['si-1399', 110], ['si-1437', 111], ['si-1440', 112], ['si-1445', 113],
        ['si-444', 114], ['si-477', 115], ['si-1446', 116], ['si-478', 117],
        ['si-1450', 118], ['si-1447', 119], ['si-1452', 120], ['si-476', 121],
        ['si-1453', 122], ['si-1462', 123], ['si-1464', 124], ['si-1465', 125],
        ['si-1467', 126], ['si-1468', 127], ['si-1471', 128], ['si-1469', 129],
        ['si-1470', 130], ['si-1473', 131], ['si-1476', 132], ['si-875', 133],
        ['si-1475', 134], ['si-1478', 135], ['si-1479', 136], ['si-1474', 137],
        ['si-1477', 138], ['si-1482', 139], ['si-1483', 140], ['si-1484', 141],
        ['si-1485', 142], ['si-414', 143], ['si-417', 144], ['si-418', 145],
        ['si-419', 146], ['si-420', 147], ['si-421', 148], ['si-1442', 149],
        ['si-422', 150], ['si-424', 151], ['si-1444', 152], ['si-1410', 153],
        ['si-428', 154], ['si-430', 155], ['si-431', 156], ['si-433', 157],
        ['si-434', 158], ['si-435', 159], ['si-466', 160], ['si-1438', 161],
        ['si-1428', 162], ['si-1426', 163], ['si-1435', 164], ['si-1421', 165],
        ['si-439', 166], ['si-437', 167], ['si-440', 168], ['si-441', 169],
        ['si-463', 170], ['si-1376', 171], ['si-1378', 172], ['si-1383', 173],
        ['si-1391', 174], ['si-1403', 175], ['si-1407', 176], ['si-1415', 177],
        ['si-1422', 178], ['si-1425', 179], ['si-1433', 180], ['si-1454', 181],
        ['si-1455', 182], ['si-1448', 183], ['si-1456', 184], ['si-1458', 185],
        ['si-1461', 186], ['si-1466', 187], ['si-1472', 188], ['si-468', 189],
        ['si-432', 190], ['si-467', 191], ['si-1481', 192], ['si-484', 193],
        ['si-876', 194], ['si-1388', 195], ['si-1389', 196], ['si-1397', 197],
        ['si-1384', 198], ['si-1459', 199], ['si-1414', 200], ['si-1449', 201],
        ['si-1480', 202]
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
            text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/si/si-all.topo.json">Slovenia</a>'
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