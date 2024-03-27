   /******************************************************************/
   /* SCRIPTS FORMULARIO HERRAMIENTA PARA MANEJO MAPA VENTANA MODAL */
   /****************************************************************/ 

/****************************************************************/ 
/* DEFINICIÓN DE VARIABLES GLOBALES */
/****************************************************************/


/* Coordenadas en EPSG:4326 */

var lat = null;
var lon = null;

/* Mapa */
var map = null;
//var extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte
var extent = [-19.0, 27.0, 5.0, 44.0];  // Oeste, Sur, Este, Norte

/* Marker (Marcador/icono gráfico de la posición en el mapa): */

var feature = null;   
var vectorSource = new ol.source.Vector();
var vectorLayer = new ol.layer.Vector({
    source: vectorSource
});

var iconStyle = new ol.style.Style({
    image: new ol.style.Icon({
        src: 'img/ol//marker.png'
        //src: 'img/ol//marcador_p1.png'
        //src: '//openlayers.org/en/v3.8.2/examples/data/icon.png'
    }) 
});

/* Main map in OpenLayers*/

function loadMap () {
      map = new ol.Map({
        target: 'art-risk_map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }), vectorLayer
        ],
        view: new ol.View({
        	 projection: 'EPSG:4326',
          center: [-3.70, 40.41],
			 zoom: 5          
          //zoom: 5,
          //maxZoom: 15
        })
      });
}


/* Carga del Mapa en la ventana modal */
//$('#progress-bar1').hide();
loadMap();

             
        
/****************************************************************/ 
/* EVENTOS ASOCIADOS AL MAPA MODAL */      
/****************************************************************/ 

