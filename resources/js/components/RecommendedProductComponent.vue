<template>
    <div class="col-md-12">
        <slick id="recommended"
            ref="recommended"
            :options="RecOptions">
            <div v-for="(prod, index) in product_rec" :key="index" >

                    <div class="strat">
                        <a :href="'/catalog/' + prod.path+ '/' + prod.slug +'.html'">
                            <div class="image" v-for="(media, index2) in prod.media.split(';').slice(0,1)" :key="index2">
                                <img class="img latest__img loading" :src="media" alt=""  data-was-processed="true">
                            </div>
                        </a>
                        <div class="text text-center">
                            <div class="card__description">
                                <div class="card__name">{{ prod.name.substr(0, 50) }}</div>
                                <div class="card__type">{{prod.title}}</div>
                                <div class="card__price"><b>{{prod.price}} руб.</b></div>
                                <div class="card__action">
                                    <a :href="'/catalog/' + prod.path + '/' + prod.slug + '.html'" class="btn btn-outline-dark"  tabindex="0"> Подробнее </a>
                                </div>
                            </div>

                        </div>
                    </div>



            </div>


        </slick>

    </div>
</template>
<script>

import Slick from 'vue-slick';
export default {
    props: ['product_rec'],
    components: { Slick },
    data() {
        return {
            RecOptions: {
                dots: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 20000,
                pauseOnFocus: false,
                pauseOnHover: false,
                pauseOnDotsHover: false,
                slidesToShow: 5,
                slidesToScroll: 5,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 700,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]

            },

        }
    },

}
</script>
