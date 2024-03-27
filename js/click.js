var formulario = document.getElementById('main_form');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function(e){
    e.preventDefault();

    var datos = new FormData(formulario);

    // Agrega los valores de latitud y longitud al FormData
    var latitud = document.getElementById('latinput').value;
    var longitud = document.getElementById('loninput').value;
    datos.append('latinput', latitud);
    datos.append('loninput', longitud);

    fetch('cgi/muestra.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data === 'error'){
            respuesta.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Llena todos los campos
                </div> 
            `;
        } else {
            respuesta.innerHTML = `
                <div class="alert alert-primary" role="alert">
                    ${data}
                </div> 
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
