import { createRoot } from "react-dom/client";
import http from "../../../http";
import { userSupervisorEP } from "../../../config"
import LoginPopUp from "../../templates/LoginPopUp";
import '../../../http';
import { rPortal } from "../../../App";
import CustomizeExamExperience from "../../user/exam/CustomizeExamExperience";

// Home page additional partials
import './HomeABF'

const startExamBtns = document.querySelectorAll('a[data-action="start-exam"]')

const rootSelector = document.querySelector('#r-portal') as Element
const root = createRoot(document.querySelector('#r-portal') as Element)

startExamBtns.forEach(btn => {
    btn.addEventListener('click', e => {
        // Prevent default behavior
        e.preventDefault()
        e.stopPropagation()

        // Get data about exam.
        const examURL = (btn as HTMLAnchorElement).href

        // AJAX call.
        http.get(userSupervisorEP)
            .then(resp => {
                const data = resp.data

                console.log(data)

                rootSelector.classList.remove('hide')

                switch(data.user) {
                    case 'logged-out':
                        root.render( <LoginPopUp examURL={examURL} /> )

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