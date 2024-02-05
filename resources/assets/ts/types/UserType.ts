export type UserType = {
    id?: number,
    username: string,
    full_name: string,
    email: string,
    is_verified: boolean,
    is_filled: boolean,
    profile_picture: string,
    date_registered: Date|string,
    application_status: string,
    program: string,
    role: string
}

export const UserInitial : UserType = {
    username: '',
    full_name: '',
    email: '',
    is_verified: false,
    is_filled: false,
    profile_picture: '',
    date_registered: '',
    application_status: '',
    program: '',
    role: ''
}