document.getElementById('validate_coordinates_button').onclick = function() {
	document.getElementById('error_coordinates_messages').innerHTML =null;
	//asignar_valores_a_todas_las_variables (5.0);
	if (check_coordinates (extent) ) {
			var coord_lat_lon = new Array (2);
			coord_lat_lon[0] = lat;
			coord_lat_lon[1] = lon;

			console.log(coord_lat_lon);

			$('#progress-bar1').show();
			
			// ENVIO DATOS UNA VEZ VERIFICADO NO HAY ERRORES:
			$.ajax({
    			type: "POST",
    			url: 'cgi/art-risk3-map.php',
    			async: true,
    			//data: {coordArray: coord_pixels},
    			data: {coordArray: coord_lat_lon},
    			
    			success: function(data){
    				var tmp = data.split(",");
    				if (check_values_returned (tmp)) {
    					// AR01-Geotecnia
    					document.getElementById('id_v1').value = tmp[0];
     					// AR016-Precipitación media
    					document.getElementById('id_v16').value = tmp[1];    				
    					// AR017-Erosión por lluvia
    					document.getElementById('id_v17').value = tmp[2];   			
    					// AR018-Estrés térmico
    					document.getElementById('id_v18').value = tmp[3];   			    				
    					// AR019-Heladas
    					document.getElementById('id_v19').value = tmp[4];   			   
    					// AR020-Riesgo por sismo
    					document.getElementById('id_v20').value = tmp[5];   			   
    					// AR021-Riesgo de Inundación
    					document.getElementById('id_v21').value = tmp[6];   
    					// Feedback al usuario			   
   					document.getElementById('error_coordinates_messages').innerHTML ="Variables de entrada 1 y 16 a 21 asignadas correctamente";
						document.getElementById('error_coordinates_messages').style.color='black';
						//document.getElementById('error_coordinates_messages').innerHTML +="<br> Data: "+data+"   " + "<br> TMP: "+tmp;
    				} else {
    					// AR01-Geotecnia
    					document.getElementById('id_v1').value = "";
     					// AR016-Precipitación media
    					document.getElementById('id_v16').value = "";    				
    					// AR017-Erosión por lluvia
    					document.getElementById('id_v17').value = "";   			
    					// AR018-Estrés térmico
    					document.getElementById('id_v18').value = "";   			    				
    					// AR019-Heladas
    					document.getElementById('id_v19').value = "";   			   
    					// AR020-Riesgo por sismo
    					document.getElementById('id_v20').value = "";   			   
    					// AR021-Riesgo de Inundación
    					document.getElementById('id_v21').value = "";       				
    				}
    				$('#progress-bar1').hide();
    				$('#progress-bar1').css({  "width": 0 + "%"  });
    			},
    			error: function(data){
    				$('html, body').css("cursor", "auto");
					alert("Ha ocurrido un error en la conexión: "+data+" " +JSON.stringify(data)); //===Show Error Message====
				},
				// Progress Bar				
 				xhr: function () {
      			var xhr = new window.XMLHttpRequest();
      			//Upload Progress      			
      			xhr.upload.addEventListener("progress", 
      				
      				function (evt) {
         				if (evt.lengthComputable) {
         					setTimeout (null, 20);
        						var percentComplete = (evt.loaded / evt.total) * 100; 
        						$('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); 
        					} 
        				}, false);
					//Download progress
					/* 
 					xhr.addEventListener("progress", function (evt) {
 						if (evt.lengthComputable) { 
 							var percentComplete = (evt.loaded / evt.total) *100;
 							$("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } 
 					},false);
 					 */
					return xhr;
				}			
				// Hide Progress Bar
				//done: function () {
				//	$('#progress-bar1').hide();
				//}
				
		});
	}
	
};



/* Evento necesario para que el mapa se muestre al cargar la ventana modal */

 $('#myModal').on('shown.bs.modal', function () {
        map.updateSize();
     });



/* ************************************************************** */   
/* EVENTOS ASOCIADOS A LOS BOTONES DE LA VENTANA MODAL Y SU MAPA */  
/* ************************************************************* */    
 
document.getElementById('button_accept_modal').onclick = function() {
	document.getElementById('error_coordinates_messages').innerHTML =null;
	if (lat!=null && lon!=null) {
		document.getElementById('latinput').value =  lat;
   	document.getElementById('loninput').value =  lon;
	}
};
      
      
document.getElementById('button_cancel_modal').onclick = function() {
	document.getElementById('error_coordinates_messages').innerHTML = null;
};
        
   
map.on('click', function(evt) {
        var coordinate = evt.coordinate;
        lon = coordinate[0];
        lat = coordinate[1];
 
        document.getElementById('id_lat_modal').value =  lat;
        document.getElementById('id_lon_modal').value =  lon;


        /* Borrar el anterior marcador en el mapa para dibujar el nuevo */
		  if (feature !== null ) {
		  	vectorSource.removeFeature(feature);    
		  }		  
 		  feature = new ol.Feature(
        	new ol.geom.Point(evt.coordinate)
    		);
    	  feature.setStyle(iconStyle);
    	  vectorSource.addFeature(feature);        
        
  });   
     

   
/* ***************************************** */   
/* ****** FUNCIONES AUXILIARES ************* */   
/* ***************************************** */ 
 
/* Funciones para la conversion de coordenadas de grados a metros  */  

function degrees2meters (lon,lat) {
   var x = lon * 20037508.34 / 180;
   var y = Math.log(Math.tan((90 + lat) * Math.PI / 360)) / (Math.PI / 180);
   y = y * 20037508.34 / 180;
   return [x, y]
}       

function meters2degrees (x,y) { 
  var lon = x *  180 / 20037508.34 ;
  var lat = Math.atan(Math.exp(y * Math.PI / 20037508.34)) * 360 / Math.PI - 90; 
  return [lon, lat]
}       

/* Función para el mapeo de una coordenada EPSG:4326 a un pixel de la imagen */

function map_coordinates_to_pixel (latitude, longitude, extent_map, image_dimension) {
	//var extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];
	
	/* *
	var width_image = 1024;
	var height_image = 735;
	/* */
	var width_image = image_dimension[0];
	var height_image = image_dimension[1];
	
	// X and Y boundaries
	/* *
	var westLong = -20.41080340912;
	var eastLong = 6.58919659088;
	var northLat = 45.40273792685601;
	var southLat = 26.022737926856;
	/* */
	var westLong = extent_map[0];
	var southLat = extent_map[1];
	var eastLong = extent_map[2];
	var northLat = extent_map[3];


	var coord = new Array (2);
	coord[0] = Math.round( width_image * ((westLong-longitude)/(westLong-eastLong)) );
	coord[1] = Math.round( height_image * ((northLat-latitude)/(northLat-southLat)) );

   return coord;
	
}


/* Validar validez coordenadas EPSG:4326 introducidas por el usuario */
function isInt(x) {
    return !isNaN(x) && eval(x).toString().length == parseInt(eval(x)).toString().length
}

function isFloat(x) {
    return !isNaN(x) && !isInt(eval(x)) && x.toString().length > 0;
}

function check_coordinates (extent_map) {
	var lat_user = document.getElementById('latinput').value;
	var lon_user = document.getElementById('loninput').value;
	document.getElementById('error_coordinates_messages').value = null;
	if (lat_user=="" || lon_user=="") {
		document.getElementById('error_coordinates_messages').innerHTML = "Error: debe seleccionar o introducir unas coordenadas";
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;
	} else if (isFloat(lat_user)!=1 || isFloat(lon_user)!=1) {
		document.getElementById('error_coordinates_messages').innerHTML = "Error: las coordenadas deben ser números con decimales (parte_entera.parte_decimal), y deben representar grados decimales de latitud y longitud (sistema EPSG:4326)";
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;
	} else if (lat_user < extent_map[1] || lat_user > extent_map[3]) {
		 // West, South, East, North
		// var extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601]; 
		document.getElementById('error_coordinates_messages').innerHTML = "Error en la latitud: no existen datos para esa latitud. El valor debe estar entre "+extent_map[3]+" y "+extent_map[1];
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;
	} else if (lon_user < extent_map[0] || lon_user > extent_map[2]) {
		 // West, South, East, North
		// var extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601]; 
		document.getElementById('error_coordinates_messages').innerHTML = "Error en la longitud: no existen datos para esa longitud. El valor debe estar entre "+extent_map[0]+" y "+extent_map[2];
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;
	} else {
		lat = lat_user;
		lon = lon_user;
		return 1;
	}
}


/* Función para validar respuesta desde php (contenido devuelto de las variables automáticas) 
	Devuelve -1 si todas las variables son -1, es decir, el usuario ha seleccionado un pixel
	dentro de los mapas que toca agua o territorio fuera de España (por ej. Portugal) */
function check_values_returned (vector) {
	var i, j, cont=0;
	var pos_vector = new Array(7);
	pos_vector[0] = 0;
	pos_vector[1] = 0;
	pos_vector[2] = 0;
	pos_vector[3] = 0;
	pos_vector[4] = 0;
	pos_vector[5] = 0;
	pos_vector[6] = 0;
	if (!Array.isArray(vector))	{
		// Lo que se ha recibido de PHP no es un array
		document.getElementById('error_coordinates_messages').innerHTML = "Error, los valores recibidos para asignar a las variables automáticas no son un vector: "+vector;
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;	
	} else if (vector.length != 8) {
		// El código PHP al que se le han pedido los datos ha fallado
		document.getElementById('error_coordinates_messages').innerHTML = "Error, no recibidos 7 valores para todas las variables automáticas. Recibidos: "+vector.length-1+" "+vector;
		document.getElementById('error_coordinates_messages').style.color='red';
		return 0;
	} else {
		for (i=0; i<vector.length-1; i++){
			if (vector[i] < 1.0 || vector[i] > 5.0) {
				cont++;
				pos_vector[i]++;
				j = i;
			}
		}
		if (cont>0) {
			// El usuario ha introducido una coordenada que no es parte del territorio español.
			// Puede haber seleccionado una zona de mar o por ejemplo Portugal.
			if (vector[0] == 8) {
				// En este caso el problema es que el mapa de Geotecnia no tenía datos para ese sitio.
				// Ver fichero /cgi/art-risk-map.php"
				document.getElementById('error_coordinates_messages').innerHTML = "Error: lamentablemente la herramienta no dispone de datos geotécnicos para esas coordenadas";
				document.getElementById('error_coordinates_messages').style.color='red';
			}	else {	
			
			document.getElementById('error_coordinates_messages').innerHTML = "Error: se ha seleccionado un punto en el mar, o bien o punto que queda fuera de España.";
			document.getElementById('error_coordinates_messages').style.color='red';
			
			//document.getElementById('error_coordinates_messages').style.color='green';
			//document.getElementById('error_coordinates_messages').innerHTML += "<br>"+vector+"<br>";
			//document.getElementById('error_coordinates_messages').style.color='red';
			}
			return 0;					
		}
	}
	return 1;
}


        
/* Funciones extra para depuración y validación del funcionamiento correcto de la herramienta */        

function asignar_valores_a_todas_las_variables (val) {
	for (i=1; i<=19; i++) {
		document.getElementById("id_v"+i).value=val;
	}
	
}
        