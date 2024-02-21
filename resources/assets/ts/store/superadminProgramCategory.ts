import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { defineStore } from "pinia";

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
    created_at: string;
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
        async loadProgramCategories() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllProgramCategories()).data;
                this.programCategories = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeProgramCategory(data : IProgramCategoryForm) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeProgramCategory(data);
                this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = false;
            } catch (error) {
                
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateProgramCategory(data : IProgramCategoryForm, categoryId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateProgramCategory(data, categoryId);
                this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteProgramCategory(categoryId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteProgram(categoryId);
                this.loadProgramCategories();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})