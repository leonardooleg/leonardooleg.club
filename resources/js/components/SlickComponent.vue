<template>
    <slick
        ref="slick"
        :options="slickOptions">
        <div v-for="(blog, index) in blogs" :key="index" class="row as">
                <div class="strat ">
                    <div class="image">
                        <img class="img  latest__img loading" :src="'/storage/'+blog.img" alt=""  data-was-processed="true">
                    </div>
                    <div class="text text-center">
                        <div class="latest__cost latest__cost2">

                            <a :href="'/blog/'+blog.url+'.html'" style="text-decoration: none; color: #000;" tabindex="0">
                                {{blog.title}}
                            </a>
                            <div class="card__type" style="margin-top: 0" >{{ blog.text.replace(/(<([^>]+)>)/gi, "").substring(0,100) }} ...</div>
                        </div>
                        <a :href="'/blog/'+blog.url+'.html'" class="btn  btn__slider3"  role="button"><span class="btn__slider3_text">Подробнее</span></a>

                    </div>
                </div>

        </div>
    </slick>
</template>
<script>

import Slick from 'vue-slick';
export default {
    props: ['blogs'],
    components: { Slick },
    data() {
        return {
            // slickの設定
            slickOptions: {
                autoplay: false,
                dots: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                ]
            },
        };
    },
    methods: {
        next() {
            this.$refs.slick.next();
        },
        prev() {
            this.$refs.slick.prev();
        },
        reInit() {
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },
    },
}
</script>
