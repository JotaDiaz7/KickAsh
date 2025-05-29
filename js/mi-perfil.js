import { changeImgInput, setData, alert, changeImg, showPassword, footer, checkbox } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    changeImgInput()
    changeImg()
    forms()
    showPassword()
    footer()
    checkbox()
})

const forms = () => {
    const forms = document.querySelectorAll(".form")

    forms.forEach(form => {
        if (form) {
            const data = form.getAttribute("data-controller")
            form.onsubmit = async e => {
                e.preventDefault()
                let result = await setData(`/controllers/user/${data}.php`, form)

                if(data == 'delete' && !result['error'])window.location.reload()
                if(data == 'password' && !result['error'])form.reset()
                alert(result['error'], result['message'])
            }
        }
    })

}

