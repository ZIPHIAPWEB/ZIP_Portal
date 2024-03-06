import { defineStore } from "pinia";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";

export interface ISuperadminVisaSponsorRequirement {
    id: string | number;
    name: string;
    description: string;
    path?: string;
    is_active: boolean;
    sponsor_id: string;
    sponsor?: string;
    created_at?: string;
}

export interface ISuperadminVisaSponsorRequirementState extends IBaseState, IPagination {
    sponsorReqs: ISuperadminVisaSponsorRequirement[]
}

export const useSuperadminVisaSponsorRequirementStore = defineStore({
    id: 'superadminVisaSponsorRequirement',
    state: () : ISuperadminVisaSponsorRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        sponsorReqs: []
    }),
    actions: {
        async loadSuperadminVisaSponsorRequriements() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllVisaSponsorRequirements()).data;
                this.sponsorReqs = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async storeSuperadminVisaSponsorRequirement(data : ISuperadminVisaSponsorRequirement) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeVisaSponsorRequirement(data);
                this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSuperadminVisaSponsorRequirement(data : ISuperadminVisaSponsorRequirement, sponsorId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateVisaSponsorRequirement(data, sponsorId);
                this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async deleteSuperadminVisaSponsorRequriement(sponsorId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteVisaSponsorRequirement(sponsorId);
                this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async uploadSuperadminVisaSponsorRequirementFile(file: File, sponsorId : string | number | undefined) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadVisaSponsorReqFile(file, sponsorId);
                this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async removeSuperadminVisaSponsorRequirementFile(sponsorId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removeVisaSponsorReqFile(sponsorId);
                this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})