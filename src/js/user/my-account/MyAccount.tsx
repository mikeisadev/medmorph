import { useState, useEffect } from "react"
import http from "../../../http";
import { BrowserRouter, Routes, Route, Link } from "react-router-dom";
import NoticeBoard from "./Pages/NoticeBoard";
import EditAccount from "./Pages/EditAccount";
import ExamListing from "./Pages/ExamListing";
import FlashcardListing from "./Pages/FlashcardListing";
import LiveChat from "./Pages/LiveChat";

export default function MyAccount() {
    // Load initial data.
    useEffect(() => {
        
    }, [])

    return (
        <BrowserRouter basename="/studente">
            <div className="student priv-area">
                <div className="area-menu">
                    <ul>
                        <Link to="/">Bacheca</Link>
                        <Link to="/modifica-profilo">Modifica profilo</Link>
                        <Link to="/esami">Esami</Link>
                        <Link to="/flashcards">Flashcards</Link>
                        <Link to="/live-chat">Live chat</Link>
                    </ul>
                </div>

                <div className="area-content">
                    <Routes>
                        <Route index element={<NoticeBoard />} />
                        <Route path="/modifica-profilo" element={<EditAccount />} />
                        <Route path="/esami" element={<ExamListing />} />
                        <Route path="/flashcards" element={<FlashcardListing />} />
                        <Route path="/live-chat" element={<LiveChat />} />
                    </Routes>
                </div>
            </div>
        </BrowserRouter>
    )
}