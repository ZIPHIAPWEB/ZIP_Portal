import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoord {
    username: string;
    email: string;
    first_name: string;
    middle_name: string;
    last_name: string;
    program: string;
    position: string;
    contact: string;
}

export interface ISuperadminCoord extends ICoord {
    id: number | string;
    user_id: number | string;
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
    async deleteSuperadminCoord(userId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteSuperadminCoord(userId);
                await this.loadSuperadminCoordsData();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete coordinator', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async searchSuperaminCoordData(searchData : string): Promise<IActionResult<ISuperadminCoord[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSearchCoordByUsername(searchData)).data;
                this.coordinators = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true, data: this.coordinators };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to search coordinators', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async createSuperadminCoord(coordData : ICoord): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.storeSuperadminCoords(coordData)).data;
                await this.loadSuperadminCoordsData();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to create coordinator', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async loadSuperadminCoordsData(): Promise<IActionResult<ISuperadminCoord[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSuperadminCoords()).data;
                this.coordinators = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.coordinators };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load coordinators', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async activateCoordUser(userId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.activateUserAccount(userId)).data;
                await this.loadSuperadminCoordsData();

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to activate coordinator', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deactivateCoordUser(userId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.deactivateUserAccount(userId)).data;
                await this.loadSuperadminCoordsData();

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to deactivate coordinator', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})