import { configureStore } from '@reduxjs/toolkit'
import { CuisineSlice } from '../store/features/cuisineSlice';
import { SetMenuSlice } from '../store/features/setMenuSlice';
import { TypedUseSelectorHook, useDispatch, useSelector } from 'react-redux';
import { FilterSlice } from '../store/features/filterSlice';

const store = configureStore({
    reducer: {
        cuisines: CuisineSlice.reducer,
        setMenus: SetMenuSlice.reducer,
        filter: FilterSlice.reducer
    },
});

export default store
export const useAppDispatch:()=> typeof store.dispatch = useDispatch;
export const useAppSelector:TypedUseSelectorHook<ReturnType<typeof store.getState>> = useSelector;
