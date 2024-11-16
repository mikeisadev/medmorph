import { useRef } from "react";
import { createRoot } from "react-dom/client";
import http from "../../../http";
import { userSupervisorEP } from "../../../config"
import LoginPopUp from "../../templates/LoginPopUp";
import '../../../http';
import { portals } from "../../../App";
import CustomizeExamExperience from "../../user/exam/CustomizeExamExperience";

// Home page additional partials
import './HomeABF'

// Elements
const startExamBtns = document.querySelectorAll('a[data-action="start-exam"]')

startExamBtns.forEach(btn => {
    btn.addEventListener('click', e => {
        // Prevent default behavior
        e.preventDefault()
        e.stopPropagation()
        e.stopImmediatePropagation()

        // Get data about exam.
        const examURL = (btn as HTMLAnchorElement).href

        // Login popup reference.
        const loginPopUpRef = useRef(null)

        // AJAX call.
        http.get(userSupervisorEP)
            .then(resp => {
                const data = resp.data

                console.log(data)

                portals.classList.remove('hide')

                const root = createRoot(portals as HTMLElement)

                switch(data.user) {
                    case 'logged-out':
                        root.render( <LoginPopUp ref={loginPopUpRef} examURL={examURL} /> )

                        break

                    case 'logged-in':
                        // window.location.href = (btn as HTMLAnchorElement).href
                        root.render( <CustomizeExamExperience examURL={examURL}/> )

                        break
                }
            })
            .catch(err => {
                throw err
            })
    })
})