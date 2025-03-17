import { createSlice, PayloadAction } from '@reduxjs/toolkit';

export interface Filter {
    cuisineSlug: string;
    page: number;
    numberOfGuests: number;
    total: number;
}

interface FilterState {
    filter: Filter;
}

const initialState: FilterState = {
    filter: {
        cuisineSlug: "",
        page: 1,
        numberOfGuests: 1,
        total: 0
    },
};

export const FilterSlice = createSlice({
    name: 'filter',
    initialState,
    reducers: {
        setCuisineSlug: (state, action: PayloadAction<{ cuisineSlug: string, total: number }>) => {
            state.filter = {...state.filter, cuisineSlug: action.payload.cuisineSlug, page: 1, total: action.payload.total}
        },
        setTotal: (state, action: PayloadAction<{ total: number }>) => {
            state.filter = {...state.filter, total: action.payload.total}
        },
        setPage: (state, action: PayloadAction<{ page: number }>) => {
            state.filter = {...state.filter, page: action.payload.page}
        },
        increasePageNumber: (state, action: PayloadAction) => {
            const currentValue = state.filter.page
            state.filter = {...state.filter, page: currentValue + 1}
        },
        setNumberOfGuests: (state, action: PayloadAction<{ numberOfGuests: number }>) => {
            state.filter = {...state.filter, numberOfGuests: action.payload.numberOfGuests}
        },
        addGuest: (state, action: PayloadAction) => {
            const currentValue = state.filter.numberOfGuests
            state.filter = {...state.filter, numberOfGuests: currentValue + 1, page: 1}
        },
        removeGuest: (state, action: PayloadAction) => {
            const currentValue = state.filter.numberOfGuests
            state.filter = {...state.filter, numberOfGuests: currentValue > 1 ? currentValue - 1 : 1, page: 1}
        },
    },
});

export const { setCuisineSlug, setTotal, setPage, setNumberOfGuests, addGuest, removeGuest, increasePageNumber } = FilterSlice.actions
