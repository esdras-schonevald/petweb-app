class Password
{
    static disableMenuItem(){
        let a   =   document.querySelector('#alterar_senha > a');

        a.style.pointerEvents   =   'none';
        a.style.color           =   '#CCC';
        a.style.backgroundColor =   'rgba(0, 0, 0, 0.2)';
    }

    static confirm() {
        let newPassword     =   document.querySelector('#newPassword');
        let confirmPassword =   document.querySelector('#confirmPassword');

        if (confirmPassword.value != newPassword.value) {
            confirmPassword.setCustomValidity('As senhas não conferem');
            return false;
        }

        confirmPassword.setCustomValidity('');

        return true;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    Password.disableMenuItem();

    document.forms[0].addEventListener('submit', function (e) {
        e.preventDefault();
        if (Password.confirm()){
            this.submit();
        }
    }, false);

}, false);