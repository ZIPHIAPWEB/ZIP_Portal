export type ContactType = {
    provincial_address: String,
    permanent_address: String,
    mobile_number: String|Number,
    home_number: String|Number
};

export const ContactInitial: ContactType = {
    provincial_address: '',
    permanent_address: '',
    mobile_number: '',
    home_number: ''
}