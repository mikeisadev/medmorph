import { useState, useRef } from "react"
import { MouseEventHandler } from "react"
import Button from "./Button"

type ChapterListElType = {
    chapterTitle: string,
    position?: number,
    has3DModel?: boolean,
    chapterURL?: string
}  

interface ChapterListEl {
    props: ChapterListElType
}

export default function ChapterListEl({props}: ChapterListEl) {
    const [opened, isOpened] = useState<boolean>(false);

    const bodyRef = useRef<HTMLDivElement>(null);

    function handleClick(e: React.MouseEvent<HTMLElement>) {
        isOpened(!opened)
    }

    return ( 
        <div className="chapter-list-el">
            <div className="chapter-list-head" onClick={handleClick}>
                <div className="chapter-list-left">
                    {props.position ? <div className="position">{props.position}</div> : ''}
                    <div className="title">{props.chapterTitle}</div>
                </div>
                <div className="chapter-list-right">
                    <Button props={{
                        text: !opened ? 'Espandi capitolo' : 'Chiudi capitolo',
                        btnStyle: 'filled-btn'
                    }}/>
                </div>
            </div>

            <div ref={bodyRef} className={`chapter-list-body ${opened ? 'opened' : 'closed'}`} style={{height: `${opened ? bodyRef.current!.scrollHeight : 0}px`}}>
                <div className="body-inner">
                    <p className="short-description mb-20">Contenuto</p>
                    <div className="attachments mb-30">
                        <p className="mb-10">Allegati: </p>
                        <div className="attachments-btn">
                            <Button props={{
                                text: 'Vedi modello 3D',
                                btnStyle: 'outline-btn',
                                icon: <i className="bi bi-badge-3d"></i>
                            }} />
                            <Button props={{
                                text: 'Vedi mappa concettuale',
                                btnStyle: 'outline-btn',
                                icon: <i className="bi bi-diagram-3"></i>
                            }} />
                        </div>
                    </div>
                    <div className="actions">
                        <Button props={{
                            text: 'Inizia capitolo',
                            btnStyle: 'filled-btn',
                            icon: <i className="bi bi-arrow-right-circle"></i>,
                            url: props.chapterURL,
                            newTab: true
                        }} />
                    </div>
                </div>
            </div>
        </div>
    )
}