import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";
import { defineStore } from "pinia";

export interface ISuperadminDegree {
    id: string | number;
    name: string;
    display_name: string;
    created_at?: string;
}

export interface ISuperadminDegreeState extends IBaseState, IPagination {
    degrees: ISuperadminDegree[]
}

export const useSuperadminDegreeStore = defineStore({
    id: "superadminDegree",
    state: () : ISuperadminDegreeState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        degrees: []
    }),
    actions: {
        async loadSuperadminDegrees() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllDegrees()).data;
                this.degrees = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminDegree(data : ISuperadminDegree) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.storeDegree(data));
                this.loadSuperadminDegrees();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminDegree(data : ISuperadminDegree, degreeId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.updateDegree(data, degreeId));
                this.loadSuperadminDegrees();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminDegree(degreeId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.deleteDegree(degreeId));
                this.loadSuperadminDegrees();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})