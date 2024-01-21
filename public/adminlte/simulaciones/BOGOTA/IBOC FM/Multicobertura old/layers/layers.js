var wms_layers = [];

var format_Signallevel_0 = new ol.format.GeoJSON();
var features_Signallevel_0 = format_Signallevel_0.readFeatures(json_Signallevel_0,
    { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });
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

var lyr_Signallevel = new ol.layer.Image({
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

var lyr_BestServer = new ol.layer.Image({
    opacity: 0.8,
    title: "Best Server",
    source: new ol.source.ImageStatic({
        url: "./layers/img_37_62_7_3.png",
        attributions: ' ',
        projection: 'EPSG:3857',
        alwaysInRange: true,
        imageExtent: desiredExtent
    })
});

var lyr_Overlapping = new ol.layer.Image({
    opacity: 0.8,
    title: "Overlapping",
    source: new ol.source.ImageStatic({
        url: "./layers/img_37_62_7_4.png",
        attributions: ' ',
        projection: 'EPSG:3857',
        alwaysInRange: true,
        imageExtent: desiredExtent
    })
});

var format_Overlapping_1 = new ol.format.GeoJSON();
var features_Overlapping_1 = format_Overlapping_1.readFeatures(json_Overlapping_1,
    { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });
var jsonSource_Overlapping_1 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Overlapping_1.addFeatures(features_Overlapping_1);
var lyr_Overlapping_1 = new ol.layer.Vector({
    declutter: true,
    source: jsonSource_Overlapping_1,
    style: style_Overlapping_1,
    interactive: true,
});

var format_Bestserver_5 = new ol.format.GeoJSON();
var features_Bestserver_5 = format_Bestserver_5.readFeatures(json_Bestserver_5,
    { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });
var jsonSource_Bestserver_5 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Bestserver_5.addFeatures(features_Bestserver_5);
var lyr_Bestserver_5 = new ol.layer.Vector({
    declutter: true,
    source: jsonSource_Bestserver_5,
    style: style_Bestserver_5,
    interactive: true,
});
var format_Radioelectricelements_6 = new ol.format.GeoJSON();
var features_Radioelectricelements_6 = format_Radioelectricelements_6.readFeatures(json_Radioelectricelements_6,
    { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });
var jsonSource_Radioelectricelements_6 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Radioelectricelements_6.addFeatures(features_Radioelectricelements_6);
var lyr_Radioelectricelements_6 = new ol.layer.Vector({
    declutter: true,
    source: jsonSource_Radioelectricelements_6,
    style: style_Radioelectricelements_6,
    interactive: true,
    title: '<img src="styles/legend/Radioelectricelements_6.png" /> Radioelectric elements'
});

var lyr_GoogleSatellite_7 = new ol.layer.Tile({
    'title': 'Google Satellite',
    'type': 'base',
    'opacity': 0.6000000,


    source: new ol.source.XYZ({
        attributions: ' &middot; <a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>',
        url: 'https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
    })
});
var group_Cobertura_multitransmisor_Bogota = new ol.layer.Group({
    layers: [lyr_Signallevel_0, lyr_Overlapping_1, lyr_Bestserver_5, lyr_Radioelectricelements_6, lyr_Signallevel, lyr_BestServer, lyr_Overlapping,],
    title: "Cobertura_multitransmisor_Bogota"
});

lyr_Signallevel_0.setVisible(true); lyr_Overlapping_1.setVisible(true); lyr_Bestserver_5.setVisible(true); lyr_Radioelectricelements_6.setVisible(true); lyr_GoogleSatellite_7.setVisible(true);
var layersList = [group_Cobertura_multitransmisor_Bogota, lyr_GoogleSatellite_7];
lyr_Signallevel_0.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Overlapping_1.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Bestserver_5.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Radioelectricelements_6.set('fieldAliases', { 'Name': 'Name', 'description': 'description', 'timestamp': 'timestamp', 'begin': 'begin', 'end': 'end', 'altitudeMode': 'altitudeMode', 'tessellate': 'tessellate', 'extrude': 'extrude', 'visibility': 'visibility', 'drawOrder': 'drawOrder', 'icon': 'icon', });
lyr_Signallevel_0.set('fieldImages', { 'Name': '', 'description': '', 'timestamp': '', 'begin': '', 'end': '', 'altitudeMode': '', 'tessellate': '', 'extrude': '', 'visibility': '', 'drawOrder': '', 'icon': '', });
lyr_Overlapping_1.set('fieldImages', { 'Name': '', 'description': '', 'timestamp': '', 'begin': '', 'end': '', 'altitudeMode': '', 'tessellate': '', 'extrude': '', 'visibility': '', 'drawOrder': '', 'icon': '', });
lyr_Bestserver_5.set('fieldImages', { 'Name': 'TextEdit', 'description': 'TextEdit', 'timestamp': 'DateTime', 'begin': 'DateTime', 'end': 'DateTime', 'altitudeMode': 'TextEdit', 'tessellate': 'Range', 'extrude': 'Range', 'visibility': 'Range', 'drawOrder': 'Range', 'icon': 'TextEdit', });
lyr_Radioelectricelements_6.set('fieldImages', { 'Name': 'TextEdit', 'description': 'TextEdit', 'timestamp': 'DateTime', 'begin': 'DateTime', 'end': 'DateTime', 'altitudeMode': 'TextEdit', 'tessellate': 'Range', 'extrude': 'Range', 'visibility': 'Range', 'drawOrder': 'Range', 'icon': 'TextEdit', });
lyr_Signallevel_0.set('fieldLabels', {});
lyr_Overlapping_1.set('fieldLabels', {});
lyr_Bestserver_5.set('fieldLabels', {});
lyr_Radioelectricelements_6.set('fieldLabels', {});
lyr_Radioelectricelements_6.on('precompose', function (evt) {
    evt.context.globalCompositeOperation = 'normal';
});