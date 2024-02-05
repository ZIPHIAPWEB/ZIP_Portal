import { defineStore } from "pinia";
import { IStudentMnlArrivalDetails, IStudentMnlDepartDetails, IStudentUsArrivalDetails, IStudentUsDepartDetails } from "./studentFlightDetails";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import CoordinatorApi from "../services/CoordinatorApi";

export interface ICoordStudentFlightInfoState {
    isSuccess: boolean;
    isLoading: boolean;
    mnlDeparture: IStudentMnlDepartDetails;
    usArrival: IStudentUsArrivalDetails;
    usDeparture: IStudentUsDepartDetails;
    mnlArrival: IStudentMnlArrivalDetails;
    error: any;
}

export const useCoordStudentFlightInfo = defineStore({
    id: 'coordStudentFlightInfo',
    state: () : ICoordStudentFlightInfoState => ({
        isSuccess: false,
        isLoading: false,
        mnlDeparture: {} as IStudentMnlDepartDetails,
        usArrival: {} as IStudentUsArrivalDetails,
        usDeparture: {} as IStudentUsDepartDetails,
        mnlArrival: {} as IStudentMnlArrivalDetails,
        error: undefined
    }),
    getters: {},
    actions: {
        async loadSelectedStudentFlightInfo() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentFlightDetails(coordSelectedStudent.userInfo.id)).data;
                this.mnlDeparture = response.data.mnl_depart;
                this.usArrival = response.data.us_arrival;
                this.usDeparture = response.data.us_depart;
                this.mnlArrival = response.data.mnl_arrival;
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async updateSelectedStudentFlightInfo(data : any) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.updateStudentFlightInfo(coordSelectedStudent.userInfo.id, data)).data;
                this.mnlDeparture = response.data.mnl_depart;
                this.usArrival = response.data.us_arrival;
                this.usDeparture = response.data.us_depart;
                this.mnlArrival = response.data.mnl_arrival;
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})