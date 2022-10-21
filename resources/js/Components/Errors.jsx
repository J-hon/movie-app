export default function InputErrors({ errors }) {

    return (
        <div className="rounded-md bg-red-50 p-4">
            <div className="flex">
                <div className="ml-3">
                    <h3 className="text-sm font-medium text-red-800">There were { errors.length } errors with your submission</h3>
                    <div className="mt-2 text-sm text-red-700">
                        <ul role="list" className="list-disc space-y-1 pl-5">
                            { errors.map((error) => (
                                <li>{ error }</li>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    )
}
