/**
 * React anchors
 */
const portals: Element = document.querySelector('#portals') as Element
const body: Element    = document.body

// Functions
// portals?.addEventListener('click', e => {
//     e.stopImmediatePropagation()

//     if (!portals.classList.contains('hide')) {
//         portals.querySelector('div')?.remove()
//         portals.classList.add('hide')
//     }
// })

/**
 * Main script.
 */
import './js/dropdown';
import './js/exams/Exam';

/**
 * SCSS.
*/
import '../node_modules/bootstrap-icons/font/bootstrap-icons.scss';
import './scss/main.scss';

export {
    portals,
    body
}
