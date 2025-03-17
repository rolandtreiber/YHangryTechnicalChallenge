import { useAppDispatch, useAppSelector } from '@/store';
import { increasePageNumber } from '../../store/features/filterSlice';

export default function SetMenusList() {
    const dispatch = useAppDispatch()
    const setMenus = useAppSelector((state) => state.setMenus.setMenus);
    const hasNextPage = useAppSelector((state) => state.setMenus.hasNextPage);
    const total = useAppSelector((state) => state.filter.filter.total);

    return (
        <div className={'mt-5 w-full'}>
            <div className="columns-3">
                {setMenus.map((setMenu) => (
                    <div
                        key={setMenu.id}
                        className="mb-2 break-inside-avoid-column rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <img className={'w-full rounded-lg'} src={setMenu.thumbnail} />
                        <div className="mb-2 p-6">
                            {setMenu.cuisines.map((cuisine) => (
                                <span
                                    key={cuisine.id}
                                    className="me-2 rounded-sm bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300"
                                >
                                    {cuisine.name}
                                </span>
                            ))}
                            <p className="mt-2 mb-3 font-bold text-gray-700 dark:text-gray-400">{setMenu.name}</p>
                            <p className="mt-2 mb-3 font-light text-gray-700 dark:text-gray-400">{setMenu.description}</p>
                            <p className="mt-2 mb-3 font-bold text-gray-700 dark:text-gray-400">
                                £{setMenu.price > setMenu.min_spend ? setMenu.price : setMenu.min_spend}
                            </p>
                        </div>
                    </div>
                ))}
            </div>
            <div className={"w-full text-center mt-3 mb-3"}>
                <button
                    disabled={!hasNextPage}
                    onClick={() => dispatch(increasePageNumber())}
                    type="button"
                    className={"me-2 mb-2 rounded-lg bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" + (hasNextPage ? " cursor-pointer" : " cursor-not-allowed")}
                >
                    Load more
                </button>
                <p>
                    Showing {setMenus.length} of {total} menus
                </p>
            </div>
        </div>
    );
}
