import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";

import HotelsIndex from "./Pages/Hotels/Index.vue";
import UsersIndex from "./Pages/Users/Index.vue";
import ClientsIndex from "./Pages/Clients/Index.vue";
import ContactsIndex from "./Pages/Contacts/Index.vue";
import SettingsIndex  from "./Pages/Settings/index.vue";

// import RolesIndex from "./Pages/Roles/Index.vue";
import { provide, ref } from 'vue';

const app = createApp({
    components: {
        HotelsIndex,
        UsersIndex,
        ClientsIndex,
        ContactsIndex,
        SettingsIndex

        // RolesIndex
    },
    setup() {
        provide(
            "csrf",
            document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        );
        provide("trigger", 
            ref({
                id: '',
                method: '',
                params: {}
            })
        );
    },
});
app.mixin(
    {
        methods:{
            route,
            can(permissionName) {
                return Permissions?.indexOf(permissionName) !== -1;
            },
            getAvatar(name){
                return `https://ui-avatars.com/api/?name=${name}`;
            },
            getImagePath(path){
                return path ? `assets/images/${path}` : "#";
            },
            getStoragePath(path){
                return path ? `assets/storage/${path}` : "#";
            },
            previewImageInput(img_id, input_id) {
                var img = document.querySelector(`#${img_id}`),
                input = document.querySelector(`#${input_id}`)?.files[0],
                o = new FileReader();
                o.addEventListener(
                "load",
                function () {
                    img.src = o.result;
                },
                !1
                ),
                input && o.readAsDataURL(input);
            }
        }
    }
);

app.mount("#app");