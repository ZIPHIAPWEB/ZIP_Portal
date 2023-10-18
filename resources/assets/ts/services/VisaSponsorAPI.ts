import { AxiosResponse } from "axios";
import { ApiRequest } from "./ApiRequest";

export default {
    getAllVisaSponsors() : Promise<AxiosResponse> {
        return ApiRequest.get(`/visa-sponsors`);
    }
}