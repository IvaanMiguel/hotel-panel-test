<template>
    <DropZone @drop.prevent="drop" @change="selectedFile" @click="openInputFile" 
    :acceptValue="acceptValue" :inputName="inputName" :multiple="multiple" role="button" :id="unique_id"/>
    <div class="border rounded" v-for="(file, index) of files" :key="index">
        <div class="d-flex align-items-center p-2">
            <div class="flex-shrink-0 me-3" v-if="acceptValue === 'image/*'">                                                                
                <div class="avatar-sm bg-light rounded">                                                                    
                    <img class="img-fluid rounded d-block" :src="fileUrls[index]" 
                    :alt="file.name">                                                                
                </div>                                                            
            </div>
            <div class="flex-grow-1">
                <div class="pt-1">
                    <h5 class="fs-14 mb-1">
                    {{ file.name }}
                    </h5>
                    <p class="fs-13 text-muted mb-0">
                    <strong>{{ file.size / 1024 }}</strong> KB
                    </p>
                    <strong class="error text-danger" data-dz-errormessage=""></strong>
                </div>
            </div>
            <div class="flex-shrink-0 ms-3">
                <button class="btn btn-sm btn-danger" @click.prevent="deleteRecord(index)">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</template>


<script>
import DropZone from "@/Components/DropZone.vue";
import { ref, watch } from "vue";
export default {
  props: {
    acceptValue: {
        type: String,
        default: 'image/*'
    },
    inputName: {
        type: String,
        default: 'images[]'
    },
    multiple: {
        type: Boolean,
        default: true
    },
    unique_id: {
        type: String,
        default: 'dropzoneInput'
    },
  },
  components: {
    DropZone,
  },
  setup(props) {
    let files = ref([]);
    let fileUrls = ref([]);
    let dropzoneFile = ref("");

    const drop = (e) => {
        
        const dt = new DataTransfer()
        const input = document.getElementById(props.unique_id)
        const { files: fileList } = input
        
        if(props.multiple || fileList.length < 1){     
            for (let i = 0; i < fileList.length; i++) {
                dt.items.add(fileList[i])
            }

            for (var i = 0; i < e.dataTransfer.files.length; i++) {
                dropzoneFile.value = e.dataTransfer.files[i];
                if(props.acceptValue === 'image/*') fileUrls.value.push(URL.createObjectURL(dropzoneFile.value));
                files.value.push(dropzoneFile.value);
                dt.items.add(dropzoneFile.value)
            }
            
            input.files = dt.files
        }

    };
    const selectedFile = () => {

        if(!props.multiple){
            files.value = [];
            fileUrls.value = [];
        }
        
        for (var i = 0; i < document.getElementById(props.unique_id).files.length; i++) {
            dropzoneFile.value = document.getElementById(props.unique_id).files[i];
            files.value.push(dropzoneFile.value);
            if(props.acceptValue === 'image/*') fileUrls.value.push(URL.createObjectURL(dropzoneFile.value));
        }
    };

    const openInputFile = () => {
        document.getElementById(props.unique_id).click();
    };

    watch(
        () => [...files.value],
        (currentValue) => {
        return currentValue;
        }
    );
    const deleteRecord = (index) => {
        files.value.splice(index, 1);
        if(props.acceptValue === 'image/*') fileUrls.value.splice(index, 1);

        const dt = new DataTransfer()
        const input = document.getElementById(props.unique_id)
        const { files: fileList } = input
        
        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i]
            if (index !== i)
            dt.items.add(file)
        }
        
        input.files = dt.files
    }

    return {
      dropzoneFile,
      drop,
      selectedFile,
      files,
      deleteRecord,
      openInputFile,
      fileUrls,
    }
  },
};
</script>
