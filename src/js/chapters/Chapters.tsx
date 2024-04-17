import { createRoot } from 'react-dom/client'
import ChaptersViewer from './ChaptersViewer';

const root = createRoot( (document.querySelector('#chapter-viewer') as Element) );
root.render(<ChaptersViewer />);