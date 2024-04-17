import { createRoot } from 'react-dom/client'
import ChapterListing from './ChapterListing';

// Check if the root exists.
if (document.querySelector('#exams-root')) {
    const root = createRoot( (document.querySelector('#exams-root') as Element) );
    root.render(<ChapterListing />);
}