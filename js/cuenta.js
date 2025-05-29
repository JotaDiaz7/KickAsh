import { alert, setData, getData, createTemp, changeImg, footer, buttonFollow, search, changeImgInput } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    formsCheck()
    buttonsCig()
    changeImg()
    datesR()
    imgState()
    footer()
    buttonFollow()
    search(printSearch)
    deleteFollower()
})

const formsCheck = () => {
    const form = document.getElementById("checkForm")

    if (form) {
        const data = form.getAttribute("data-controller")
        form.onsubmit = async e => {
            e.preventDefault()
            let result = await setData(`/controllers/user/${data}.php`, form)
            if (result['temp']) {
                document.querySelector("main").classList.add("fade-out")
                await new Promise(resolve => setTimeout(resolve, 400)) // Esperamos el fade-out antes de cambiar el contenido
                await createTemp(result['temp'], "main")
                formsCheck()
                changeImgInput()
                changeImg()
                setTimeout(() => document.querySelector("main").classList.remove("fade-out"), 400)
            } else {
                alert(result['error'], result['message'])
            }
        }
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

const imgState = () => {
    const states = document.querySelectorAll(".stateC")
    let img = document.getElementById("imgState")
    let result = 0

    if (img) {
        states.forEach(state => result += parseFloat(state.textContent))

        if (result < 5) {
            img.src = "/media/logo/main.svg"
        } else if (result > 5 && result <= 40) {
            img.src = "/media/logo/regular.svg"
        } else if (result > 40 && result <= 70) {
            img.src = "/media/logo/bad.svg"
        } else if (result > 70) {
            img.src = "/media/logo/verybad.svg"
        }
    }

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

    if(type === "follow") tempFollow(data, tbody)
    if(type === "follower") tempFollower(data, tbody)
}

const tempFollow = (data) => {
    data.forEach(item => {
        tbody.innerHTML += `
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