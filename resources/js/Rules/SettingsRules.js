import {
    required,
    helpers,
    numeric,
} from "@vuelidate/validators";

export default function HotelsRules() {
    const rules = {
        google_recaptcha_public_key: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        google_recaptcha_private_key: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        production_stripe_public_key: {
            numeric: helpers.withMessage(
                "Este campo debe ser numérico.",
                required
            ),
        }, test_stripe_public_key: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        usd_value: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        eur_value: {
            numeric: helpers.withMessage(
                "Este campo debe ser numérico.",
                required
            ),
        }, email: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        production_stripe_private_key: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        test_stripe_private_key: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        production: {
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
