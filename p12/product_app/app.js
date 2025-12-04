var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "",
    "imagen": "img/vacio.png"
};
$(function(){
    console.log('JQuery funcionando')
    listarProductos();
    let ocultarLista = false;
    var edit = false;
    let nombreRepetido = false;
    function listarProductos(){
        $.ajax({
            url: './backend/product-search.php',
            type: 'GET',
            success:function(response){
                let productos = JSON.parse(response);
                let template = '';
                let template_bar = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                    template_bar += ` <li>${producto.nombre}</li>`;
                });
                $('#products').html(template);
                
                if(ocultarLista == true){
                    $('#product-result').removeClass("card my-4 d-block").addClass("card my-4 d-none");
                    ocultarLista = false;
                }
            }
        });
    }

    $('#search').keyup(function(){
        let search = $('#search').val().trim();
        if (search){
            console.log(search);
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function(response){
                    let productos1 = JSON.parse(response);
                    let template = '';
                    let template_bar = '';
                    productos1.forEach(producto => {
                    // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                    //console.log(producto);

                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item">${producto.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;

                    template_bar += `
                        <li>${producto.nombre}</il>
                    `;
                });

                $('#product-result').addClass("card my-4 d-block");
                $('#container').html(template_bar);
                $('#products').html(template);

                }
            });
        }
        else{
            console.log("No hay resultados sin búsqueda.");
            listarProductos();
            ocultarLista = true;
        }
    })

    $('#name').keyup(function(){
        let name = $('#name').val().trim();
        if(name.length === 0){
            nombreRepetido = false;
            $('#name').removeClass("is-valid is-invalid");
            $('#name-status').addClass("d-none").text('');
            return;
        }
        $.ajax({
            url: './backend/product-name.php',
            type: 'POST',
            data: { name },
            success: function (response) {
                let respuesta = JSON.parse(response);
                if(respuesta.status == "success") {
                    nombreRepetido = false;
                    $('#name-status').removeClass("d-none text-danger").addClass("text-success").text(respuesta.message);
                    $('#name').removeClass("is-invalid").addClass("is-valid");
                }
                else{
                    nombreRepetido = true;
                    $('#name-status').removeClass("d-none text-success").addClass("text-danger").text(respuesta.message);
                    $('#name').removeClass("is-valid").addClass("is-invalid");
                }
            }
        })
    })

    function validarCampo(campo, condicion, mensaje) {
        if(condicion){
            $(`#${campo}-status`).text(mensaje).removeClass("d-none");
            $(`#${campo}`).addClass("is-invalid");
            return false;
        }
        $(`#${campo}-status`).addClass("d-none");
        $(`#${campo}`).removeClass("is-invalid").addClass("is-valid");
        return true;
    }

