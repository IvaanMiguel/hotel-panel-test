<template>
  <div
    @dragenter.prevent="toggleActive"
    @dragleave.prevent="toggleActive"
    @dragover.prevent
    @drop.prevent="toggleActive"
    :class="{ 'active-dropzone': active }"
    class="dropzone align-text-center"
  >
    <div class="mt-5 mb-1">
        <i class="display-4 text-muted ri-upload-cloud-2-fill"
        style="margin-left: 45%"></i>
    </div>

    <h5 style="text-align: center" v-if="multiple">Arrastre sus archivos o dé click para subirlos.</h5>
    <h5 style="text-align: center" v-else>Arrastre su archivo o dé click para subirlo.</h5>
    <input type="file" :id="id" class="dropzoneFile d-none" :accept="acceptValue"
    :name="inputName" :multiple="multiple"/>
  </div>
</template>


<script>
import { ref } from "vue";
export default {
  props: {
    acceptValue: String,
    inputName: String,
    multiple: Boolean,
    id: String,
  },
  setup() {
    const active = ref(false);
    const toggleActive = () => {
      active.value = !active.value;
    };
    return { active, toggleActive };
  },
};
</script>
