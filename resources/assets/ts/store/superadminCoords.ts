import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";

export interface ISuperadminCoord {
    user_id: number | string;
    first_name: string;
    middle_name: string;
    last_name: string;
    program: string;
    position: string;
    contact: string;
    is_activated: string;
    registered_at: string;
}

export interface ISuperadminCoordState extends IBaseState, IPagination {
    coordinators: ISuperadminCoord[]
}

export const useSuperadminCoord = defineStore({
    id: 'superadminCoord',
    state: () : ISuperadminCoordState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        coordinators: []
    }),
    actions: {
        async loadSuperadminCoordsData() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSuperadminCoords()).data;
                this.coordinators = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async activateCoordUser(userId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.activateUserAccount(userId)).data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deactivateCoordUser(userId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.deactivateUserAccount(userId)).data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})