$('#name').on('blur', function(){
    let valor = $(this).val().trim();

    validarCampo(
        'name',
        valor.length === 0 || valor.length > 100 || nombreRepetido === true,
        valor.length === 0 || valor.length > 100
            ? "Nombre inválido (vacío o mayor a 100 caracteres)."
            : "Nombre ya registrado."
    );
});

    $('#precio').on('blur', function(){
        validarCampo('precio', $(this).val() < 100, "El precio mínimo es $100.");
    });

    $('#unidades').on('blur', function(){
        let valor = $(this).val().trim();
        validarCampo('unidades', valor === "" || parseInt(valor) < 0, "Las unidades deben ser un número y ser 0 o más."
        );
    });

    $('#modelo').on('blur', function(){
        validarCampo('modelo', $(this).val() === "" || $(this).val() === "XX-000", "Modelo obligatorio.");
    });

    $('#marca').on('blur', function(){
        validarCampo('marca', $(this).val() === "NA", "Selecciona una marca válida.");
    });

    $('#detalles').on('blur', function(){
        validarCampo('detalles', $(this).val().length > 250, "No más de 250 caracteres.");
    });

    $('#product-form').submit(function (e){
        $('button.btn-primary').text("Agregar Producto");
        e.preventDefault();

        let finalJSON = { ...baseJSON };

        finalJSON.nombre   = $('#name').val();
        finalJSON.precio   = parseFloat($('#precio').val());
        finalJSON.unidades = parseInt($('#unidades').val());
        finalJSON.modelo   = $('#modelo').val();
        finalJSON.marca    = $('#marca').val();
        finalJSON.detalles = $('#detalles').val() || "";
        finalJSON.imagen   = $('#imagen').val() || "img/vacio.png";
        finalJSON.id       = $('#productId').val();

        let template_bar = '';

        if(!finalJSON.nombre || finalJSON.nombre.length > 100){
            template_bar += '<li>Nombre vacío o con longitud superior a 100 caracteres.</li>';
        }
        if(finalJSON.precio < 100 || !finalJSON.precio){
            template_bar += '<li>El precio es obligatorio y su mínimo es de $100.</li>';
        }
        if(finalJSON.unidades < 0 || !finalJSON.unidades){
            template_bar += '<li>Las unidades son obligatorias y deben ser al menos 0.</li>';
        }
        if(!finalJSON.modelo || finalJSON.modelo ==="XX-000"){
            template_bar += '<li>Modelo obligatorio.</li>';
        }
        if(!finalJSON.marca || finalJSON.marca === "NA"){
            template_bar += '<li>Marca obligatoria.</li>';
        }  else {
            let marcasValidas = [
                "Samsung",
                "HP",
                "Asus",
                "Hisense",
                "Sony",
                "Xbox",
                "Apple",
                "Logitech"
            ]
            if (!marcasValidas.includes(finalJSON.marca)) {
                template_bar += '<li>Marca no encontrada. Posibles marcas: Samsung, HP, Asus, Hisense, Sony, Xbox, Apple, Logitech.</li>';
            }
        }

        if(finalJSON.detalles !== "NA" && finalJSON.detalles !== ""){
            if(finalJSON.detalles.length > 250){
                template_bar += '<li>Los detalles no deben ser más de 250 caracteres.</li>';
            }
        }
        else {
            finalJSON.detalles = "";
        }
        if(finalJSON.imagen === ""){
            finalJSON.imagen = "img/vacio.png";
        }
        if (template_bar !== '') {
            $('#product-result').removeClass("d-none").addClass("d-block");
            $('#product-result').show();
            $('#container').html('<ul>' + template_bar + '</ul>');
            ocultarCuadro = true;
            return;
        }

        if(nombreRepetido === true){
            $('#name').addClass("is-invalid");
            $('#name-status')
                .removeClass("d-none text-success")
                .addClass("text-danger")
                .text("El nombre del producto ya existe.");
            return;
        }

        let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.ajax({
            url: url,
            type: "POST",
            data: JSON.stringify(finalJSON),
            contentType: "application/json",
            success: function(response) {
                $('#product-form').trigger('reset');
                //init(); 
                console.log(response);
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $('#product-result').removeClass("d-none").addClass("d-block");
                $('#container').html(template_bar);

                $('button.btn-primary').text("Agregar Producto");
                edit = false;

                listarProductos();
            }
        });
        

    })

    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Estás seguro de querer eliminar este producto?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            console.log(id);

            $.post('./backend/product-delete.php', { id }, function (response) {
                console.log(response);
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $('#product-result').addClass("card my-4 d-block");
                $('#container').html(template_bar);
                listarProductos();
            })
        }
    })
    

    $(document).on('click', '.product-item', function () {
        if (confirm('¿Estás seguro de querer editar esto?')) {
            $('button.btn-primary').text("Modificar Producto");
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');

            $.post('./backend/product-single.php', { id }, function (response) {
                console.log(response);
                const product = JSON.parse(response);
                $('#name').val(product.nombre);
                $('#productId').val(product.id);

                const description = {
                    "precio": product.precio,
                    "unidades": product.unidades,
                    "modelo": product.modelo,
                    "marca": product.marca,
                    "detalles": product.detalles,
                    "imagen": product.imagen
                };

                $('#precio').val(product.precio);
                $('#unidades').val(product.unidades);
                $('#modelo').val(product.modelo);
                $('#marca').val(product.marca);
                $('#detalles').val(product.detalles);
                $('#imagen').val(product.imagen);
                edit = true;

                listarProductos();
            })
        }
    })

})
