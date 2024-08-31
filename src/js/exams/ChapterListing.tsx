import { useState, useEffect } from "react"
import http from "../../http";
import { examChaptersEP } from "../../config"
import Loader from "../components/Loader";
import ChapterListEl from "../components/ChapterListEl";

type ChapterUrls = {
    chapter: string;
}

type HasParagraphs = {
    count: number;
}

interface Chapter {
    chapter_title: string;
    urls: ChapterUrls;
    has_paragraphs: HasParagraphs | false;
    has_3d_models: boolean;
    has_mind_maps: boolean;
}

export default function ChapterListing() {
    const [chapters, setChapters] = useState<null|Array<Chapter>>(null);

    useEffect(() => {
        http.get(examChaptersEP + '?exam-slug=' + location.pathname)
            .then(res => {
                console.log(res.data.response.exam)
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
                    return <ChapterListEl 
                            props={{
                                chapterTitle: value.chapter_title,
                                position: index+1,
                                chapterURL: value.urls.chapter,
                                paragraphsCount: value.has_paragraphs ? value.has_paragraphs.count : 0,
                                has3DModel: value.has_3d_models,
                                hasMindMap: value.has_mind_maps
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