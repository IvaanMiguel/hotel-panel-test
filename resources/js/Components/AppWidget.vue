<template>
    <div :class="className + ' card card-animate bg-'+ color">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="fw-medium text-white mb-0">{{title}}</p>
                    <h2 class="mt-4 ff-secondary fw-semibold text-white">
                        {{value}}<span v-html="extraContent"></span>
                    </h2>
                    <p class="mb-0 text-white">{{subtitle ?? ''}}</p>
                </div>
                <div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-light rounded-circle fs-2">
                            <i :data-feather="icon" class="text-white"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        subtitle: String,
        icon: String,
        color: String,
        value: String, 
        className: String,
        extraContent: String,                  
    }
}
</script>

<style scoped>

</style>
