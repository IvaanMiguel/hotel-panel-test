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
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ), 
        },
        country_id: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ), 
        },
        password: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ), 
        },
        password_confirmation: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ), 
        },
    };

    return {
        rules,
    };
}
