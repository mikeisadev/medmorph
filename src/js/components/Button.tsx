type ButtonType = {
    text: string
    btnStyle?: 'outline-btn' | 'filled-btn'
    icon?: React.ReactNode
    url?: string,
    newTab?: boolean
}

interface Button {
    props: ButtonType
}

export default function Button({props}: Button) {

    return (
        <>
        {
            props.url ?
            <a href={props.url} role="button" className={props.btnStyle} target={props.newTab ? '_blank' : ''}>
                {props.text}
                {props.icon ? props.icon : ''}
            </a>
            :
            <button className={props.btnStyle}>
                {props.text}
                {props.icon ? props.icon : ''}
            </button>
        }
        </>
    )
}