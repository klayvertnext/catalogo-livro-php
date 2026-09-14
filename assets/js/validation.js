document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.book-form');

    if (!form) {
        return;
    }

    const titulo = document.getElementById('titulo');
    const autor = document.getElementById('autor');
    const categoria = document.getElementById('categoria');
    const status = document.getElementById('status');

    function mostrarErro(campo, mensagem) {
        const grupo = campo.closest('.form-group');

        if (!grupo) {
            return;
        }

        const erro = grupo.querySelector('.error-message');

        campo.classList.add('input-error');

        if (erro) {
            erro.textContent = mensagem;
        }
    }

    function limparErro(campo) {
        const grupo = campo.closest('.form-group');

        if (!grupo) {
            return;
        }

        const erro = grupo.querySelector('.error-message');

        campo.classList.remove('input-error');

        if (erro) {
            erro.textContent = '';
        }
    }

    function validarCampo(campo) {
        limparErro(campo);

        const valor = campo.value.trim();

        if (valor === '') {
            mostrarErro(campo, 'Este campo é obrigatório.');
            return false;
        }

        return true;
    }

    titulo.addEventListener('input', function () {
        limparErro(titulo);
    });

    autor.addEventListener('input', function () {
        limparErro(autor);
    });

    categoria.addEventListener('input', function () {
        limparErro(categoria);
    });

    status.addEventListener('change', function () {
        limparErro(status);
    });

    form.addEventListener('submit', function (event) {
        let formularioValido = true;

        if (!validarCampo(titulo)) {
            formularioValido = false;
        }

        if (!validarCampo(autor)) {
            formularioValido = false;
        }

        if (!validarCampo(categoria)) {
            formularioValido = false;
        }

        if (!validarCampo(status)) {
            formularioValido = false;
        }

        if (titulo.value.trim().length > 150) {
            mostrarErro(
                titulo,
                'O título deve ter no máximo 150 caracteres.'
            );

            formularioValido = false;
        }

        if (autor.value.trim().length > 120) {
            mostrarErro(
                autor,
                'O autor deve ter no máximo 120 caracteres.'
            );

            formularioValido = false;
        }

        if (categoria.value.trim().length > 80) {
            mostrarErro(
                categoria,
                'A categoria deve ter no máximo 80 caracteres.'
            );

            formularioValido = false;
        }

        const statusPermitidos = [
            'disponivel',
            'indisponivel'
        ];

        if (!statusPermitidos.includes(status.value)) {
            mostrarErro(
                status,
                'Selecione um status válido.'
            );

            formularioValido = false;
        }

        if (!formularioValido) {
            event.preventDefault();

            const primeiroErro = form.querySelector('.input-error');

            if (primeiroErro) {
                primeiroErro.focus();
            }
        }
    });
});