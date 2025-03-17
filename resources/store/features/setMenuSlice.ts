import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';

export interface SetMenu {
    id: number,
    name: string,
    description: string|null,
    price: number,
    min_spend: number,
    thumbnail: string,
    cuisines: [
        {
            id: number,
            name: string
        }
    ]
}

interface SetMenuState {
    setMenus: SetMenu[],
    hasNextPage: boolean
}

const initialState: SetMenuState={
    setMenus: [],
    hasNextPage: true
}

export const fetchSetMenus = createAsyncThunk('setMenu/fetch', async ({slug, page, numberOfGuests, append}: {slug: string|null, page: number, numberOfGuests: number, append: boolean} ) => {
    let url;
    if (slug) {
        url = "http://localhost/api/set-menus/" + slug + "?page=" + page + "&number_of_guests=" + numberOfGuests
    } else {
        url = "http://localhost/api/set-menus?page=" + page + "&number_of_guests=" + numberOfGuests
    }

    const response = await fetch(url, {
        method: 'GET',
    });
    return response.json();
});

export const SetMenuSlice=createSlice({
    name: "setMenus",
    initialState,
    reducers: {},
    extraReducers:(builder)=> {
        builder.addCase(fetchSetMenus.fulfilled, (state, action) => {
            state.setMenus = action.meta.arg.append ? [...state.setMenus, ...action.payload.data] : action.payload.data
            state.hasNextPage = action.payload.links.next !== null
        })
    }
})
