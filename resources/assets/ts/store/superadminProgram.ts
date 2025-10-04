import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";
import { IActionResult } from "../interfaces/IActionResult";
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
    async loadSuperadminPrograms(): Promise<IActionResult<ISuperadminProgram[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPrograms()).data;
                this.programs = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.programs };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load programs', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminProgram(programId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteProgram(programId);
                await this.loadSuperadminPrograms();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete program', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
});