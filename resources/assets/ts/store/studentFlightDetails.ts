import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentMnlDepartDetails {
    mnl_departure_date: string;
    mnl_departure_time: string;
    mnl_departure_flight_no: string;
    mnl_departure_airline: string;
}

export interface IStudentUsArrivalDetails {
    us_arrival_date: string;
    us_arrival_time: string;
    us_arrival_flight_no: string;
    us_arrival_airline: string;
}

export interface IStudentUsDepartDetails {
    us_departure_date: string;
    us_departure_time: string;
    us_departure_flight_no: string;
    us_departure_airline: string;
}

export interface IStudentMnlArrivalDetails {
    mnl_arrival_date: string;
    mnl_arrival_time: string;
    mnl_arrival_flight_no: string;
    mnl_arrival_airline: string;
}

export interface IStudentFlightDetailsState {
    isSuccess: boolean;
    isLoading: boolean;
    mnlDeparture: IStudentMnlDepartDetails;
    usArrival: IStudentUsArrivalDetails;
    usDeparture: IStudentUsDepartDetails;
    mnlArrival: IStudentMnlArrivalDetails;
    error: undefined;
}

export const useStudentFlightDetailsStore = defineStore({
    id: 'studentFlightDetails',
    state: () : IStudentFlightDetailsState => ({
        isLoading: false,
        isSuccess: false,
        mnlDeparture: {} as IStudentMnlDepartDetails,
        usArrival: {} as IStudentUsArrivalDetails,
        usDeparture: {} as IStudentUsDepartDetails,
        mnlArrival: {} as IStudentMnlArrivalDetails,
        error: undefined
    }),
    getters: {

    },
    actions: {
    async loadStudentFlightDetails(): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await StudentAPI.getStudentFlightDetails()).data;
                this.mnlDeparture = response.data.mnl_depart;
                this.usArrival = response.data.us_arrival;
                this.usDeparture = response.data.us_depart;
                this.mnlArrival = response.data.mnl_arrival;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: response.data };
            } catch (error: any) {
                this.error = error.response?.data?.message ?? 'Failed to load flight details';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error.response?.data?.message ?? 'Failed to load flight details', errors: error.response?.data?.errors ?? {} };
            }

        }
    }
})