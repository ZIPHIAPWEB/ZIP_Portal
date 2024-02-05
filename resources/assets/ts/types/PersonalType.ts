export type PersonalType = {
    first_name: String,
    middle_name: String,
    last_name: String,
    birthdate: Date|String,
    gender: String,
    skype_id: String,
    fb_email: String
};

export const PersonalInitial: PersonalType = {
    first_name: '',
    middle_name: '',
    last_name: '',
    birthdate: '',
    gender: '',
    skype_id: '',
    fb_email: ''
}
    