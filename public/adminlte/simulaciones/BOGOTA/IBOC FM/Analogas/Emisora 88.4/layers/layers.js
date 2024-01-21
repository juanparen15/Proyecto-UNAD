var wms_layers = [];

var format_Signallevel_0 = new ol.format.GeoJSON();
var features_Signallevel_0 = format_Signallevel_0.readFeatures(json_Signallevel_0, {
    dataProjection: 'EPSG:4326',
    featureProjection: 'EPSG:3857'
});

var jsonSource_Signallevel_0 = new ol.source.Vector({
    attributions: ' ',
});

jsonSource_Signallevel_0.addFeatures(features_Signallevel_0);

var lyr_Signallevel_0 = new ol.layer.Vector({
    declutter: true,
    source: jsonSource_Signallevel_0,
    style: style_Signallevel_0,
    interactive: true,
});

// Crear la capa lyr_Cobertura y asignarle el mismo imageExtent que lyr_Bestserver
var imageExtentSignalLevel = lyr_Signallevel_0.getSource().getExtent();
// Recorrer las características de json_Bestserver_1 para encontrar la correcta
var desiredExtent = null; // Debes establecer la extensión correcta aquí

jsonSource_Signallevel_0.forEachFeature(function (feature) {
    if (feature.get('Name') === 'X:7 Y:37 Z:62') {
        // Encontraste la característica deseada, obtén la extensión
        var geometry = feature.getGeometry();
        desiredExtent = geometry.getExtent(); // Obtiene la extensión
    }
});

var lyr_BestServer = new ol.layer.Image({
    opacity: 0.8,
    title: "Signal level",
    source: new ol.source.ImageStatic({
        url: "./layers/img_37_62_7_2.png",
        attributions: ' ',
        projection: 'EPSG:3857',
        alwaysInRange: true,
        imageExtent: desiredExtent
    })
});

var format_Radioelectricelements_1 = new ol.format.GeoJSON();
var features_Radioelectricelements_1 = format_Radioelectricelements_1.readFeatures(json_Radioelectricelements_1,
    { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });
var jsonSource_Radioelectricelements_1 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Radioelectricelements_1.addFeatures(features_Radioelectricelements_1);
var lyr_Radioelectricelements_1 = new ol.layer.Vector({
    declutter: true,
    source: jsonSource_Radioelectricelements_1,
    style: style_Radioelectricelements_1,
    interactive: true,
    title: '<img src="styles/legend/Radioelectricelements_1.png" /> Radioelectric elements'
});

var lyr_GoogleSatellite_3 = new ol.layer.Tile({
    'title': 'Google Satellite',
    'type': 'base',
    'opacity': 0.7,


    source: new ol.source.XYZ({
        attributions: ' &middot; <a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>',
        url: 'https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
    })
});
var group_Emisora_Bogot_884_MHz = new ol.layer.Group({
    layers: [lyr_Signallevel_0, lyr_Radioelectricelements_1, lyr_BestServer,],
    title: "Emisora_Bogotá_88.4_MHz"
});

lyr_Signallevel_0.setVisible(true); lyr_Radioelectricelements_1.setVisible(true); lyr_GoogleSatellite_3.setVisible(true); lyr_BestServer.setVisible(true);
var layersList = [group_Emisora_Bogot_884_MHz, lyr_GoogleSatellite_3];
lyr_Signallevel_0.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Radioelectricelements_1.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Signallevel_0.set('fieldImages', { 'Name': '', 'description': '', 'timestamp': '', 'begin': '', 'end': '', 'altitudeMode': '', 'tessellate': '', 'extrude': '', 'visibility': '', 'drawOrder': '', 'icon': '', });
lyr_Radioelectricelements_1.set('fieldImages', { 'Name': 'TextEdit', 'description': 'TextEdit', 'timestamp': 'DateTime', 'begin': 'DateTime', 'end': 'DateTime', 'altitudeMode': 'TextEdit', 'tessellate': 'Range', 'extrude': 'Range', 'visibility': 'Range', 'drawOrder': 'Range', 'icon': 'TextEdit', });
lyr_Signallevel_0.set('fieldLabels', {});
lyr_Radioelectricelements_1.set('fieldLabels', {});
lyr_Radioelectricelements_1.on('precompose', function (evt) {
    evt.context.globalCompositeOperation = 'normal';
});