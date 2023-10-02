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
        description: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        max_people: {
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
