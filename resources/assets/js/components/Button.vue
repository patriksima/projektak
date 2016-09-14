<template>
    <a class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" href="{{ href }}"><i class="material-icons">{{ icon }}</i></a>
</template>

<script>
export default {
    props: {
        href: {
            type: String
        },
        icon: {
            type: String,
            required: true
        }
    },
    ready () {
        componentHandler.upgradeElement(this.$el)
    }
};
</script>
