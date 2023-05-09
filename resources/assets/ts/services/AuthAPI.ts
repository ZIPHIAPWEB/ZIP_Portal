import { AxiosResponse } from "axios";
import { ApiRequest, ApiRequestWithoutAuth } from "./ApiRequest";

export default {
    login(username: string, password: string) : Promise<AxiosResponse> {
        return ApiRequestWithoutAuth.post('/login', { username, password });
    },
    register(username: string, email: string, password: string, password_confirmation: string) : Promise<AxiosResponse> {

        return ApiRequestWithoutAuth.post('/register', { username, email, password, password_confirmation });

    },
    resendEmailVerification() : Promise<AxiosResponse> {

        return ApiRequest.post('/verify/resend-email');

    },
    logout() : Promise<AxiosResponse> {
            
        return ApiRequest.get('/logout');
    
    }
}