import { 
    required,
    helpers,
    numeric,
    email,
    
} from "@vuelidate/validators";

export default function HotelsRules() {
    const rules = {
        name: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        email: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
            email: helpers.withMessage(
                "Ingrese dirección de correo valida.",
                email 
            ),
        },
        slug: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        phone_number: {
            numeric: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ), 
            customValidation: helpers.withMessage(
                "Este campo debe contener exactamente 10 números.",
                (value) => /^[0-9]{10}$/.test(value) // Valida que haya exactamente 10 números
            ),
        }
    };

    return {
        rules,
    };
}
