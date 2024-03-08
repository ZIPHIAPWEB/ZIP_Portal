import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";

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
        async loadSuperadminVisaSponsors() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllVisaSponsors()).data;
                this.sponsors = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminVisaSponsor(data : ISuperadminVisaSponsor) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeVisaSponsor(data);
                this.loadSuperadminVisaSponsors();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminVisaSponsor(data : ISuperadminVisaSponsor, sponsorId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateProgram(data, sponsorId);
                this.loadSuperadminVisaSponsors();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminVisaSponsor(sponsorId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteVisaSponsor(sponsorId);
                this.loadSuperadminVisaSponsors();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})