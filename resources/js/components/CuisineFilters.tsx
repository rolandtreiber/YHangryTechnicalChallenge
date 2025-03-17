import { useAppDispatch, useAppSelector } from '@/store';
import { Cuisine } from '../../store/features/cuisineSlice';
import { setCuisineSlug, setPage, setTotal } from '../../store/features/filterSlice';
import { useEffect } from 'react';

export default function CuisineFilters() {
    const dispatch = useAppDispatch()

    const cuisines = useAppSelector((state) => state.cuisines.cuisines)
    const cuisineSlug = useAppSelector((state) => state.filter.filter.cuisineSlug)
    const total = useAppSelector((state) => state.filter.filter.total);

    const allAvailableCuisines = () => {
        let all = 0;
        cuisines.map(cuisine => all += cuisine.set_menus_count)
        return all
    }

    useEffect(() => {
        if (total === 0) {
            dispatch(setTotal({total: allAvailableCuisines()}))
        }
    }, [total, cuisines]);

    const defaultBadgeClasses = "cursor-pointer bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300"
    const activeBadgeClasses = "cursor-pointer inline-block bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300"
    return (
        <>
            <label htmlFor="quantity-input" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                 Filters
            </label>
            <div>
                <span
                    onClick={() => {
                        dispatch(setPage({ page : 1 }))
                        dispatch(setCuisineSlug({ cuisineSlug : "", total: allAvailableCuisines() }))
                    }}
                    className={(!cuisineSlug || cuisineSlug === "") ? activeBadgeClasses : defaultBadgeClasses}>All ({allAvailableCuisines()})</span>
                {cuisines.map((cuisine: Cuisine) => (
                    <span key={cuisine.id}
                          onClick={() => dispatch(setCuisineSlug({ cuisineSlug : cuisine.slug, total: cuisine.set_menus_count }))}
                        className={cuisineSlug === cuisine.slug ? activeBadgeClasses : defaultBadgeClasses}>{cuisine.name} ({cuisine.set_menus_count})</span>
                ))}
            </div>
        </>
    )
}
