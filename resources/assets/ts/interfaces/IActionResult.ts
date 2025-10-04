export interface IActionResult<T = any> {
    success: boolean;
    data?: T;
    message?: string;
    // keyed by field name, each value is an array of error messages (matches typical Laravel validation shape)
    errors?: Record<string, string[]> | any;
}

export type IActionResultVoid = IActionResult<null>;
