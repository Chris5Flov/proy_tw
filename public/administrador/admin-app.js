$(document).ready(function() {
    let edit = false;
    listarRecursos();

    cargarDashboard();

    function cargarDashboard() {
        $.ajax({
            url: 'acciones_archivos.php?accion=dashboard',
            type: 'GET',
            success: function(data) {
                $('#metric-total').text(data.total);

                const tiposLabels = data.por_tipo.map(x => x.tipo);
                const tiposValues = data.por_tipo.map(x => x.total);

                new Chart(document.getElementById("chartTipos"), {
                    type: "doughnut",
                    data: {
                        labels: tiposLabels,
                        datasets: [{
                            data: tiposValues,
                            backgroundColor: ["#4a69ff", "#28a745", "#ffc107", "#dc3545"],
                        }]
                    },
                });

                const autoresLabels = data.top_autores.map(x => x.autor);
                const autoresValues = data.top_autores.map(x => x.total);
                const autoresColores = [
                    "#4a69ff",
                    "#E6171F",
                    "#86F0DB",
                    "#5EE32D",
                    "#9C1DDB"
                ];
                new Chart(document.getElementById("chartAutores"), {
                    type: "bar",
                    data: {
                        labels: autoresLabels,
                        datasets: [{
                            label: "Recursos",
                            data: autoresValues,
                            backgroundColor: autoresColores
                        }]
                    },

                });
            }
        });
    }   

    function listarRecursos() {
        $.ajax({
            url: 'acciones_archivos.php?accion=listar',
            type: 'GET',
            success: function(response) {
                let recursos = response; 
                let template = '';
                recursos.forEach(recurso => {
                    template += `
                        <tr resourceId="${recurso.id}">
                            <td>${recurso.id}</td>
                            <td><a href="#" class="resource-item" style="font-weight:bold; color:#333;">${recurso.nombre}</a></td>
                            <td>${recurso.autor_o_empresa}</td>
                            <td><span class="badge">${recurso.tipo}</span></td>
                            <td style="text-align: center;">
                                <button class="resource-delete btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>`;
                });
                $('#resources-list').html(template);
            }
        });
    }

    
    $('#search').keyup(function() {
        let search = $('#search').val();
        if(search) {
            $.ajax({
                url: 'acciones_archivos.php?accion=buscar',
                type: 'GET',
                data: { search },
                success: function(response) {
                    let recursos = response;
                    let template = '';
                    recursos.forEach(recurso => {
                        template += `
                            <tr resourceId="${recurso.id}">
                                <td>${recurso.id}</td>
                                <td><a href="#" class="resource-item" style="font-weight:bold; color:#333;">${recurso.nombre}</a></td>
                                <td>${recurso.autor_o_empresa}</td>
                                <td><span class="badge">${recurso.tipo}</span></td>
                                <td style="text-align: center;">
                                    <button class="resource-delete btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>`;
                    });
                    $('#resources-list').html(template);
                }
            });
        } else {
            listarRecursos();
        }
    });

   
    $('#resource-form').submit(function(e) {
    e.preventDefault();
    
    
    const postData = {
        nombre: $('#nombre').val().trim(),
        autor_o_empresa: $('#autor_o_empresa').val().trim(),
        descripcion: $('#descripcion').val().trim(),
        tipo: $('#tipo').val(),
        ruta_archivo: $('#ruta_archivo').val().trim(),
        id: $('#resourceId').val()
    };

    
    if(postData.nombre === "") {
        alert("El nombre es obligatorio");
        $('#nombre').focus(); 
        return; 
    }

    if(postData.autor_o_empresa === "") {
        alert("El autor o empresa es obligatorio");
        $('#autor_o_empresa').focus();
        return;
    }

    if(postData.descripcion === "") {
        alert("La descripción no puede estar vacía");
        $('#descripcion').focus();
        return;
    }

    if(postData.ruta_archivo === "") {
        alert("Debes escribir la ruta del archivo");
        $('#ruta_archivo').focus();
        return;
    }

      
        let accion = edit === false ? 'agregar' : 'editar';

        $.ajax({
            url: 'acciones_archivos.php?accion=' + accion, 
            type: 'POST',
            data: JSON.stringify(postData),
            contentType: 'application/json',
            success: function(response) {
                alert(response.message);
                listarRecursos();
                $('#resource-form')[0].reset();
                edit = false;
                $('button[type="submit"]').text('Agregar').removeClass('btn-warning').addClass('btn-success');
                $('#btn-cancel').hide();
            }
        });
    });

    $(document).on('click', '.resource-item', function() {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('resourceId');
        
        $.post('acciones_archivos.php?accion=obtener', {id}, function(response) { // <--- RUTA LOCAL
            
            $('#resourceId').val(response.id);
            $('#nombre').val(response.nombre);
            $('#autor_o_empresa').val(response.autor_o_empresa);
            $('#descripcion').val(response.descripcion);
            $('#tipo').val(response.tipo);
            $('#ruta_archivo').val(response.ruta_archivo);
            
            edit = true;
            $('button[type="submit"]').text('Guardar Cambios').removeClass('btn-success').addClass('btn-warning');
            $('#btn-cancel').show();
        });
    });

    
    $(document).on('click', '.resource-delete', function() {
        if(confirm('¿Eliminar recurso?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('resourceId');
            
            $.post('acciones_archivos.php?accion=eliminar', {id}, function(response) { // <--- RUTA LOCAL
                alert(response.message);
                listarRecursos();
            });
        }
    });
    
    $('#btn-cancel').click(function(){
        edit = false;
        $('#resource-form')[0].reset();
        $('button[type="submit"]').text('Agregar').removeClass('btn-warning').addClass('btn-success');
        $(this).hide();
    });
});