import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";

import AdminRoomsIndex from "./Pages/Admin/Rooms/Index.vue";

import { provide } from 'vue';

const app = createApp({
    components: {
        AdminRoomsIndex,     
    },
    setup() {
        provide(
            "csrf",
            document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        );
    },
});
app.mixin(
    {
        methods:{
            route,
            can(permissionName) {
                return Permissions.indexOf(permissionName) !== -1;
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
        }
    }
);

app.mount("#app");