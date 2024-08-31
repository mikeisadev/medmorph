import http from "./http"
import { userRegistrationEP } from "./config"

const studentRegisterForm = document.querySelector('#student-register-form') as HTMLFormElement

// While typing
// Validation while typing
// To be implemented

// On submit
studentRegisterForm?.addEventListener('submit', e => {
    e.preventDefault()

    const formData = new FormData( studentRegisterForm )
    const fields = studentRegisterForm.querySelectorAll('input')

    console.log(userRegistrationEP)

    http.post(userRegistrationEP, formData)
        .then(resp => {
            fields.forEach(field => {
                console.log(field)
            })

            console.log(resp.data)
        })
        .catch(err => {
            const data = err.response.data

            fields.forEach(f => f.parentElement?.querySelector('.val')?.remove())

            for (const f in data.messages) {
                document
                .querySelector(`input[name="${f}"]`)
                ?.parentElement
                ?.insertAdjacentHTML(
                    'beforeend',
                    `${ data.messages[f].map((m: String) => `<p class="val error">${m}</p>`) }`
                )
            }
            console.log(err.response.data)
        })
})