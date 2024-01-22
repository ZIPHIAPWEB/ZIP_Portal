
export interface IPagination {
    links: IPaginationLink[]
}

interface IPaginationLink {
    active: boolean,
    label: string,
    url: string
}