import { createRoot } from "react-dom/client";
import { useEffect, useState, useRef, useCallback, forwardRef, FormEventHandler } from 'react'
import { userLoginEP } from '../../config'
import http from "../../http"
import CustomizeExamExperience from "../user/exam/CustomizeExamExperience";
import { portals } from "../../App";
import LoginPopUpInterface from "../../types/interfaces";

const LoginPopUp: React.FC<LoginPopUpInterface> = forwardRef(function LoginPopUp({examURL}, ref) {
    const loginFormRef = useRef<null|HTMLFormElement>(null)
    
    const submit = (e: any) => {
        e.preventDefault()
    
        const formData = new FormData(loginFormRef.current as HTMLFormElement);
            
        http.post(userLoginEP, formData)
            .then(res => {
                const data = res.data
    
                if ('success' === data.status && 'logged-in' === data.user_status) {
                    const root = createRoot(portals)
                    root.render(<CustomizeExamExperience examURL={examURL}/>)
                }
            })
            .catch(err => {
                const msg = err.response.data
    
                if ('error' === msg.status) {
                    const fields = (loginFormRef.current as HTMLFormElement).querySelectorAll('input')
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
    
    const closePopUp = useCallback(() => {
        portals.innerHTML = '';
        portals.classList.add('hide')
    }, [])
    
    return (
        <>
            <div className="login popup h-max-content w-480 flex-center-popup">
                <div className="close-popup" onClick={closePopUp}>
                    <i className="bi bi-x-lg"></i>
                </div>
                
                <h4 className="fs-20 mb-15">Accedi al tuo account</h4>
                            
                <form ref={loginFormRef} id="login-form" method="POST" onSubmit={submit} noValidate>
                    <p className="field">
                        <label htmlFor="login">Nome utente o indirizzo email</label>
                        <input id="login" type="text" name="login" placeholder="Nome utente o indirizzo email..."/>
                    </p>
                    <p className="field">
                        <label htmlFor="pwd">Password</label>
                        <input id="pwd" type="password" name="pwd" placeholder="Password..."/>
                    </p>
                    <button name="slogin" className="filled-btn submit" role="submit">Accedi</button>
                </form>
            </div>
            <div className="overlay" onClick={closePopUp}></div>
        </>
    )
})

export default LoginPopUp