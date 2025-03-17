import { useAppDispatch, useAppSelector } from '@/store';
import { addGuest, removeGuest, setNumberOfGuests } from '../../store/features/filterSlice';

export default function GuestsNumberSelector() {
    const dispatch = useAppDispatch()
    const numberOfGuests = useAppSelector((state) => state.filter.filter.numberOfGuests)

    return (
        <form className={"mt-3"}>
            <label htmlFor="quantity-input" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Set Menus
            </label>
            <div className="relative flex items-center max-w-[8rem]">
                <button onClick={() => dispatch(removeGuest())} type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                        className="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg className="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor"
                              d="M1 1h16" />
                    </svg>
                </button>
                <input
                    onChange={(e) => dispatch(setNumberOfGuests({ numberOfGuests: parseInt(e.currentTarget.value)}))} type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation"
                       className="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="1" required value={numberOfGuests} />
                <button onClick={() => dispatch(addGuest())}  type="button" id="increment-button" data-input-counter-increment="quantity-input"
                        className="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg className="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor"
                              d="M9 1v16M1 9h16" />
                    </svg>
                </button>
            </div>
            <span className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guests</span>
        </form>
    )
}
