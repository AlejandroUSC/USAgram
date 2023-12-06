document.querySelector("#login-form").onsubmit = function () {
    if (document.querySelector('#email').value.trim() === 0) {
        document.querySelector('#email-error').innerHTML = "Email cannot be empty";
        document.querySelector('#emailHelp').innerHTML = "";
        return false;
    }
    else {
        document.querySelector('#email-error').innerHTML = "";
        document.querySelector('#emailHelp').innerHTML = "We'll never share your email with anyone";
    }
    
    if (document.querySelector('#password').value.trim() <= 0 ) {
        document.querySelector('#pass-error').innerHTML = "Password cannot be empty";
        return false;
    }
    else {
        document.querySelector('#pass-error').innerHTML = "";
    }

    return true;
}

document.querySelector("#reg-form").onsubmit = function () {
    if (document.querySelector('#reg-fname').value.trim() === 0) {
        document.querySelector('#reg-fn-error').innerHTML = "Name cannot be empty";
        return false;
    }
    else {
        document.querySelector('#reg-fn-error').innerHTML = "";
    }

    if (document.querySelector('#reg-lname').value.trim() === 0) {
        document.querySelector('#reg-ln-error').innerHTML = "Last name cannot be empty";
        return false;
    }
    else {
        document.querySelector('#reg-ln-error').innerHTML = "";
    }

    if (document.querySelector('#reg-email').value.trim() === 0) {
        document.querySelector('#reg-email-error').innerHTML = "Email cannot be empty";
        return false;
    }
    else {
        document.querySelector('#reg-email-error').innerHTML = "";
    }

    if (document.querySelector('#reg-password').value.trim() <= 0) {
        document.querySelector('#reg-pass-error').innerHTML = "Password cannot be empty";
        return false;
    }
    else {
        document.querySelector('#pass-error').innerHTML = "";
    }


    return true;
}


function redirectHome() {
    window.location.href = "main.php";
}

function redirectLogin() {
    window.location.href = "login.php";
}

function redirectTimer() {
    setTimeout(redirectHome, 5000);
}

function redirectTimerLog() {
    setTimeout(redirectLogin, 5000);
}