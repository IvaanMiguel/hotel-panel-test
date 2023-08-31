import useVuelidate from "@vuelidate/core";

export default function useValidation(rules, form){

    const v$ = useVuelidate(rules, form, { $autoDirty: true });

    const validate = async () => {
        const isFormCorrect = await v$.value.$validate();
        return isFormCorrect;
    };

    return {
        validator: v$,
        validate,
    }
}