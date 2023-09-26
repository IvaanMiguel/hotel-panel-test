<template>
<SettingEdit class="d-flex col-12 flex-wrap"/>
         <template>
            <btn-option
            ></btn-option>
        </template>  
</template>

<script>

import BasicInput from '@/Components/BasicInput.vue'
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
import SettingEdit from '@/Components/Settings/SettingEdit.vue';

export default {
    components: {
    BasicTable,
    SettingEdit,
    BasicInput,
    BtnOption,

},
    props:{
        variables: Object,
    },
    setup(props){
        const form = {
        google_recaptcha_public_key: '',
        google_recaptcha_private_key: '',
        production_stripe_public_key: '',
        test_stripe_public_key: '',
        usd_value: '',
        eur_value: '',
        email: '',
        production_stripe_private_key: '',
        test_stripe_private_key: '',
        production: ''
        };
        return{
            form
        };
    }
}
</script>