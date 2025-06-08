export const setData = async (url, form) => {
    try {
        const formData = new FormData(form)
        const response = await fetch(url, {
            method: "POST",
            body: formData
        })

        if (!response.ok) throw new Error("HTTP error, status: " + response.status)
        return await response.json()
    } catch (error) {
        console.error(error)
    }
}

export const getData = async (url) => {
    try {
        const response = await fetch(url)

        if (!response.ok) throw new Error("HTTP error, status: " + response.status)
        return await response.json()
    } catch (error) {
        console.error(error)
    }
}

export const checkbox = () => {
    document.querySelectorAll(".toggleCheckbox").forEach(label => {
        const checkbox = label.querySelector("input[type='checkbox']")
        const span = label.querySelector("span.check")

        label.onclick = e => {
            e.preventDefault()
            checkbox.checked = !checkbox.checked
            span.classList.contains("checked") ? span.classList.remove("checked") : span.classList.add("checked")
        }
    })
}

export const alert = (error, message) => {
    const alert = document.getElementById("alert")
    const p = alert.querySelector("p")
    alert.classList.add("displayAlert")
    if (error) {
        alert.classList.add("error")
        alert.classList.remove("success")
    } else {
        alert.classList.remove("error")
        alert.classList.add("success")
    }

    p.textContent = message

    alert.onclick = () => alert.classList.remove("displayAlert")
}

export const changeImgInput = () => {
    const input = document.getElementById('imgInput')
    if (input) {
        input.onchange = () => {
            const file = input.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    const imgElement = document.getElementById('img')
                    if (imgElement) imgElement.src = e.target.result
                }
                reader.readAsDataURL(file)
            }
        }
    }
}

export const createTemp = async (temp, binSelec) => {
    const bin = document.querySelector(binSelec)
    try {
        const response = await fetch(temp)
        if (!response.ok) throw new Error("HTTP error, status: " + response.status)
        bin.innerHTML = await response.text()
    } catch (error) {
        console.error(error)
    }
}

export const popup = () => {
    const blackGround = document.getElementById("blackGround")
    document.querySelectorAll(".popUp").forEach(pop => {
        if (pop) {
            pop.onclick = async e => {
                e.preventDefault()
                blackGround.classList.add("showPop")
                let url = pop.getAttribute("data-temp")
                await createTemp(url, "#popup")
                confirmPopup(blackGround)
                closePopup(blackGround)
            }
        }
    })
}

const confirmPopup = (blackGround) => {
    let confirm = blackGround.querySelector(".confirm")
    if (confirm) confirm.onclick = async () => {
        let url = confirm.getAttribute("data-url")
        let result = await getData(url)
        if (result['redirect']) {
            window.location.href = result["redirect"]
        } else {
            alert(result['error'], result['message'])
            blackGround.classList.remove("showPop")
        }
    }
}

const closePopup = (blackGround) => {
    let cancelar = blackGround.querySelector(".cancel")
    if (cancelar) cancelar.onclick = () => blackGround.classList.remove("showPop")
}

export const changeImg = () => {
    const form = document.getElementById("imgForm")

    if (form) {
        form.onsubmit = async e => {
            e.preventDefault()
            let result = await setData(`/controllers/user/changeImgUser.php`, form)
            alert(result["error"], result["message"])
            if (result["error"] && window.location.href.includes("/cuenta")) setTimeout(() => window.location.href = "/cuenta", 3000)
        }
    }
}

export const showPassword = () => {
    const buttons = document.querySelectorAll(".passButton");

    if (buttons) {
        buttons.forEach(button => {
            button.onclick = e => {
                e.preventDefault()

                let father = button.parentNode
                let input = father.querySelector("input")
                let img = button.querySelector("img")

                if (input.getAttribute("type") == "password") {
                    input.setAttribute("type", "text")
                    img.src = "/media/icons/passno.svg"
                } else {
                    input.setAttribute("type", "password")
                    img.src = "/media/icons/pass.svg"
                }
            }
        });
    }
}

export const footer = () => {
    const button = document.querySelector("footer button")
    if (button) {
        button.onclick = () => {
            const ul = document.querySelector("footer ul")
            const buttonF = document.querySelector(".buttonFooter")
            const main = document.querySelector("main")

            if (ul.classList.contains("showUl")) {
                ul.classList.remove("showUl")
                buttonF.classList.remove("rotate")
                main.classList.remove("mainHide")
            } else {
                ul.classList.add("showUl")
                buttonF.classList.add("rotate")
                main.classList.add("mainHide")
            }

        }
    }
}

export const buttonFollow = () => {
    const buttonF = document.querySelectorAll(".buttonF")

    buttonF.forEach(button => {
        if (button) {
            button.onclick = async e => {
                e.preventDefault()
                let id = button.getAttribute("data-id")
                let follow = button.getAttribute("data-follow")
                let result = await getData(`/controllers/followers/followers.php?id=${id}&follow=${follow}`)
                alert(result["error"], result["message"])
                if (!result["error"]) {
                    button.textContent = follow == 0 ? "Seguir" : "Dejar de seguir"
                    button.setAttribute("data-follow", follow == 0 ? 1 : 0)

                    let followers = document.getElementById("followers")
                    if (followers) followers.textContent = result["followers"]

                    let follows = document.getElementById("follows")
                    if (follows) follows.textContent = result["follows"]

                }
            }
        }
    })
}

export const search = (callback) => {
    const search = document.getElementById("search")
    if (search) {
        const url = search.getAttribute("data-url")
        const type = search.getAttribute("data-type")

        search.onkeyup = async e => {
            e.preventDefault()
            let value = search.value
            if (!value.length) window.location.reload()

            let result = await getData(`${url}?search=${value}&type=${type}`)
            callback(result)
        }
    }
}

export const forms = (callback) => {
    const forms = document.querySelectorAll("form")

    forms.forEach(form => {
        const loadingDots = form.querySelector(".loading-dots")
        const submitButton = form.querySelector(".button")

        if (form) {
            const url = form.getAttribute("data-url")
            form.onsubmit = async e => {
                e.preventDefault()
                loadingDots.classList.remove("d-n")
                submitButton.classList.add("d-n")

                let result = await setData(url, form)
                loadingDots.classList.add("d-n")
                submitButton.classList.remove("d-n")

                callback(url, form, result)
            }
        }
    })
}