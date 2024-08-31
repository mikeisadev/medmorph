import { useState, useRef } from "react"
import http from "../../../http"
import { examChaptersEP } from "../../../config"

export default function CustomizeExamExperience({examURL}) {
    const [exams, setExams] = useState(null)

    const examPopUpRef = useRef(null)

    const examName = examURL.replace('https://', '').replace(window.location.hostname, '')

    http.get(examChaptersEP + '?exam-slug=' + examName)
        .then(res => {
            const data = res.data

            if ('success' === data.status) {
                examPopUpRef.current
                .querySelector('.exam-info')
                .innerHTML = "Più info su esame"
            }

            if ('error' === data.status) {
                examPopUpRef.current
                .innerHTML = data.message
            }

            console.log(res.data)
        })
        .catch(err => {
            throw err;
        })

    return (
        <div ref={examPopUpRef} className="exam popup fullw-popup">
            <div className="popup-inner">
                <div className="col exam-info">
                    <p>Personalizza l'esperienza di studio del tuo esame</p>

                    <p>Richiedi dati per esame {examURL}</p>
                </div>
                <div className="col exam-questionary"></div>
            </div>
        </div>
    )
}