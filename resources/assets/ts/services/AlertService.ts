import swal from 'sweetalert2';

type ErrorsMap = Record<string, string[]>;

const AlertService = {
    async success(text = 'Operation completed.', title = 'Success') {
        await swal({
            title,
            text,
            type: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
    },

    async error(text = 'An error occurred.', title = 'Error') {
        await swal({
            title,
            text,
            type: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    },

    async validation(errors: ErrorsMap) {
        if (!errors || Object.keys(errors).length === 0) {
            await this.error('Please check your input and try again.', 'Validation Error');
            return;
        }

        const firstKey = Object.keys(errors)[0] as string;
        const message = errors[firstKey]?.[0] ?? 'Please check your input and try again.';
        await this.error(message, 'Validation Error');
    },

    async confirm(title = 'Are you sure?', text = '', confirmText = 'Yes', cancelText = 'Cancel') {
    const res: any = await swal({
            title,
            text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa'
        });
    // SweetAlert returns an object with `value` when confirmed. Normalize to boolean.
    return Boolean(res && (res.value === true || res.value));
    }
};

export default AlertService;
