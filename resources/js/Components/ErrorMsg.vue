<template>
    <div class="input-errors mb-2" v-for="error of errors" :key="error.$uid">
        <div class="error-msg">{{ error.$message }}</div>
    </div>
</template>

<script>
export default {
    props: {
        errors: {
            type: Array,
            required: true
        },
    }
}
</script>

<style scoped>
.error-msg {
    color: #f57f6c;
    font-size: 0.75rem;
    display: block;
}
</style>
