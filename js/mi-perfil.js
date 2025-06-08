import { changeImgInput, setData, alert, showPassword, footer, checkbox, forms } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    changeImgInput()
    forms()
    showPassword()
    footer()
    checkbox()
    forms(results)
})

const results = (url, form, result) => {
    if (url.includes('delete') && !result['error']) window.location.reload()
    if (url.includes('password') && !result['error']) form.reset()
    alert(result['error'], result['message'])
}
