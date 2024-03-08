import { IBaseState } from "../interfaces/IBaseState";
import SuperadminApi from "../services/SuperadminApi";
import { defineStore } from "pinia";

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
        async loadSuperadminHostCompanies() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllHostCompanies()).data;
                this.hostCompanies = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isSuccess = false;
                this.isLoading = false;
            }
        },
        async storeSuperadminHostCompany(data : ISuperadminHostCompany) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeHostCompany(data);
                this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isSuccess = false;
                this.isLoading = false;
            }
        },
        async updateSuperadminHostCompany(data : ISuperadminHostCompany, companyId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateHostCompany(data, companyId);
                this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isSuccess = false;
                this.isLoading = false;
            }
        },
        async deleteSuperadmonHostCompany(companyId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteHostCompany(companyId);
                this.loadSuperadminHostCompanies();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isSuccess = false;
                this.isLoading = false;
            }
        }
    }
})