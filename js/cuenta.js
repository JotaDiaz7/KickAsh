import { alert, getData, createTemp, footer, buttonFollow, search, changeImgInput, forms } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    buttonsCig()
    datesR()
    footer()
    buttonFollow()
    search(printSearch)
    deleteFollower()
    forms(results)
})

const results = async (url, form, result) => {
    if (!result["error"] && url.includes("changeImgUser")) {
        alert(result['error'], result['message'])
        setTimeout(() => window.location.href = "/cuenta", 3000)
    }else if (result['temp']) {
        document.querySelector("main").classList.add("fade-out")
        await new Promise(resolve => setTimeout(resolve, 400)) // Esperamos el fade-out antes de cambiar el contenido
        await createTemp(result['temp'], "main")
        forms(results)
        changeImgInput()
        setTimeout(() => document.querySelector("main").classList.remove("fade-out"), 400)
    } else {
        alert(result['error'], result['message'])
    }
}

const buttonsCig = () => {//Para aumentar o disminuir la cantidad de cigarros y de dinero
    const buttons = document.querySelectorAll(".buttonCant")

    if (buttons) {
        buttons.forEach(button => {
            button.onclick = async () => {
                let get = button.getAttribute("data-url")
                let max = button.getAttribute("data-max")
                let cantidad = document.getElementById("cantCig")
                let result = await getData(`/controllers/historical/buttonsCig.php?${get}`)
                cantidad.textContent = result['num_cig']
                document.getElementById("save").textContent = result['money'] > 0 ? result['money'] : 0
                if (result['num_cig'] >= max) {
                    cantidad.classList.add("errorC")
                } else {
                    cantidad.classList.remove("errorC")
                }
            }
        })
    }
}

const datesR = () => {
    const dates = document.querySelectorAll('input[type="date"]')
    const dateS = document.getElementById('dateS')
    const dateE = document.getElementById('dateE')

    dates.forEach(date => {
        date.onchange = async () => {
            window.location.href = `?historico=${dateS.value}_${dateE.value}`
        }
    })
}

const deleteFollower = () => {
    const buttonF = document.querySelectorAll(".buttonFer")

    buttonF.forEach(button => {
        if (button) {
            button.onclick = async e => {
                e.preventDefault()
                let id = button.getAttribute("data-id")
                let result = await getData(`/controllers/followers/deleteFollower.php?id=${id}`)
                alert(result["error"], result["message"])
                if (!result["error"]) button.remove()
            }
        }
    })
}

const printSearch = (data) => {
    const tbody = document.querySelector(".tbody")
    tbody.innerHTML = ""
    const search = document.getElementById("search")
    const type = search.getAttribute("data-type")

    if (type == "follows") tempFollow(data, tbody)
    if (type == "follower") tempFollower(data, tbody)
}

const tempFollow = (data, body) => {
    data.forEach(item => {
        body.innerHTML += `
        <div class="tr">
            <a class="tdF flex g1 alignCenter" href="/usuario?id=${item['id']}">
                <span class="imgT">
                    <img src="${item['img'] == null ? '/media/logo/main.svg' : '/media/users/' + item['img']}" alt="Imagen usuario" title="Imagen usuario">
                </span>
                <span>${item['name']}</span>
            </a>
            <div class="td flex end">
                ${item['is_following']
                ? `<button class="buttonF center" data-id="${item['id']}" data-follow="0">Dejar de seguir</button>`
                : `<button class="buttonF center" data-id="${item['id']}" data-follow="1">Seguir</button>`
            }
            </div>
        </div>
    `
    })
    buttonFollow()
}

const tempFollower = (data, body) => {
    data.forEach(item => {
        body.innerHTML += `
        <div class="tr">
            <a class="tdF flex g1 alignCenter" href="/usuario?id=${item['id']}">
                <span class="imgT">
                    <img src="${item['img'] == null ? '/media/logo/main.svg' : '/media/users/' + item['img']}" alt="Imagen usuario" title="Imagen usuario">
                </span>
                <span>${item['name']}</span>
            </a>
            <div class="td flex end">
                ${item['is_follower']
                ? `<button class="buttonFer center" data-id="${item['id']}">Eliminar seguidor</button>`
                : ``
            }
            </div>
        </div>
    `
    })
    deleteFollower()
}