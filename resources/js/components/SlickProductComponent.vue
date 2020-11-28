<template>
    <div class="product_photo">
        <slick id="slick1"
            ref="gallery"
            :options="topSliderOptions"
            @beforeChange="syncSliders">
            <div v-for="(media, index) in product.split(';')" :key="index" class="b-slider__carousel b-slider__carousel--screen ">
                <div class="b-slider__item  ex1">
                    <zoom-on-hover :img-normal="media" :img-zoom="media" :scale="2"  @loaded="onload" @resized="onresize"></zoom-on-hover>

                </div>
            </div>
        </slick>
        <slick id="slick2"
            ref="featureList"
            :options="bottomSliderOptions"
            @beforeChange="syncSliders" >
            <div v-for="(media, index) in product.split(';')" :key="index" class="b-slider__carousel b-slider__carousel--thumbs ">

                <div class="b-slider__item  "><img :src="media" alt=""/></div>

            </div>


            </slick>

    </div>

</template>
<script>
import Slick from 'vue-slick';

export default {
    props: ['product'],
    components: { Slick, zoomOnHover: zoomOnHover },
    data() {
        return {
            topSliderOptions: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                adaptiveHeight: true,
                prevArrow: '<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>             <path fill-rule="evenodd" d="M8.354 11.354a.5.5 0 0 0 0-.708L5.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z"/>                <path fill-rule="evenodd" d="M11.5 8a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z"/>                </svg>',
                nextArrow: '<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">          <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>     <path fill-rule="evenodd" d="M7.646 11.354a.5.5 0 0 1 0-.708L10.293 8 7.646 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"/>             <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>            </svg>',
                asNavFor: "#slick2"
            },
            bottomSliderOptions: {
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                autoplay: true,
                speed: 2000,
                infinite: true,
                cssEase: "linear",
                focusOnSelect: true,
                asNavFor: "#slick1",
                adaptiveHeight: true,
                arrows: false,

            },
        }
    },
    methods: {
        syncSliders(currentPosition, nextPosition) {
            this.$refs.gallery.next();
            this.$refs.featureList.prev();
        },
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },

        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },
    }
}
</script>
