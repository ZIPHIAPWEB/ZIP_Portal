import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface ISuperadminVisaSponsor {
    id: string | number;
    name: string;
    display_name: string;
    description: string;
    created_at?: string;
}

export interface ISuperadminVisaSponsorState extends IBaseState, IPagination {
    sponsors: ISuperadminVisaSponsor[]
}

export const useSuperadminVisaSponsorStore = defineStore({
    id: 'superadminVisaSponsor',
    state: () : ISuperadminVisaSponsorState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        sponsors: [],
        links: []
    }),
    actions: {
    async loadSuperadminVisaSponsors(): Promise<IActionResult<ISuperadminVisaSponsor[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllVisaSponsors()).data;
                this.sponsors = response.data;
                this.links = response.meta.links;

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true, data: this.sponsors };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load visa sponsors', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminVisaSponsor(data : ISuperadminVisaSponsor): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeVisaSponsor(data);
        await this.loadSuperadminVisaSponsors();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to store visa sponsor', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminVisaSponsor(data : ISuperadminVisaSponsor, sponsorId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateProgram(data, sponsorId);
        await this.loadSuperadminVisaSponsors();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to update visa sponsor', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminVisaSponsor(sponsorId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteVisaSponsor(sponsorId);
        await this.loadSuperadminVisaSponsors();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete visa sponsor', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})