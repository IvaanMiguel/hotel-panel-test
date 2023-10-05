import { 
    required,
    helpers,
    numeric,
} from "@vuelidate/validators";

export default function CouponsRules() {
    const rules = {
        name: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            )
        },
        description: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            )
        },
        image: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            )
        },
        code: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            )
        },
        coupon_data: [{
            start_date: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            },
            end_date: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            },
            amount: {
                numeric: helpers.withMessage(
                    "Este campo debe ser numérico.",
                    required
                )
            },
            is_percentage: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            },
            exchange: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            },
            min_amount: {
                numeric: helpers.withMessage(
                    "Este campo debe ser numérico.",
                    required
                )
            },
            min_nights: {
                numeric: helpers.withMessage(
                    "Este campo debe ser numérico.",
                    required
                    )
                },
            status: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            }
        }],
        limit_uses: {
            numeric: helpers.withMessage(
                "Este campo debe ser numérico.",
                required
            )
        },
        hotel_id: {
            required: helpers.withMessage(
                "Este campo es obligatorio.",
                required
            ),
        },
        types: [{
            id: {
                required: helpers.withMessage(
                    "Este campo es obligatorio.",
                    required
                )
            }
        }]
    }

    return { rules }
}
