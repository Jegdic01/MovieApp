'use strict'
class Login {
    constructor() {
        this.inputEmail = document.querySelector('.input-Email');
        this.inputPassword = document.querySelector('.input-Pwd');
        this.inputEmailFeedback = document.querySelector('.email-feedback');
        this.inputPasswordFeedback = document.querySelector('.password-feedback');


        if(Cookie.getCookie('registration_success')) {
            document.querySelector('.registration-box').classList.remove('d-none');
            document.querySelector('.registration-success-message').innerHTML = `<h1>${Cookie.getCookie('registration_success')}</h1>`;
            
            setTimeout(() => {
                document.querySelector('.registration-box').classList.add('d-none');
                document.querySelector('.registration-success-message').innerHTML = '';
                Cookie.deleteCookie('registration_success');
            }, 3000);
        }
    }

    validateForm() {
        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(document.getElementById('login-form'));
            formData.append('email', this.inputEmail.value);
            formData.append('password', this.inputPassword.value);
            
            console.log(formData);
            
            fetch('http://localhost/MovieApp/users/login', {
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
                //console.log(data);
                this.handleResponse(data);
            })
            .catch(err => {
                console.log(err);
            })
        })
    }

    handleResponse(responseObject) {
        console.log(responseObject);

        if(!(responseObject.isValid)) {
            if(responseObject.messages.email_err) {
                this.inputEmail.classList.add('is-invalid');
                this.inputEmailFeedback.innerHTML = responseObject.messages.email_err;
            } else if(responseObject.messages.email_err === '') {
                this.inputEmail.classList.remove('is-invalid');
                this.inputEmail.classList.add('is-valid');
            }

            if(responseObject.messages.password_err) {
                this.inputPassword.classList.add('is-invalid');
                this.inputPasswordFeedback.innerHTML = responseObject.messages.password_err;
            } else if(responseObject.messages.password_err === '') {
                this.inputPassword.classList.remove('is-invalid');
                this.inputPassword.classList.add('is-valid');
            }
        }
        if(responseObject.isValid && (responseObject.userId || responseObject.userName) ) {
            this.createUserSessions(responseObject.userId, responseObject.userName);
            window.location.href = 'http://localhost/MovieApp/pages/movies';
        }
    }

    createUserSessions(userId, userName) {
        sessionStorage.setItem('userId', userId);
        sessionStorage.setItem('userName', userName);
    }
}

let login = new Login();
login.validateForm();