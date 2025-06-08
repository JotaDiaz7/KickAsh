import { checkbox, alert, forms, showPassword, footer, createTemp } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    buttons()
    checkbox()
    forms()
    showPassword()
    footer()
    forms(results)
})

const buttons = () => {
    document.querySelectorAll(".toggleForm").forEach(button => {
        button.onclick = async () => {
            let temp = button.getAttribute("data-temp")
            await createTemp(`/templates/${temp}`, ".tempWrap")
            buttons()
            forms(results)
            checkbox()
            showPassword()
        }
    })
}

const results = async (url, form, result) => {
    if (result["redirect"]) {
        window.location.href = result["redirect"]
    } else if (!result['error']) {
        alert(false, result['message'])
        await createTemp(`/templates/login.php`, ".tempWrap")
        forms(results)
        buttons()
    } else {
        alert(result['error'], result['message'])
    }
}