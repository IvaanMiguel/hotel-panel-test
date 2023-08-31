<template>
    <div :class="`card card-animate ${(light ? '' : 'bg-' + color)}`">
        <div class="card-body" v-if="type === 'bottom-right'">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <p :class="`text-uppercase fw-semibold text-${(light ? 'muted' : 'light')} mb-0`">
                        <span v-if="title" v-html="title" />
                        <slot v-else name="title" />
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <span v-if="subtitle" v-html="subtitle" />
                    <slot v-else name="subtitle" />
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 :class="`fs-22 fw-semibold ff-secondary mb-4 text-${(light ? '' : 'light')}`">
                        <span v-if="value" v-html="value" />
                        <slot v-else name="value" />
                    </h4>
                    <span v-if="footer" v-html="footer" />
                    <slot v-else name="footer" />
                </div>
                <div class="avatar-sm flex-shrink-0">
                    <span :class="`avatar-title bg-soft-${(light ? color : 'light')} rounded fs-3`">
                        <i v-if="icon" :class="`${icon} text-${light ? color : 'light'}`"></i>
                        <slot v-else name="icon" />
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body" v-if="type === 'top-right'">
            <div class="d-flex justify-content-between">
                <div>
                    <p :class="`fw-medium text-${(light ? 'muted' : 'light')} mb-0`">
                        <span v-if="title" v-html="title" />
                        <slot v-else name="title" />
                    </p>
                    <h2 :class="`mt-4 ff-secondary fw-semibold text-${(light ? '' : 'light')}`">
                        <span v-if="value" v-html="value" />
                        <slot v-else name="value" />
                    </h2>
                    <p :class="`mb-0 text-${(light ? 'muted' : 'light')}`">
                        <span v-if="subtitle" v-html="subtitle" />
                        <slot v-else name="subtitle" />
                    </p>
                </div>
                <div>
                    <div class="avatar-sm flex-shrink-0">
                        <span :class="`avatar-title bg-soft-${(light ? color : 'light')} rounded-circle fs-2 shadow`">
                            <i v-if="icon" :class="`${icon} text-${light ? color : 'light'}`"></i>
                            <slot v-else name="icon" />
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
        type: String,
        value: String,
        title: String,
        subtitle: String,
        footer: String,
        icon: String,
        color: String,
        light: {
            type: Boolean,
            default: true
        },
    },
    setup() {
        
    },
}
</script>