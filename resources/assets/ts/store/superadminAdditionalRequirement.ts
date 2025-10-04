import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { IActionResult } from "../interfaces/IActionResult";
import { defineStore } from "pinia";

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

export interface ISuperadminAdditionalRequirementWithFile extends ISuperadminAdditionalRequirement {
    file : File;
}

export interface ISuperadminAdditionalRequirementState extends IBaseState, IPagination {
    additionals: ISuperadminAdditionalRequirement[];
}

export const useSuperadminAdditionalRequirementStore = defineStore({
    id: 'superadminAdditionalRequirement',
    state: () : ISuperadminAdditionalRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        additionals: [],
        links: []
    }),
    actions : {
    async loadSuperadminAdditionalRequirements(): Promise<IActionResult<ISuperadminAdditionalRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllAdditionalRequirements()).data;
                this.additionals = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.additionals };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load additional requirements', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminAdditionalRequirement(data : ISuperadminAdditionalRequirement): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeAdditionalRequirement(data);
                await this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to store additional requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminAdditionalRequirement(data : ISuperadminAdditionalRequirement, additionalId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateAdditionalRequirement(data, additionalId);
                await this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to update additional requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminAdditionalRequirement(additionalId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteAdditionalRequirement(additionalId);
                await this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete additional requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async uploadSuperadminAdditionalRequirementFile(file: File, additionalId : string | number | undefined): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadAdditionalReqFile(file, additionalId);
                await this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to upload additional file', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async removeSuperadminAdditionalRequirementFile(additionalId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removeAdditionalReqFile(additionalId);
                await this.loadSuperadminAdditionalRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to remove additional file', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})