import { useState, useEffect } from "react"
import { ParagraphStructure } from "./data/ParagraphStructure"
import http from "../../http"

export default function ParagraphModel() {
    const [_ps, setPS]= useState<any>(ParagraphStructure)
    const [_sk, setSK] = useState<any>(Object.keys(ParagraphStructure))
    
    // const structureKeys = Object.keys(ParagraphStructure)

    /**
     * Call this function when you have to send an API request to CHATGPT or GEMINI AI
     * to auto generate the content for the paragraph.
     * @param e 
     * @param pTitle 
     */
    function generateWithAi(e, pTitle) {
        alert("Stiamo generando con AI: " + pTitle)

        const generativeCtx = e.target.parentElement
        const paragraphInput = generativeCtx.querySelector('input')

        http.post('http://127.0.0.1:5000/gemini')
            .then(res => {
                const data = res.data
                const message = JSON.parse(res.data.message)

                const questions = Object.keys(message)

                console.log(message)

                ParagraphStructure.introduction.subparagraphs[0].pattern = [message[questions[0]]]
                ParagraphStructure.introduction.subparagraphs[1].pattern = [message[questions[1]]]
                ParagraphStructure.introduction.subparagraphs[2].pattern = [message[questions[2]]]

                setPS(ParagraphStructure)
                setSK(Object.keys(ParagraphStructure))
            })
            .catch(err => {
                throw err
            })
    }

    /**
     * Use this function to render pattern or patterns of subparagraphs.
     * 
     * @param subp 
     * @returns 
     */
    function generatePatternStructure(subp) {
        const subpKeys = Object.keys(subp)

        if (subpKeys.includes('pattern') || subpKeys.includes('patterns')) {
            return (
                <li>
                    {
                        subp.pattern.map((p, i) => {
                            return (
                                p.includes('[') ? <input key={i} value={p} /> : <span>{p} </span>
                            )
                        })
                    }
                </li>
            )
        }

        // if (subpKeys.includes('patterns')) {
        //     return (
        //         <p>With PATTERNS</p>
        //     )
        // }
    }

    return (
        <div className="p-model">
            {
                _ps && _sk ? _sk.map((p, i) => {
                    const pTitle = _ps[p].title
                    const subP = _ps[p].subparagraphs

                    return (
                        <div key={i} style={{borderBottom: 'solid 1px #000', padding: '15px 0'}}>
                            <p style={{fontWeight: 800}}>{pTitle}</p>

                            <div className="generative-ctx">
                                <ul>
                                {   
                                    subP.map((subp, i) => {
                                        const subpTitle = subp.title
                                        
                                        return (
                                            <li key={i}>
                                                <strong>{subpTitle}</strong>

                                                <ul>
                                                    {generatePatternStructure(subp)}
                                                </ul>
                                            </li>
                                        )
                                    })
                                }
                                </ul>

                                <button 
                                    style={{margin: '10px 0 0 0', display: 'block'}} 
                                    onClick={e => generateWithAi(e, pTitle)}>
                                    Genera con AI
                                </button>
                            </div>
                        </div>
                    )
                }): <p>Caricamento</p>
            } 
        </div>
    )
}