import { createRoot } from "react-dom/client";
import { useEffect, useState, useRef } from 'react'
import { userLoginEP } from '../../config'
import http from "../../http"
import CustomizeExamExperience from "../user/exam/CustomizeExamExperience";
import { rPortal } from "../../App";

export default function LoginPopUp({examURL}) {
    const loginFormRef = useRef(null)

    const submit = function(e) {
        e.preventDefault()

        const formData = new FormData(loginFormRef.current);
        
        http.post(userLoginEP, formData)
            .then(res => {
                const data = res.data

                if ('success' === data.status && 'logged-in' === data.user_status) {
                    const root = createRoot(rPortal)
                    root.render(<CustomizeExamExperience examURL={examURL}/>)
                }
            })
            .catch(err => {
                const msg = err.response.data

                if ('error' === msg.status) {
                    const fields = loginFormRef.current.querySelectorAll('input')
                    const errors = msg.messages

                    fields.forEach(f => f?.parentElement?.querySelector('.val')?.remove())

                    for (const f in errors) {
                        document
                        .querySelector(`input[name="${f}"]`)
                        ?.parentElement
                        ?.insertAdjacentHTML(
                            'beforeend',
                            `${ errors[f].map((m: String) => `<p class="val error">${m}</p>`) }`
                        )
                    }

                    console.log(fields, errors)
                } else {
                    throw err
                }
                console.log(err)
            })
    }

    return (
        <div className="login popup h-60 w-480 flex-center-popup">
            <div className="close-popup">

            </div>
            <h4 className="mb-5">Accedi al tuo account</h4>
            
            <form ref={loginFormRef} id="login-form" method="POST" onSubmit={submit} novalidate>
                <p className="field">
                    <label for="login">Nome utente o indirizzo email</label>
                    <input id="login" type="text" name="login" placeholder="Nome utente o indirizzo email..."/>
                </p>
                <p className="field">
                    <label for="pwd">Password</label>
                    <input id="pwd" type="password" name="pwd" placeholder="Password..."/>
                </p>
                <button name="slogin" class="filled-btn submit" role="submit">Accedi</button>
            </form>
        </div>
    )
}