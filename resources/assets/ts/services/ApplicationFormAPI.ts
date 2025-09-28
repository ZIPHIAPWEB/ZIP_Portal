import { AxiosResponse } from 'axios';
import { ApiRequest } from './ApiRequest';

import { ApplicationFormType } from '../types/ApplicationFormType';

export default {
    validate<T>(formData:T, step: number): Promise<AxiosResponse> {
        return ApiRequest.post(`/application-forms/validate?step=${step}`, formData);
    },
    submit(appFormData: ApplicationFormType): Promise<AxiosResponse> {    
        return ApiRequest.post('/application-forms/submit', appFormData);
    }
}