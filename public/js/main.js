'use strict'
document.getElementById('logout-btn').addEventListener('click', () => {
    sessionStorage.removeItem('userId');
    sessionStorage.removeItem('userName');
    
    if(!sessionStorage.getItem('userId')) {
        for(let el of li) {
            el.classList.add('d-none');
        }
        document.getElementById('search-field').classList.add('d-none');
        document.getElementById('search-btn').classList.add('d-none');
        document.getElementById('logout-btn').classList.add('d-none');
        document.getElementById('login-btn').classList.add('d-block');
        document.getElementById('register-btn').classList.add('d-block');
    }
})

document.getElementById('home-page-btn').addEventListener('click', () => {
    if(sessionStorage.getItem('userName') && sessionStorage.getItem('userId')) {
        window.location.href = 'http://localhost/MovieApp/pages/movies';
    }
    else {
        window.location.href = 'http://localhost/MovieApp';
    }
})

window.onload = () => {
    if((typeof(animateMainText) === "function")) {
        animateMainText();
    }

    if(typeof(animateMainRegisterForm === "function")) {
        animateMainRegisterForm();
    }

    if(typeof(animateLoginForm === "function")) {
        animateLoginForm();
    }
    if(typeof(animateRegisterForm === "function")) {
        animateRegisterForm();
    }
}


function animateMainText() {
    let mainText = document.getElementById('main-text');

    let start = Date.now();


    if(mainText === null) {
        console.log('Main text is null');
    }
    else {
        let timer = setInterval(() => {
            let timePassed = Date.now() - start;
            mainText.style.top = timePassed / 5 + 'px';
    
            if(timePassed > 500) clearInterval(timer);
        }, 20);
    }
}

function animateMainRegisterForm() {
    let mainRegisterForm = document.getElementById('div-register-form');
    let start = Date.now();

    if(mainRegisterForm === null) {
        console.log('Register form is null.');
    }
    else {
        let timer = setInterval(() => {
            let timePassed = Date.now() - start;
            mainRegisterForm.style.bottom = timePassed / 5 + 'px';
    
            if(timePassed > 300) { 
                mainRegisterForm.style.top = timePassed / 10 + 'px';
            }
            if(timePassed > 500) clearInterval(timer);
        }, 20);
    }
}

function animateLoginForm() {
    let loginForm = document.getElementById('div-login-form');
    let start = Date.now();

    if(loginForm === null) {
        console.log('Login form is null');
    }
    else {
        let timer = setInterval(() => {
            let timePassed = Date.now() - start;
            loginForm.style.left = timePassed / 5 + 'px';

            if(timePassed > 200) clearInterval(timer);
        }, 20);
    }
}

function animateRegisterForm() {
    let registerForm = document.getElementById('sub-register-form');
    let start = Date.now();

    if(registerForm === null) {
        console.log('Login form is null');
    }
    else {
        let timer = setInterval(() => {
            let timePassed = Date.now() - start;
            registerForm.style.left = timePassed / 5 + 'px';

            if(timePassed > 200) clearInterval(timer);
        }, 20);
    }
}