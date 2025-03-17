import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';

export interface Cuisine {
    id: number;
    name: string;
    slug: string;
    set_menus_count: number;
}

interface CuisineState {
    cuisines: Cuisine[];
}

const initialState: CuisineState = {
    cuisines: [],
};

export const fetchCuisines = createAsyncThunk('cuisine/fetch', async (thunkApi) => {
    const response = await fetch('http://localhost/api/cuisines', {
        method: 'GET',
    });
    return response.json();
});

export const CuisineSlice = createSlice({
    name: 'cuisines',
    initialState,
    reducers: {},
    extraReducers:(builder)=> {
        builder.addCase(fetchCuisines.fulfilled, (state, action) => {
            state.cuisines = action.payload
        })
    }
});
