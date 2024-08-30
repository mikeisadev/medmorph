import { useState, useRef } from "react"
import Button from "./Button"
import ContentCounter from "./ContentCounter"

type ChapterListElType = {
    chapterTitle: string;
    paragraphsCount?: number;
    position?: number;
    has3DModel?: boolean;
    hasMindMap?: boolean;
    chapterURL?: string;
    ModelURL?: string;
    MindMapURL?: string;
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
                    <div className="meta-data">
                        <ContentCounter  
                            props={{
                                count: props.paragraphsCount,
                                singular: 'paragrafo',
                                plural: 'paragrafi'
                            }}
                        />
                        {props.has3DModel ? <i className="bi bi-badge-3d"></i> : ''}
                        {props.hasMindMap ? <i className="bi bi-diagram-3"></i> : ''}
                    </div>
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
                    {
                        props.has3DModel || props.hasMindMap ?
                        <div className="attachments mb-30">
                            <p className="mb-10">Allegati: </p>
                            <div className="attachments-btn">
                                {
                                    props.has3DModel ? <Button props={{
                                        text: 'Vedi modello 3D',
                                        btnStyle: 'outline-btn',
                                        icon: <i className="bi bi-badge-3d"></i>
                                    }} /> : ''
                                }
                                {
                                    props.hasMindMap ? <Button props={{
                                        text: 'Vedi mappa concettuale',
                                        btnStyle: 'outline-btn',
                                        icon: <i className="bi bi-diagram-3"></i>
                                    }} /> : ''
                                }
                            </div>
                        </div>
                        : ''
                    }
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