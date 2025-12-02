const validation = new JustValidate("#signup");

validation
    .addField("#name", [
        {
            rule: "required",
            errorMessage: "El nombre es obligatorio"
        },
        {
            rule: "minLength",
            value: 3,
            errorMessage: "El nombre debe tener al menos 3 caracteres"
        }
    ])
    .addField("#email", [
        {
            rule: "required",
            errorMessage: "El email es obligatorio"
        },
        {
            rule: "email",
            errorMessage: "Ingresa un email válido"
        },
        {
            validator: (value) => () => {
                // CORRECCIÓN: Si el campo está vacío, detenemos la validación aquí
                // y devolvemos 'true' para que no salte el error de "ya registrado".
                // (El error de "obligatorio" saltará por la primera regla).
                if (!value) {
                    return true;
                }

                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(json) {
                        // Asegúrate de que tu PHP devuelva { "available": true } o false
                        return json.available;
                    });
            },
            errorMessage: "Este email ya está registrado"
        }
    ])
    .addField("#password", [
        {
            rule: "required",
            errorMessage: "La contraseña es obligatoria"
        },
        {
            rule: "minLength",
            value: 8,
            errorMessage: "La contraseña debe tener al menos 8 caracteres"
        },
        {
            rule: "password",
            errorMessage: "La contraseña debe contener letras y números"
        }
    ])
    .addField("#password_confirmation", [
        {
            rule: "required",
            errorMessage: "Confirma tu contraseña"
        },
        {
            validator: (value, fields) => {
                // Compara con el valor del campo password
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Las contraseñas no coinciden"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });