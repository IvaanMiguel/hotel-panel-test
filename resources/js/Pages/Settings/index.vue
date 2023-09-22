<template>
<SettingEdit class="d-flex col-12 flex-wrap"/>
</template>

<script>

import BasicInput from '@/Components/BasicInput.vue'
import SettingEdit from '@/Components/Settings/SettingEdit.vue';
export default {
    components: {
        SettingEdit,
        BasicInput
    },
    props:{
       
    },
    setup(props){
        const form = {
        google_recaptcha_public_key: '',
        strip_production_public_key: '',
        strip_test_public_key: '',
        dollar_value: '',
        euro_value: '',
        notification_email: '',
        google_recaptcha_private_key: '',
        strip_production_private_key: '',
        strip_test_private_key: ''
        };
        return{
            form
        };
    }
}
</script>