'use strict'
let form = document.getElementById('register-form');

let inputs = {
    inputName : document.querySelector('.input-Name'),
    inputEmail : document.querySelector('.input-Email'),
    inputPwd : document.querySelector('.input-Pwd'),
    inputConfirmPwd : document.querySelector('.inputConfirm-Pwd')
}


let inputNameFeedback = document.querySelector('.username-feedback');
let inputEmailFeedback = document.querySelector('.email-feedback');
let inputPasswordFeedback = document.querySelector('.password-feedback');
let inputConfirmPasswordFeedback = document.querySelector('.confirm-password-feedback')

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(document.getElementById('register-form'));

    formData.append('name', inputs.inputName.value);
    formData.append('email', inputs.inputEmail.value);
    formData.append('password', inputs.inputPwd.value);
    formData.append('confirmPassword', inputs.inputConfirmPwd.value);

    
    fetch('http://localhost/MovieApp/users/register', {
            method: 'post',
            body: formData
        }) 
        .then(res => {
            try {
                return res.json();
            }
            catch(e) {
                throw new Error(e);
            }
        })
        .then(data => {
            console.log(data);
            this.handleResponse(data);
        })
        .catch(err => {
            console.log(err);
        })
});

function handleResponse(responseObject) {
    console.log(responseObject);

    if(!(responseObject.isValid)) {
        if(responseObject.messages.name_err) {
            inputs.inputName.classList.add('is-invalid');
            inputNameFeedback.innerHTML = responseObject.messages.name_err;
        } else if(responseObject.messages.name_err === '') {
            inputs.inputName.classList.remove('is-invalid');
            inputs.inputName.classList.add('is-valid');
        }

        if(responseObject.messages.email_err) {
            inputs.inputEmail.classList.add('is-invalid');
            inputEmailFeedback.innerHTML = responseObject.messages.email_err;
        } else if(responseObject.messages.email_err === '') {
            inputs.inputEmail.classList.remove('is-invalid');
            inputs.inputEmail.classList.add('is-valid');
        }

        if(responseObject.messages.password_err) {
            inputs.inputPwd.classList.add('is-invalid');
            inputPasswordFeedback.innerHTML = responseObject.messages.password_err;
        } else if(responseObject.messages.password_err === '') {
            inputs.inputPwd.classList.remove('is-invalid');
            inputs.inputPwd.classList.add('is-valid');
        }

        if(responseObject.messages.confirm_password_err) {
            inputs.inputConfirmPwd.classList.add('is-invalid');
            inputConfirmPasswordFeedback.innerHTML = responseObject.messages.confirm_password_err;
        } else if(responseObject.messages.confirm_password_err === '') {
            inputs.inputConfirmPwd.classList.remove('is-invalid');
            inputs.inputConfirmPwd.classList.add('is-valid');
        }
    }
    else if(responseObject.isValid && responseObject.messages.registration_success != '') {
        for(let input in inputs) {
            if(inputs.hasOwnProperty(input)) {
                inputs[input].classList.remove('is-invalid');
                inputs[input].classList.add('is-valid');
            }
        }

        Cookie.setCookie('registration_success', responseObject.messages.registration_success);
        window.location.href = 'http://localhost/MovieApp/users/login';
    }
}