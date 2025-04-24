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
    if(error) {
        alert.classList.add("error")
        alert.classList.remove("success")
    }else{
        alert.classList.remove("error")
        alert.classList.add("success")
    }

    p.textContent = message

    alert.onclick = () => alert.classList.remove("displayAlert")
}