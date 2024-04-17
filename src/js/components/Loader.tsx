/**
 * Types of Props of the Loader.
 */
type Props = {
    loaderText?: string
}

/**
 * Loader interface.
 */
interface Loader {
    props: Props
}

/**
 * Loader component.
 */
export default function Loader({props}: Loader) {
    return (
        <div className="loader-wrap">
            <div className="loader-inner">
                <div className="loader"></div>
                { props.loaderText ? <p className="text">{props.loaderText}</p> : '' }
            </div>
        </div>
    )
}