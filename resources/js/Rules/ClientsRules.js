import { 
    required,
    helpers,
    numeric,
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
        },
        phone_number: {
            numeric: helpers.withMessage(
                "Este campo debe ser numérico.",
                required
            ), 
        }
    };

    return {
        rules,
    };
}
