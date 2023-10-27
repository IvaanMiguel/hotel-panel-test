import { 
    required,
    helpers,
    numeric,
} from "@vuelidate/validators";

export default function UsersRules() {
    const rules = {
        name: {
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

