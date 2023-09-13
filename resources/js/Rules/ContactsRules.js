import { 
    required,
    helpers,
    numeric,
} from "@vuelidate/validators";

export default function ContactsRules() {
    const rules = {
        status: {
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
