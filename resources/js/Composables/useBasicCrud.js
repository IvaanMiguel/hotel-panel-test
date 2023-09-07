import { ref } from "vue";
export default function useBasicCRUD({titleBase, form, method_create, cleanFormData, validator, 
    validate, modal_id, getRoute, destroyRoute, formatEdit}) {

    const title_modal = ref("");

    const cleanForm = () => {
        Object.assign(form, {...JSON.parse(JSON.stringify(cleanFormData))});
        validator.value.$reset();
    };

    const submitForm = async (e) => {
        validate().then((res) => { if(!res) return e.preventDefault()});
    };

    const create =  () => {
        cleanForm();
        title_modal.value = `Añadir ${titleBase}`;
        method_create.value = true;
        
        let myModalEl = document.getElementById(modal_id);
        let modal = bootstrap.Modal.getInstance(myModalEl) ?? new bootstrap.Modal(myModalEl);
        modal.show();
    };

    const edit = async ({id}) => {
        
        cleanForm();
        title_modal.value = `Editar ${titleBase}`;
        method_create.value = false;

        axios.get(route(`${getRoute}.get.by.id`, id)).then(res => {
            Object.assign(form, res.data.data);
            
            if(formatEdit)formatEdit();

            let myModalEl = document.getElementById(modal_id);
            let modal = bootstrap.Modal.getInstance(myModalEl) ?? new bootstrap.Modal(myModalEl);
            modal.show();
        }).catch(error => {
            Swal.fire("Error!", "No encontramos lo que buscaba!.", "error").then(
                () => {
                    let myModalEl = document.getElementById(modal_id);
                    let modal = bootstrap.Modal.getInstance(myModalEl) ?? new bootstrap.Modal(myModalEl);
                    modal.hide();
                }
            );
            console.log(error);
        })
    };


    const destroy = async ({ id, index, array, routeName }) => {
        Swal.fire({
            title: "¿Estas seguro?",
            text: "Una vez eliminado, no podras revertir esto.",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: `Aceptar`,
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .delete(route(`${destroyRoute}.delete`, id))
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
                                : ( routeName != undefined ?
                                    window.location = routeName
                                    : window.location.reload()
                                );
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            "Error",
                            "No encontramos lo que buscaba!",
                            "error"
                        );
                        console.log(error);
                    });
            }
        });
    };

    const methods = {
        create: create,
        edit: edit,
        destroy: destroy,
        cleanForm: cleanForm,
        submitForm: submitForm,
    }

    return {
        title_modal,
        methods,
    };
}
