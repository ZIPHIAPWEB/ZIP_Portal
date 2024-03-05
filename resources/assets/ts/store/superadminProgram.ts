import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";
import { defineStore } from "pinia";

export interface ISuperadminProgram {
    id: string | number;
    name: string;
    display_name: string;
    description: string;
    category: string;
    date_created: string;
}

export interface ISuperadminProgramState extends IBaseState, IPagination {
    programs: ISuperadminProgram[]
}

export const useSuperadminProgram = defineStore({
    id: 'superadminProgram',
    state: () : ISuperadminProgramState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        programs: []
    }),
    actions: {
        async loadSuperadminPrograms() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPrograms()).data;
                this.programs = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                
            }
        },
        async deleteSuperadminProgram(programId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteProgram(programId);
                await this.loadSuperadminPrograms();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                
            }
        }
    }
});