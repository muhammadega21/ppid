function emailInput() {
    const email = document.getElementById("email");
    const iconemail = document.querySelector(".bx-envelope");
    const emailText = email.value;

    if (emailText.length > 0) {
        email.style.borderBottom = "1px solid #008cff";
        iconemail.style.color = "#008cff";
    } else {
        email.style.borderBottom = "1px solid rgba(0, 0, 0, .2)";
        iconemail.style.color = "#2e2e2e";
    }
}
function passInput() {
    const pass = document.getElementById("password");
    const iconpass = document.querySelector(".bxs-lock-alt");
    const passText = pass.value;

    if (passText.length > 0) {
        pass.style.borderBottom = "1px solid #008cff";
        iconpass.style.color = "#008cff";
    } else {
        pass.classList.remove("activeInput");
        pass.style.borderBottom = "1px solid rgba(0, 0, 0, .2)";
        iconpass.style.color = "#2e2e2e";
    }
}
function nisInput() {
    const nis = document.getElementById("nis");
    const iconnis = document.querySelector(".bxs-user-account");
    const nisText = nis.value;

    if (nisText.length > 0) {
        nis.style.borderBottom = "1px solid #008cff";
        iconnis.style.color = "#008cff";
    } else {
        nis.classList.remove("activeInput");
        nis.style.borderBottom = "1px solid rgba(0, 0, 0, .2)";
        iconnis.style.color = "#2e2e2e";
    }
}
function nameInput() {
    const name = document.getElementById("name");
    const iconname = document.querySelector(".bx-user");
    const nameText = name.value;

    if (nameText.length > 0) {
        name.style.borderBottom = "1px solid #008cff";
        iconname.style.color = "#008cff";
    } else {
        name.classList.remove("activeInput");
        name.style.borderBottom = "1px solid rgba(0, 0, 0, .2)";
        iconname.style.color = "#2e2e2e";
    }
}
function usernameInput() {
    const username = document.getElementById("username");
    const iconuser = document.querySelectorAll(".bx-user");
    const iconusername = iconuser[1];
    const usernameText = username.value;

    if (usernameText.length > 0) {
        username.style.borderBottom = "1px solid #008cff";
        iconusername.style.color = "#008cff";
    } else {
        username.classList.remove("activeInput");
        username.style.borderBottom = "1px solid rgba(0, 0, 0, .2)";
        iconusername.style.color = "#2e2e2e";
    }
}
