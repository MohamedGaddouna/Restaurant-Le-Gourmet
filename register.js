let register_php = async (email, password) => {
    let response = await fetch("http://localhost/phpProject/public/register", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        //body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
        body: new URLSearchParams({
            email: email,
            password: password,
        })
    })
    return response;
}
function register() {
    let userList = JSON.parse(localStorage.getItem('userList')) || [];
    // Form
    let form = document.getElementById("registerForm")
    // Input Fields
    let name = document.getElementById("name")
    let email = document.getElementById("email")
    let password = document.getElementById("password")
    // Error Messages
    let nameError = document.getElementById("nameError")
    let emailError = document.getElementById("emailError")
    let passwordError = document.getElementById("passwordError")
    // Icons Validate
    let valdNameIcon = document.getElementById("valdNameIcon")
    let valdEmailIcon = document.getElementById("valdEmailIcon")
    let valdPasswordIcon = document.getElementById("valdPasswordIcon")
    // Icons Errors
    let errorNameIcon = document.getElementById("errorNameIcon")
    let errorEmailIcon = document.getElementById("errorEmailIcon")
    let errorPasswordIcon = document.getElementById("errorPasswordIcon")

    let errorFunction = (errorMessage, inputField, errorField, checkIcon, errorIcon) => {
        errorIcon.style.display = "inline"
        checkIcon.style.display = "none"
        inputField.classList.add("error")
        inputField.classList.remove("success")
        errorField.style.display = "inline"
        errorField.textContent = errorMessage
    }
    let validateFunction = (inputField, errorField, checkIcon, errorIcon) => {
        errorIcon.style.display = "none"
        checkIcon.style.display = "inline"
        errorField.style.display = "none"
        inputField.classList.add("success")
        inputField.classList.remove("error")
    }
    let emailPattern = email => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)

    form.addEventListener("submit", async function (event) {
        event.preventDefault()
        // name
        let validateName = true
        let nameErrorString = ""
        if (name.value.trim().length === 0) {
            validateName = false
            nameErrorString += "The name is required. "
        }
        if (name.value.trim().length >= 12) {
            validateName = false
            nameErrorString += "The name must be at least under 12 caracter. "
        }
        if (validateName) {
            validateFunction(name, nameError, valdNameIcon, errorNameIcon)
        } else {
            errorFunction(nameErrorString, name, nameError, valdNameIcon, errorNameIcon)
        }

        // email 
        let validateEmail = true
        let emailErrorString = ""
        if (userList.some(user => user.email === email.value.trim())) {
            validateEmail = false
            emailErrorString += "The email is exist. "
        }
        if (email.value.trim().length === 0) {
            validateEmail = false
            emailErrorString += "The email is required. "
        }
        if (email.value.trim().length >= 24) {
            validateEmail = false
            emailErrorString += "The email must be at least. "
        }
        if (!emailPattern(email.value.trim())) {
            validateEmail = false
            emailErrorString += "The email format is wrong. "
        }
        if (validateEmail) {
            validateFunction(email, emailError, valdEmailIcon, errorEmailIcon)
        } else {
            errorFunction(emailErrorString, email, emailError, valdEmailIcon, errorEmailIcon)
        }

        // password
        let validatePassword = true
        let passwordErrorString = ""
        if (password.value.trim().length <= 8 || password.value.trim().length >= 16) {
            validatePassword = false
            passwordErrorString += "The length of the  password must beteween 8 et 16 caracter . "
        }
        // Check for at least one uppercase letter
        let hasUpperCase = /[A-Z]/.test(password.value.trim());
        // Check for at least one lowercase letter
        let hasLowerCase = /[a-z]/.test(password.value.trim());
        // Check for at least one special character
        let hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password.value.trim());
        if (!hasUpperCase) {
            validatePassword = false
            passwordErrorString += "The password must has uppercase. "
        }
        if (!hasLowerCase) {
            validatePassword = false
            passwordErrorString += "The password must has lowercase. "
        }
        if (!hasSpecialChar) {
            validatePassword = false
            passwordErrorString += "The password must has special. "
        }
        if (validatePassword) {
            validateFunction(password, passwordError, valdPasswordIcon, errorPasswordIcon)
        } else {
            errorFunction(passwordErrorString, password, passwordError, valdPasswordIcon, errorPasswordIcon)
        }
        if (validateEmail && validateName && validatePassword) {
            let result = await register_php(email.value, password.value)
            let j = await result.json()
            if (j.stat) {
                window.alert("Account Created")
                window.location.href = "login.html"
            } else {
                window.alert("the email is already taken")
            }
        }
    })
}
register()