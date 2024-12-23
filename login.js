let loginform = document.getElementById('loginForm')
let emailLogin = document.getElementById("emailLogin")
let passwordLogin = document.getElementById("passwordLogin")
let error = document.getElementById("error")

let login = async (email, password) => {
    let response = await fetch("http://localhost/phpProject/public/login", {
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

loginform.addEventListener("submit", async function (event) {
    event.preventDefault()

    //const userList = JSON.parse(localStorage.getItem("userList")) || []
    //console.log(userList)
    //let user = userList.find(user => (user.email === emailLogin.value.trim() && user.password === passwordLogin.value.trim()))
    let user = await login(emailLogin.value.trim(), passwordLogin.value.trim())
    let response = await user.json()
    //console.log(response.stat)
    //let text = await user.text()
    //console.log(text)
    if (response.stat) {
        emailLogin.classList.add("success")
        emailLogin.classList.remove("error")
        passwordLogin.classList.add("success")
        passwordLogin.classList.remove("error")
        error.style.display = "none"
        window.alert("Login")
        window.location.href = 'index.html'
    } else {
        emailLogin.classList.add("error")
        emailLogin.classList.remove("success")
        passwordLogin.classList.add("error")
        passwordLogin.classList.remove("success")

        error.style.display = "inline"
        error.textContent = "the email or the password is wrong"
    }
})
