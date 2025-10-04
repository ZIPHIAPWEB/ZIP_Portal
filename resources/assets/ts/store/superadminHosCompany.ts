import { IBaseState } from "../interfaces/IBaseState";
import SuperadminApi from "../services/SuperadminApi";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface ISuperadminHostCompany {
    id: string | number;
    name: string;
    description: string;
    created_at?: string;
}

export interface ISuperadminHostCompanyState extends IBaseState {
    hostCompanies: ISuperadminHostCompany[]
}

export const useSuperadminHostCompanyStore = defineStore({
    id: 'superadminHostCompany',
    state: () : ISuperadminHostCompanyState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        hostCompanies: []
    }),
    actions : {
    async loadSuperadminHostCompanies(): Promise<IActionResult<ISuperadminHostCompany[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllHostCompanies()).data;
                this.hostCompanies = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.hostCompanies };
            } catch (error: any) {
                this.isSuccess = false;
                this.isLoading = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load host companies', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminHostCompany(data : ISuperadminHostCompany): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeHostCompany(data);
                await this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isSuccess = false;
                this.isLoading = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to store host company', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminHostCompany(data : ISuperadminHostCompany, companyId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateHostCompany(data, companyId);
                await this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isSuccess = false;
                this.isLoading = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to update host company', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadmonHostCompany(companyId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteHostCompany(companyId);
                await this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error: any) {
                this.isSuccess = false;
                this.isLoading = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete host company', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})