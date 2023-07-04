import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentFlightDetails {
    mnl_departure_date: string;
    mnl_departure_time: string;
    mnl_departure_flight_no: string;
    mnl_departure_airline: string;

    us_arrival_date: string;
    us_arrival_time: string;
    us_arrival_flight_no: string;
    us_arrival_airline: string;

    us_departure_date: string;
    us_departure_time: string;
    us_departure_flight_no: string;
    us_departure_airline: string;

    mnl_arrival_date: string;
    mnl_arrival_time: string;
    mnl_arrival_flight_no: string;
    mnl_arrival_airline: string;
}

export interface IStudentFlightDetailsState {
    isSuccess: boolean;
    isLoading: boolean;
    flightDetails: IStudentFlightDetails | undefined;
    error: undefined;
}

export const useStudentFlightDetailsStore = defineStore({
    id: 'studentFlightDetails',
    state: () : IStudentFlightDetailsState => ({
        isLoading: false,
        isSuccess: false,
        flightDetails: {
            mnl_departure_date: '',
            mnl_departure_airline: '',
            mnl_departure_flight_no: '',
            mnl_departure_time: '',
            
            us_arrival_airline: '',
            us_arrival_date: '',
            us_arrival_flight_no: '',
            us_arrival_time: '',

            us_depature_airline: '',
            us_departure_flight_no: '',
            us_departure_date: '',
            us_departure_time: '',

            mnl_arrival_airline: '',
            mnl_arrival_flight_no: '',
            mnl_arrival_date: '',
            mnl_arrival_time: ''
        },
        error: undefined
    }),
    getters: {

    },
    actions: {
        async loadStudentFlightDetails() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentFlightDetails();
                this.flightDetails = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }

        }
    }
})