import { reactive, ref } from "@vue/reactivity";
import useVuelidate from '@vuelidate/core'
import RolesAddRules from '@/Rules/RolesAddRules.js'

export default function useRoles() {

    const service = "roles";

    const title_modal = ref('');
    const method_create = ref(true);
    const form = reactive({
        id: "",
        name: "",
        permissions: [{}],
    });

    const create = () => {
        cleanForm();
        title_modal.value = "Añadir Rol";
        method_create.value = true;
    };

    const edit = async (id) => {

        cleanForm();
        title_modal.value = "Editar Rol";
        method_create.value = false;

        try {
            const response = await axios.get(route(`${service}.get`, id));
            const data = await response.data.data;
            Object.assign(form, data);
            form.permissions = form.permissions.map(p => p.name)
        } catch (error) {
            Swal.fire("Error!", "No encontramos lo que buscaba!.", "error").then(
                () => {
                    const myModalEl = document.getElementById("modalAdd");
                    const modal = bootstrap.Modal.getInstance(myModalEl);
                    modal.hide();
                }
            );
        }
    };


    const destroy = async ({ id, index, array }) => {
        Swal.fire({
            title: "¿Estas seguro?",
            text: "Una vez eliminado, no podras revertir esto.",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .delete(route(`${service}.destroy`, id))
                    .then(() => {
                        Swal.fire(
                            "Hecho",
                            "Registro eliminado correctamente",
                            "success"
                        ).then(() => {
                            index != undefined &&
                                index != null &&
                                Array.isArray(array)
                                ? array.splice(index, 1)
                                : (window.location = route(service));
                        });
                    })
                    .catch(() => {
                        Swal.fire(
                            "Error",
                            "No encontramos lo que buscaba!",
                            "error"
                        );
                    });
            }
        });
    };

    const cleanForm = () => {
        Object.assign(form, {
            id: "",
            name: "",
            permissions: [],
        });
        v$.value.$reset();
    };

    // validations
    const { rules } = RolesAddRules();

    const v$ = useVuelidate(rules, form, { $autoDirty: true });

    const submitForm = async (e) => {
        const isFormCorrect = await v$.value.$validate();
        if (!isFormCorrect) return e.preventDefault();
    };

    return {
        title_modal,
        method_create,
        form,
        create,
        edit,
        destroy,
        cleanForm,
        submitForm,
        v$,
    }
}
