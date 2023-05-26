document.addEventListener("DOMContentLoaded", function (){

    this.forms[0].addEventListener("submit", function (e) {
        e.preventDefault();

        pageSubmit(this)

        .then(function (response) {
            openModal(
                "Verifique o seu email",
                "Enviamos um email para confirmar sua conta e garantir seu acesso!",
                "Acesse o seu email e clique no link de confirmação"
            );
        })

        .catch(function (error) {
            openModal(
                "Oops :(",
                "Algo de errado não está certo!",
                error.message,
            );
        });
    });
});


async function pageSubmit(form){

    /** get usuarios */
    const usuarios = await get('usuarios');

    /** verfifica se o email já está cadastrado */
    const usuariosComMesmoEmail = usuarios.filter((user) => (user.email == form.inp_email.value))
    if (usuariosComMesmoEmail.length > 0) {
        throw new Error("Este email já está cadastrado no sistema");
    }

    /** post conta */
    const conta = await post('contas', {
        numero: Math.floor(Math.random() * 10000).toString()
    });

    /** post pessoa */
    const pessoa = await post('pessoas', {
            telefone: form.inp_tel.value.replace(/\D/g, '')
    })

    /** post pessoaFisica */
    const pessoaFisica = await post('pessoas/fisicas', {
        pessoa: `api/pessoas/${ pessoa.id }`,
        nome: form.inp_name.value
    });

    /** post usuario */
    const usuario = await post('usuarios', {
        pessoa: `api/pessoas/${ pessoa.id }`,
        email: form.inp_email.value,
        senha: form.inp_pass.value,
        grupoUsuario: `api/usuarios/grupos/1`,
        conta: `api/contas/${ conta.id }`
    });

    return {
        conta: conta,
        pessoa: pessoa,
        pessoaFisica: pessoaFisica,
        usuario: usuario
    };
}

async function openModal(textHeader, textBody, textFooter){
    const fade      =   document.querySelector(".fade");

    fade.querySelector("#textHeader").innerText = textHeader;
    fade.querySelector("#textBody").innerText = textBody;
    fade.querySelector("#textFooter").innerText = textFooter;

    fade.style.display = "inherit";
}

async function post (uri, data) {
    return await fetch(`http://localhost:3001/api/${ uri }`, {
        method: "POST",
        headers: {
            "content-type": "application/json",
            "accept": "application/json"
        },
        body: JSON.stringify(data)
    }).then((response) => response.json());
}

async function get (uri) {
    return await fetch(`http://localhost:3001/api/${ uri }`, {
        method: "GET",
        headers: {
            "content-type": "application/json",
            "accept": "application/json"
        }
    }).then((response) => response.json());
}