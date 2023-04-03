import { AxiosResponse } from 'axios';
import { ApiRequest } from './ApiRequest';

import { ApplicationFormType } from '../types/ApplicationFormType';

export default {
    submit(appFormData: ApplicationFormType): Promise<AxiosResponse> {    
        return ApiRequest.post('/application-forms/submit', appFormData);
    }
}