
export type ApplicationFormType = {
    step: number,
    firstName: string,
    middleName: string,
    lastName: string,
    birthDate: Date|string,
    gender: string,
    permanentAddress: string,
    provincialAddress: string,
    homeNumber: string,
    mobileNumber: string,
    skypeId: string,
    fbLink: string,

    programId: number|string,
    
    yearLevel: string,
    schoolId: number|string,
    degree: string,
    address: string,
    startDate: Date|string,
    dateGraduated: Date|string,

    secondarySchool: string;
    secondaryAddress: string;
    secondaryStartDate: string;
    secondaryEndDate: string;

    fatherFirstName: string;
    fatherMiddleName: string;
    fatherLastName: string;
    fatherOccupation: string;
    fatherCompany: string;
    fatherContactNo: string;
    
    motherFirstName: string;
    motherMiddleName: string;
    motherLastName: string;
    motherOccupation: string;
    motherCompany: string;
    motherContactNo: string;
};