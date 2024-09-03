import { useState, useEffect, useRef, useCallback } from "react"
import http from "../../../http"
import { examChaptersEP } from "../../../config"
import { portals } from "../../../App"

export default function CustomizeExamExperience({examURL}) {
    const [exam, setExamInfo] = useState(null)

    const examPopUpRef = useRef(null)

    const examName = examURL.replace('https://', '').replace(window.location.hostname, '')

    useEffect(() => {
        http.get(examChaptersEP + '?exam-slug=' + examName)
            .then(res => {
                const data = res.data
    
                if ('success' === data.status) {
                    setExamInfo(data.response.exam)
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
    }, [])

    const closePopUp = useCallback(() => {
        portals.innerHTML = '';
        portals.classList.add('hide')
    }, [])

    return (
        <>
            <div ref={examPopUpRef} className="exam popup fullw-popup">
                <div className="close-popup" onClick={closePopUp}>
                    <i className="bi bi-x-lg"></i>
                </div>
                <div className="popup-inner py-10">
                    <h1 className="fs-20">Personalizza la tua esperienza di studio</h1>
                    <p className="fs-14">Rispondi a un breve questionario per rendere la tua esperienza di studio migliore per questo esame.</p>
                    <div className="col exam-info">
                        {
                        exam ? 
                        <>
                            <h4>{exam.title}</h4>
                            <ul style={{margin:0}}>
                                <i className="bi bi-book"></i> {exam.chapters.length} capitoli
                            </ul>
                        </>
                        : null
                        }
                    </div>
                    <div className="col exam-questionary"></div>
                </div>
            </div>
            <div className="overlay" onClick={closePopUp}></div>
        </>
    )
}