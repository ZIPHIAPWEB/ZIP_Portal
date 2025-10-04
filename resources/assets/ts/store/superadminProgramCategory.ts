import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface IProgramCategoryForm {
    name: string;
    display_name: string;
    description: string;
}

export interface ISuperadminProgramCategory {
    id: string | number;
    name: string;
    display_name: string;
    description: string;
    created_at?: string;
}

export interface ISuperadminProgramCategoryState extends IBaseState{
    programCategories: ISuperadminProgramCategory[];
}

export const useSuperadminProgramCategory = defineStore({
    id: 'superadminProgramCategory',
    state: () : ISuperadminProgramCategoryState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        programCategories: []
    }),
    actions : {
    async loadProgramCategories(): Promise<IActionResult<ISuperadminProgramCategory[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllProgramCategories()).data;
                this.programCategories = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.programCategories };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load program categories', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeProgramCategory(data : IProgramCategoryForm): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeProgramCategory(data);
                await this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to store program category', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateProgramCategory(data : IProgramCategoryForm, categoryId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateProgramCategory(data, categoryId);
                await this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to update program category', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteProgramCategory(categoryId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteProgramCategory(categoryId);
                await this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete program category', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})