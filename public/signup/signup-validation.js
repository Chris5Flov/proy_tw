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
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(json) {
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
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Las contraseñas no coinciden"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });