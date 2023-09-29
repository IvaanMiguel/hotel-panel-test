import { required, helpers } from '@vuelidate/validators'

export default function RolesAddRules(){
    const rules = {
        name: {
            required: helpers.withMessage('Este campo es obligatorio.', required),
            alpha: helpers.withMessage('Este campo permite unicamente letras.', helpers.regex(/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/)),
        },
    };

    return {
        rules
    }
}
