var map;
var markers = [];
var Servidor = 'arsat.frontend';  // Servidor de implementación
//var Servidor = 'localhost';  // Servidor local de desarrollo

function ubicarNodos() {
    // Inicializamos el mapa en una posición específica con los controles 
    // necesarios
    inicializarMapa();
    leyendaObras();
    
    let ruta = '';
    switch(tipoUsuario){
        case 1:
            ruta = 'nodos';
            break;
        case 2:
            ruta = 'arsat';
            break;
        case 3:
            ruta = 'ejesa';
            break;
        default:
            ruta = 'no definido';
            console.log(ruta);
            break;
    }

    // Cargamos los nodos que recibimos en la variable "nodos" enviada desde la vista
    for (i = 0; i < nodos.length; i++) {
        addMarker(nodos[i], ruta);
    }
}

function verNodo() {
    // Inicializamos el mapa en una posición específica con los controles 
    // necesarios
    inicializarMapa();

    var latitud = nodo['latitud'];
    var longitud = nodo['longitud'];

    //Validar si la latitud y/o longitud son distintas de nulo

    var marker = new google.maps.Marker({
        map: map,
        title: 'Ubicación del nodo',
        position: {lat: latitud, lng: longitud}
    });

    map.setCenter({lat: latitud, lng: longitud});
    map.setZoom(12);
}

function inicializarMapa() {
    var mapOptions = {
        center: new google.maps.LatLng(-23.211058276488195, -65.7806396484375),
        zoom: 8, //Not required.
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        fullscreenControl: true
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    var centerControlDiv = document.createElement('div');
    //var centerControl = new CenterControl(centerControlDiv, map);

    centerControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
}

function addMarker(nodo, ruta) {
    let id = nodo['id'];
    let nombre = nodo['nombre'];
    let departamento = nodo['departamento'];
    let municipio = nodo['municipio'];
    let localidad = nodo['localidad'];
    let latitud = nodo['latitud'];
    let longitud = nodo['longitud'];
    let prioridad = nodo['prioridad'];
    
    var iconos = [
        'http://' + Servidor + '/img/estado-rojo.png',
        'http://' + Servidor + '/img/estado-amarillo.png',
        'http://' + Servidor + '/img/estado-verde.png',
    ];

    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 225
    });
    var marker = new google.maps.Marker({
        position: {lat: latitud, lng: longitud},
        map: map,
        title: nombre
    });

    let url = '';
    switch (nodo['estadoSitio']) {
        case 1:
            url = iconos[0];
            break;
        case 2:
            url = iconos[1];
            break;
        case 3:
            url = iconos[2];
            break;
        default:
            estadoSitio = 'No definido';
            console.log('Error de estadoSitio de nodo');
            break;
    }

    // Definimos la imagen de icono que llevará el marcador de mapa
    var image = {
        url,
        size: new google.maps.Size(15, 15),
        origin: null,
        anchor: null,
        scaledSize: new google.maps.Size(15, 15)
    };
    marker.setIcon(image);

    // Definir "listener" de eventos
    google.maps.event.addListener(marker, "click", function (e) {
        var contenido =
                "<div>"
                + "<h5>" + nombre + "</h5>"
                + "<b>Departamento:</b> " + departamento + "</br>"
                + "<b>Municipio:</b> " + municipio + "</br>"
                + "<b>Localidad:</b> " + localidad + "</br>"
                + "<b>Prioridad:</b> " + prioridad + "</br>"
                + "<b>Latitud:</b> " + latitud + "</br>"
                + "<b>Longitud:</b> " + longitud + "</br>"
                + "<a href='http://" + Servidor + "/" + ruta + "/view?id=" + id + "' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-info-sign'></span> Ver<a/>" + "</br>"
                + "</div>";

        infoWindow.setContent(contenido);
        infoWindow.open(map, marker);
    });

    markers.push(marker);
}

function leyendaObras() {
    var legend = document.getElementById('legend');

    //Leyendas de Estados
    var div = document.createElement('div');
    div.innerHTML = '<h4>Estado de Nodos</h4>' +
            '<table>' +
            '<tr><td align="center" valign="middle"><img id="estadoObra" src="' + 'http://' + Servidor + '/img/estado-rojo.png' + '"></td>' + '<td>' + ' Finalizado' + '</td></tr>' +
            '<tr><td align="center" valign="middle"><img id="estadoObra" src="' + 'http://' + Servidor + '/img/estado-amarillo.png' + '"></td>' + '<td>' + ' Obra' + '</td></tr>' +
            '<tr><td align="center" valign="middle"><img id="estadoObra" src="' + 'http://' + Servidor + '/img/estado-verde.png' + '"></td>' + '<td>' + ' Pendiente' + '</td></tr>' +
            '</table>';
    legend.appendChild(div);

    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
}