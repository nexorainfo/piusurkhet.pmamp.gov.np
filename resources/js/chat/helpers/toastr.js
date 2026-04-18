import {useToast} from 'vue-toastification'
import "vue-toastification/dist/index.css";

const toaster = useToast()

class toastAlert {
    toastMessage(status, title) {
        const errors = [400, 401, 403, 404, 405, 408, 414, 415, 422, 500]
        if (status === 200 || status === 201) {
            toaster.success(title)
        } else if (errors.includes(status)) {
            toaster.error(title)
        }
    }
}


export default toastAlert = new toastAlert();
