import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { IActionResult } from "../interfaces/IActionResult";
import { defineStore } from "pinia";

export interface ISuperadminPaymentRequirement {
    id: string | number;
    program_id: string;
    program?: string;
    name: string;
    description: string;
    is_active: boolean;
    created_at?: string;
}

export interface ISuperadminPaymentRequirementState extends IBaseState, IPagination {
    paymentReqs: ISuperadminPaymentRequirement[]
}

export const useSuperadminPaymentRequirementStore = defineStore({
    id: 'superadminPaymentRequirement',
    state: () : ISuperadminPaymentRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        paymentReqs: []
    }),
    actions: {
    async loadSuperadminPaymentRequirements(): Promise<IActionResult<ISuperadminPaymentRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPaymentRequirements()).data;
                this.paymentReqs = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.paymentReqs };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load payment requirements', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminPaymentRequirement(data : ISuperadminPaymentRequirement): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storePaymentRequirement(data);
                await this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to store payment requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminPaymentRequirement(data : ISuperadminPaymentRequirement, paymentId: string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updatePaymentRequirement(data, paymentId);
                await this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to update payment requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminPaymentRequirement(paymentId: string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deletePaymentRequirement(paymentId);
                await this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete payment requirement', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})