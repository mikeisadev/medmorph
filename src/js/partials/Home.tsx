import { createRoot } from "react-dom/client";
import http from "../../http";
import { userSupervisorEP } from "../../config"
import LoginPopUp from "../templates/LoginPopUp";
import CustomizeExamExperience from "../user/exam/CustomizeExamExperience";
import '../../http';

const startExamBtns = document.querySelectorAll('a[data-action="start-exam"]')

const rootSelector = document.querySelector('#r-portal') as Element
const root = createRoot(document.querySelector('#r-portal') as Element)

startExamBtns.forEach(btn => {
    btn.addEventListener('click', e => {
        // Prevent default behavior
        e.preventDefault()
        e.stopPropagation()

        // AJAX call.
        http.get(userSupervisorEP)
            .then(resp => {
                const data = resp.data

                console.log(data)

                rootSelector.classList.remove('hide')

                switch(data.user) {
                    case 'logged-out':
                        root.render( <LoginPopUp /> )

                        break

                    case 'logged-in':
                        window.location = (btn as HTMLAnchorElement).href
                        break
                }
            })
            .catch(err => {
                throw err
            })
    })
})