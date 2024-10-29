function errorLogin(errorCode = 0) {
    errorLoginReset();
    const error = document.getElementById("login-errorr");
    if (error.style.visibility === "hidden" || error.style.visibility === "")
        error.style.visibility = "visible";
    switch (errorCode) {
        case 1: 
            error.innerHTML = "No such user was found";
            errorLoginStyle("username");
            errorLoginStyle("password");
            break;
        case 2: 
            error.innerHTML = "This account is not active";
            break;
        case 3:
            error.innerHTML = "Wrong password";
            errorLoginStyle("password");
            break;
        default: 
            error.innerHTML = "An unknown error occurred";
            break;
    }
}

function errorLoginStyle(id) {
    const element = document.getElementById(id);
    element.style.color = "#ce2b2b";
    element.style.borderColor = "#ce2b2b";
}

function errorLoginReset() {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    username.style.color = "#fff";
    username.style.borderColor = "#14d08a";
    password.style.color = "#fff";
    password.style.borderColor = "#14d08a";
}

function errorLoginHide() {
    const error = document.getElementById("login-error");
    error.style.visibility = "hidden";
}