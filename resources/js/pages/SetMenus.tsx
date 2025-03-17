import React, { useEffect } from 'react';
import MainLayout from "@/layouts/MainLayout";
import { useAppDispatch, useAppSelector } from '@/store';
import { fetchCuisines } from '../../store/features/cuisineSlice';
import GuestsNumberSelector from '@/components/GuestsNumberSelector';
import CuisineFilters from '@/components/CuisineFilters';
import SetMenusList from '@/components/SetMenusList';
import { fetchSetMenus } from '../../store/features/setMenuSlice';

export default function SetMenus() {
    const dispatch = useAppDispatch()
    const numberOfGuests = useAppSelector((state) => state.filter.filter.numberOfGuests)
    const cuisineSlug = useAppSelector((state) => state.filter.filter.cuisineSlug)
    const page = useAppSelector((state) => state.filter.filter.page)

    useEffect(() => {
        dispatch(fetchCuisines())
    }, [])

    useEffect(() => {
        dispatch(fetchSetMenus({
            slug: cuisineSlug,
            page: page,
            numberOfGuests: numberOfGuests,
            append: page !== 1
        }))
    }, [numberOfGuests, cuisineSlug, page]);

    return (
            <MainLayout>
                <GuestsNumberSelector/>
                <CuisineFilters/>
                <SetMenusList/>
            </MainLayout>
        )

}
