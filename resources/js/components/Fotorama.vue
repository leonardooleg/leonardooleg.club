<template>
    <div class="b-slider b-slider--horizontal-tm-1 js-slider-horizontal-tm-1">
{{media}}
    </div>
</template>

<script>
    export default {
        props:   [
            'media'
        ],
        mounted() {
            this.update()
        },
        methods: {
            update: function(){
                    console.log(this.media);
            }
        },
    }
</script>
