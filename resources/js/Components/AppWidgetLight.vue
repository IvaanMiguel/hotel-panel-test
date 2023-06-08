<template>
    <div :class="className + ' card card-animate'">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="fw-medium mb-0">{{title}}</p>
                    <h2 :class="'mt-4 ff-secondary fw-semibold text-' + color">
                       {{value}}<span v-html="extraContent"></span>
                    </h2>
                    <p :class="'mb-0 text-' + color">{{subtitle ?? ''}}</p>
                </div>
                <div>
                    <div class="avatar-sm flex-shrink-0">
                        <span :class="'avatar-title rounded-circle fs-2 bg-soft-' + color">
                            <i :data-feather="icon" :class="'text-' + color"></i>
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
