import { useState, useRef } from 'react'
import * as DOMPurify from 'dompurify'

type ParagraphAccordionType = {
    title: string,
    content: string
}  

interface ParagraphAccordion {
    props: ParagraphAccordionType
}

export default function ParagraphAccordion({props}: ParagraphAccordion) {
    const [opened, isOpened] = useState<boolean>(false);

    const accordionBodyRef = useRef<HTMLDivElement>(null)

    function handleClick(e: React.MouseEvent<HTMLElement>) {
        isOpened(!opened)

        console.log(accordionBodyRef.current?.scrollHeight)
    }

    return (
        <div className="paragraph-acc">
            <div className="paragraph-acc-inner">
                <div className="paragraph-acc-head" onClick={handleClick}>
                    <div className='left'>{props.title}</div>
                    <div className='right'><i className="bi bi-chevron-down" style={{transform: `rotate(${opened ? '180deg' : '0deg'})`}}></i></div>
                </div>
                <div ref={accordionBodyRef} className={`paragraph-acc-body ${opened ? 'opened' : 'closed'}`} style={{height: `${opened ? accordionBodyRef.current!.scrollHeight : 0}px`}}>
                    <div 
                        className="content-wrap"
                        
                    >
                        <div className="content mb-20" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(props.content) }}></div>
                        <div>
                            <p>Qui aggiungere la possibilità di mettere le flashcards utente registrato normale 1 flashcard per paragrago | utente premium illimitate flascard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}