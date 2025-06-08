import { popup, changeImgInput, setData, alert, footer, search , forms} from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    popup()
    forms(results)
    changeImgInput()
    footer()
    closeAlert()
    search(printSearch)
})

const results = (url, form, result) => {
    if (result['redirect']) {
        window.location.href = result["redirect"]
    } else {
        alert(result['error'], result['message'])
    }
}

const closeAlert = () => {
    const alert = document.getElementById("alert")
    if (alert) alert.onclick = () => alert.classList.remove("displayAlert")
}

const printSearch = (data) => {
    const tbody = document.querySelector(".tbody")
    tbody.innerHTML = ""
    data.forEach(item => {
        tbody.innerHTML += `
            <a class="tr" href="?user=${item['id']}">
                <div class="td">
                    <span class="imgT">
                        <img src="${item['img'] == null ? '/media/logo/main.svg' : '/media/users/' + item['img']}" alt="Imagen usuario" title="Imagen usuario">
                    </span>
                </div>
                <div class="td">
                    ${item['id']}
                </div>
                <div class="td d-ns">
                </div>
                <div class="td">
                    <span>${item['rol'] == 0 ? 'Usuario' : 'Administrador'}</span>
                </div>
                <div class="td">
                    <span class="round ${item['activo'] ? 'activo' : ''}"></span>
                </div>
            </a>
        `
    })
}