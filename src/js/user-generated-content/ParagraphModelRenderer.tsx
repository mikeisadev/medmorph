import { createRoot } from "react-dom/client";
import ParagraphModel from "./ParagraphModel";

const root = createRoot(document.querySelector('#standard-model') as Element)
root.render(<ParagraphModel/>)