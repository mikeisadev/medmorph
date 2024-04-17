import { useState, useEffect, useId } from "react"
import axios from "axios"
import { examChaptersEndpoint } from "../../config"
import Loader from "../components/Loader";
import ChapterListEl from "../components/ChapterListEl";

type ChapterUrls = {
    chapter: string
}

interface Chapter {
    chapter_title: string,
    urls: ChapterUrls
}

export default function ChapterListing() {
    const [chapters, setChapters] = useState<null|Array<Chapter>>(null);

    useEffect(() => {
        axios.get(examChaptersEndpoint + '?exam-slug=' + location.pathname)
            .then(res => {
                setChapters(res.data)
            })
            .catch(err => {
                throw err;
            })
    }, []);
        
    return (
        <>
        { chapters ?
            <div className="chapters-list">
                { chapters.map((value, index) => {
                    console.log(value.urls.chapter)
                    return <ChapterListEl 
                            props={{
                                chapterTitle: value.chapter_title,
                                position: index+1,
                                chapterURL: value.urls.chapter
                            }}
                        />
                })}
            </div>
            :
            <Loader props={{loaderText: 'Stiamo caricando i capitoli...'}}/>
        }
        </>
    )
}