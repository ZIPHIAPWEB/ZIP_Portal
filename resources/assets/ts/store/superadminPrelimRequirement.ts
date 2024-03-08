import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";

export interface ISuperadminPrelimRequirement {
    id: string | number;
    name: string;
    description: string;
    path?: string;
    is_active: boolean;
    program_id: string;
    program?: string;
    created_at?: string;
}

export interface ISuperadminPrelimRequirementWithFile extends ISuperadminPrelimRequirement {
    file : File;
}

export interface ISuperadminPrelimRequirementState extends IBaseState, IPagination {
    prelims: ISuperadminPrelimRequirement[];
}

export const useSuperadminPrelimRequirementStore = defineStore({
    id: 'superadminPrelimRequirement',
    state: () : ISuperadminPrelimRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        prelims: [],
        links: []
    }),
    actions : {
        async loadSuperadminPrelimRequirements() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPrelimRequirements()).data;
                this.prelims = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminPrelimRequirement(data : ISuperadminPrelimRequirement) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storePrelimRequirement(data);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminPrelimRequirement(data : ISuperadminPrelimRequirement, prelimId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updatePrelimRequire(data, prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminPrelimRequirement(prelimId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deletePrelimRequirement(prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async uploadSuperadminPrelimRequirementFile(file: File, prelimId : string | number | undefined) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadPrelimReqFile(file, prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async removeSuperadminPrelimRequirementFile(prelimId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removePrelimReqFile(prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})