import http from "./http"
import { userLoginEP } from "./config"

const loginForm = document.querySelector('#login-form') as HTMLFormElement

// While typing
// Validation while typing
// To be implemented

// On submit
loginForm?.addEventListener('submit', e => {
    e.preventDefault()

    const formData = new FormData( loginForm )
    const fields = loginForm.querySelectorAll('input')
    const submit = loginForm.querySelector('button[role="submit"]')

    submit?.setAttribute('disabled', 'disabled')

    http.post(userLoginEP, formData)
        .then(resp => {
            const data = resp.data

            console.log()

            if ('success' === data.status) {
                window.location = data.redirect

                console.log(data.redirect)

                submit?.removeAttribute('disabled')
            }
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
                    `${ data.messages[f].map(m => `<p class="val error">${m}</p>`) }`
                )
            }

            submit?.removeAttribute('disabled')
        })
})