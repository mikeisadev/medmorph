type ContentCounterType = {
    count: number | undefined;
    singular: string;
    plural: string;
    addBrackets?: boolean;
    icon?: React.ReactNode;
}

interface ContentCounter {
    props: ContentCounterType;
}

export default function ContentCounter({props}: ContentCounter) {

    return (
        <p>
            {props.addBrackets ? '(' : ''}
            {props.icon ? props.icon : ''}
            {
                props.count ?
                    props.count === 0 || props.count > 1 ?
                        props.count + ' ' + props.plural : props.count + ' ' + props.singular
                    :
                    '0 ' + props.plural
            }
            {props.addBrackets ? ')' : ''}
        </p>
    )
}