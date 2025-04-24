import { checkbox, alert, setData } from "./utils.js"

document.addEventListener("DOMContentLoaded", function(){
    buttons()
    checkbox()
    login()
    registro()
})


const buttons = () => {
    document.querySelectorAll(".toggleForm").forEach(button => {
        button.onclick = e => {
            e.preventDefault()
            document.querySelectorAll("form").forEach(form => {
                form.classList.contains("d-n") ? form.classList.remove("d-n") : form.classList.add("d-n")
                form.reset()
            } )
        }
    })
}

const login = () => {
    const form = document.getElementById("login")

    form.onsubmit = async e => {
        e.preventDefault()
        let result = await setData("/controllers/user/login.php", form)
        if(result["redirect"]){
            window.location.href = result["redirect"]
        }else{
            alert(true, result)
        }
    }
}

const registro = () => {
    const form = document.getElementById("register")

    form.onsubmit = async e => {
        e.preventDefault()
        let result = await setData("/controllers/user/registro.php", form)
        if(result == "ok"){
            alert(false, "Registrado")
        }else{
            alert(true, result)
        }
    }
}