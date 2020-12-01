<template>
    <div>
        <div class="row content__cards content__gap">
            <div class="col-sm-6 col-md-4 col-lg-3" v-for="item in list" :key="item.id">
                <div class="card card--hover" >
                    <div class="card-body">
                        <div class="" >
                            <a href="javascript:void(0)" class="wish_item" ></a>
                            <div v-if="item.sale==1" class="discounts">SALE</div>
                            <a class="link card__image" v-bind:href="'/catalog/'+item.path+'/'+item.slug+'.html'">
                                <div  v-for="(media, index) in item.media.split(';')" >
                                    <div v-if="index == 0">
                                        <img class="img lazy loaded"   :src="media" data-was-processed="true">
                                    </div>
                                </div>
                            </a>
                            <div class="card__description">
                                <a class="link detail_c_desc" v-bind:href="'/catalog/'+item.path+'/'+item.slug+'.html'">
                                    <div class="card__name">БРЕНД: {{item.name_brand}}</div>
                                    <div class="card__name">
                                        ЦВЕТА:
                                        <div  v-for="mediaColor in new Set(item.img_colors.split(','))" class="card_list">
                                                <img :src="mediaColor" height="10px">
                                        </div>

                                    </div>
                                    <div class="card__name">
                                        размеры в наличии:<br>
                                        <div  v-for="Size in new Set(item.rus_name_size.split(','))" class="card_list">
                                            <b style="padding-right: 5px">{{Size}}</b>
                                        </div>

                                    </div>
                                </a>
                                <div class="card__type">{{item.name}}</div>
                                <div class="card__price">
                                   <!-- <s>9999 руб.</s>--><i>{{item.price}} руб.</i>
                                </div>
                                <div class="card__action card__hover">
                                    <a v-bind:href="'/catalog/'+item.path+'/'+item.slug+'.html'" class="button button--default button--bright card__button" >
                                        <span class="button__text">Перейти</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <infinite-loading @distance="1" @infinite="infiniteHandler" spinner="circles">

            <div slot="no-more">Больше товаров не найдено</div>
            <div slot="no-results">Больше товаров не найдено.</div>
            <div slot="error" slot-scope="{ trigger }">
                Не найдено, нажмите <a href="javascript:;" @click="trigger">Повторить загрузку</a>
            </div>
        </infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';

export default {
    props:['link', 'path'],

    data() {
        return {
            list: [],
            page: 1,
            lastPage: 0,
        };
    },

    methods: {
        infiniteHandler($state) {
            let timeOut = 0;
            if (this.page > 1) {
                timeOut = 100;
            }
            setTimeout(() => {
                let vm = this;
                let get_link;
                if(vm.path)  get_link = '/products?'+vm.link+'&path='+vm.path+'&page='+this.page;
                else  get_link = '/products?'+vm.link+'&page='+this.page;
                //console.log(get_link);
                //console.debug(get_link);
                window.axios.get(get_link).then(({ data }) => {
                    vm.lastPage = data.last_page;
                    $.each(data.data, function(key, value){
                        vm.list.push(value);
                    });
                    if (vm.page - 1 === vm.lastPage) {
                        $state.complete();
                    }
                    else {
                        $state.loaded();
                    }
                });
                this.page = this.page + 1;
            }, timeOut);
        },
    },

    components: {
        InfiniteLoading,
    }

}
</script>
