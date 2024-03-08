import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
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
        async loadSuperadminPaymentRequirements() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPaymentRequirements()).data;
                this.paymentReqs = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminPaymentRequirement(data : ISuperadminPaymentRequirement) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storePaymentRequirement(data);
                this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminPaymentRequirement(data : ISuperadminPaymentRequirement, paymentId: string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updatePaymentRequirement(data, paymentId);
                this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminPaymentRequirement(paymentId: string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deletePaymentRequirement(paymentId);
                this.loadSuperadminPaymentRequirements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})