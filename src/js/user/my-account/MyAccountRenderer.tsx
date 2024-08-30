import { createRoot } from "react-dom/client";
import MyAccount from "./MyAccount";

const root = createRoot( document.querySelector('#student-priv-area') as HTMLElement )
root.render(<MyAccount/>)