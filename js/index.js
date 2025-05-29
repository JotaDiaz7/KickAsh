import { checkbox, alert, setData, showPassword, footer, createTemp } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    buttons()
    checkbox()
    forms()
    showPassword()
    footer()
})

const buttons = () => {
    document.querySelectorAll(".toggleForm").forEach(button => {
        button.onclick = async () => {
            let temp = button.getAttribute("data-temp")
            await createTemp(`/templates/${temp}`, ".tempWrap")
            buttons()
            forms()
            checkbox()
            showPassword()
        }
    })
}

const forms = () => {
    const form = document.querySelector("form")

    form.onsubmit = async e => {
        e.preventDefault()
        let url = form.getAttribute("data-url")
        let result = await setData(`/controllers/user/${url}`, form)
        if (result["redirect"]) {
            window.location.href = result["redirect"]
        } else if (!result['error']) {
            alert(false, result['message'])
            await createTemp(`/templates/login.php`, ".tempWrap")
            forms()
            buttons()
        } else {
            alert(result['error'], result['message'])
        }
    }
}
