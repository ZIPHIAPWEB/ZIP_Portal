import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";
import SuperadminApi from "../services/SuperadminApi";

export interface ISuperadminAdditionalRequirement {
    id: string | number;
    name: string;
    description: string;
    path?: string;
    is_active: boolean;
    program_id: string;
    program?: string;
    created_at?: string;
}

export interface ISuperadminAdditionalRequirementState extends IBaseState, IPagination{
    additionals: ISuperadminAdditionalRequirement[]
}

export const useSuperadminAdditionalRequirementStore = defineStore({
    id: 'superadminAdditionalRequirement',
    state: () : ISuperadminAdditionalRequirementState => ({
        additionals: [],
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: []
    }),
    actions: {
        async loadSuperadminAdditionalRequirements() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllAdditionalRequirements()).data;
                this.additionals = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminAdditionalRequirement(data : ISuperadminAdditionalRequirement) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeAdditionalRequirement(data);
                this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminAdditionalRequirement(data : ISuperadminAdditionalRequirement, additionalId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateAdditionalRequirement(data, additionalId);
                this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminAdditionalRequriement(additionalId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteAdditionalRequirement(additionalId);
                this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async uploadSuperadminAdditionalRequirementFile(file: File, additionalId : string | number | undefined) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadAdditionalReqFile(file, additionalId);
                this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async removeSuperadminAdditionalRequirementFile(additionalId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removeAdditionalReqFile(additionalId);
                this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})