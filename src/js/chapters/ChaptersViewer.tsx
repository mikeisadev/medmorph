import { useState, useEffect } from "react"
import http from "../../http";
import { singleChapterEP } from "../../config";
import ParagraphAccordion from "../components/ParagraphAccordion";
import Button from "../components/Button";
import Loader from "../components/Loader";

interface Chapter {
    content: string,
    title: string
}

export default function ChaptersViewer() {
    const [paragraphs, setParagraphs] = useState<null|Array<Chapter>>(null);

    useEffect(() => {
        http.get(singleChapterEP + location.search)
            .then(res => {
                console.log(res.data)
                setParagraphs(res.data)
            })
            .catch(err => {
                throw err;
            })
    }, []);

    return (
        <>
            <p>
                
            </p>
            {   
            paragraphs ? 
                <>
                {
                    paragraphs.map((value, index) => {
                        return <ParagraphAccordion props={{
                            title: value.title,
                            content: value.content
                        }} />

                    })
                }
                <div className="viewer-actions flex gap-20 space-evenly align-center py-40">
                    <div>
                        <Button 
                            props={{
                                text: 'Segna come completato',
                                btnStyle: 'outline-btn',
                                icon: <i className="bi bi-calendar-check"></i>
                            }}
                        />
                    </div>
                    <div className="action-next">
                        <p>Note: aggiungere prossimo capitolo</p>
                        <Button 
                            props={{
                                text: 'Prossimo capitolo',
                                btnStyle: 'filled-btn',
                                icon: <i className="bi bi-arrow-right-circle"></i>
                            }}
                        />
                    </div>
                </div>
                </>
                :
                <Loader props={{loaderText: 'Stiamo caricando il capitolo...'}}/>
            }
        </>
    )
}
