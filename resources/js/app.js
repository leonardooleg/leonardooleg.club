/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('products-component', require('./components/ProductsComponent.vue').default);
Vue.component('product-component', require('./components/SlickProductComponent.vue').default);
Vue.component('recommended-component', require('./components/RecommendedProductComponent.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));
Vue.component('v-slick', require('./components/SlickComponent.vue').default);
//Vue.component('fotorama', require('./components/Fotorama.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueResource);
const app = new Vue({
    el: '#app',
    props: {
        _token:{
            type: String,
            default: ''
        },
    },
    data: {
        details: {
            sub_total: 0,
            total: 0,
            total_quantity: 0,
            checked_attr: '0'
        },
        counts: [
            {id: 1,}, {id: 2,}, {id: 3,}, {id: 4,}, {id: 5,}, {id: 6,}, {id: 7,}, {id: 8,}, {id: 9,}, {id: 10,}
        ],
        itemCount: 0,
        items: [],
        item: {
            b: 1,
            id: 1 ,
            name: '' ,
            price: '' ,
            qty: 1,  //тільки для додавання далі quantity
            checked_attr: '',
            attributes: {
                size: '',
                color: '',
                brand_name_size: '',
                rus_name_size: '',
                img_color: '',
                name_color: '',
                vendor_code: '' ,
                img: ''
            }
        },
        cartShipping: {type: 0},
        cartCondition: {
            name: '',
            type: '',
            target: '',
            value: '',
            attributes: {
                description: 'Value Added Tax'
            }
        }
    },
    mounted: function () {
        this.loadItems();
    },
    methods: {
        addItem: function () {
            var _this = this;
            this.$http.post('/cart', {
                _token: _token,
                id: _this.item.id,
                name: _this.item.name,
                price: _this.item.price,
                qty: _this.item.qty,
                checked_attr: _this.item.checked_attr,
                size: _this.item.attributes.size,
                color: _this.item.attributes.color,
                vendor_code: _this.item.attributes.vendor_code,
                img: _this.item.attributes.img
            }).then(function (success) {
                console.log('add');
                _this.loadItems();
                app.loadItems(); //щоб шапка оновилась
            }, function (error) {
                console.log(error);

            });
            console.log('ok 2');
        },
        addCartShipping: function () {
            console.log('shipping');
            var _this = this;

            this.$http.post('/cart/shipping', {
                _token: _token,
                type: _this.cartShipping.type,
            }).then(function (success) {
                _this.loadItems();
            }, function (error) {
                console.log(error);
            });
        },
        addCartCondition: function () {
            console.log(3);
            var _this = this;
            this.$http.post('/cart/conditions', {
                _token: _token,
                name: _this.cartCondition.name,
                type: _this.cartCondition.type,
                target: _this.cartCondition.target,
                value: _this.cartCondition.value,
            }).then(function (success) {
                _this.loadItems();
            }, function (error) {
                console.log(error);
            });
        },
        clearCartCondition: function () {
            var _this = this;
            this.$http.delete('/cart/conditions?_token=' + _token).then(function (success) {
                _this.loadItems();
            }, function (error) {
                console.log(error);
            });
        },
        removeItem: function (id) {
            var _this = this;
            this.$http.delete('/cart/' + id, {
                params: {
                    _token: _token
                }
            }).then(function (success) {
                _this.loadItems();
            }, function (error) {
                console.log(error);
            });
        },


        loadItems: function () {
            var _this = this;
            this.$http.get('/cart', {
                params: {
                    limit: 10
                }
            }).then(function (success) {
                _this.items = success.body.data;
                _this.itemCount = success.body.data.length;
                _this.loadCartDetails();
                _this.attr();
                /* if(preg_match('!cart!', $_SERVER['REQUEST_URI'])) _this.loadCartShipping();*/
            }, function (error) {
                console.log(error);
            });
        },

        loadCartDetails: function () {

            var _this = this;

            this.$http.get('/cart/details').then(function (success) {
                _this.details = success.body.data;
            }, function (error) {
                console.log(error);
            });
        },
        loadCartShipping: function () {

            var _this = this;

            this.$http.get('/cart/shipping').then(function (success) {
                _this.cartShipping.type = success.body.data;
            }, function (error) {
                console.log(error);
            });
        },
        updateItem: function (cart_id, event) {
            var _this = this;
            this.$http.get('/cart/update/' + cart_id + '&' + event.target.value, {}).then(function (success) {
                _this.loadItems();
            }, function (error) {
                console.log(error);
            });
        },

        attr: function() {
            if (document.URL.indexOf(".html") >= 0) {
                var elem = document.querySelectorAll('[name="color"]'), i = elem.length;
                var color;
                var item_img = document.getElementById('item_img').value;
                var item_id = document.getElementById('item_id').value;
                var item_name = document.getElementById('item_name').value;
                var item_price = document.getElementById('item_price').value;
                var item_vendor_code = document.getElementById('item_vendor_code').value;
                Vue.set(app.item, 'id', item_id);
                Vue.set(app.item, 'name', item_name);
                Vue.set(app.item, 'price', item_price);
                Vue.set(app.item.attributes, 'vendor_code', item_vendor_code);
                Vue.set(app.item.attributes, 'img', item_img);
                while (i--) {
                    elem[i].onclick = function (i) {
                        return function () {
                            //  let someTextiles = attr_all.filter(item => item.attr_all_color == this.value);
                            color = this.value;
                            //console.log('col'+color);
                            document.getElementById('color' + color).setAttribute('checked', 'checked');
                            //console.log(color+"-color");                 //цвет
                            document.getElementById('attr-name').innerHTML = this.title;
                            var x = document.getElementsByName("size");
                            var a;
                            for (a = 0; a < x.length; a++) {
                                var tablesize = x[a].value;
                                //console.log(tablesize+"-size");         //розмер
                                var tempLsize = document.getElementById('lSize' + tablesize);
                                var tempsize = document.getElementById('size' + tablesize);
                                tempLsize.classList.add("disabled_size");
                                tempsize.disabled = true;
                                tempsize.checked = false;
                                var b;
                                for (b = 0; b < attr_all.length; b++) {
                                    if (attr_all[b].size_id == tablesize && attr_all[b].color_id == color) {
                                        tempLsize.classList.remove("disabled_size");
                                        tempsize.disabled = false;
                                    }
                                }
                            }
                        };

                    }(i);
                }
                var elemSize = document.querySelectorAll('[name="size"]'), c = elemSize.length;
                while (c--) {
                    elemSize[c].onclick = function (c) {
                        return function () {
                            var sizes = this.value;
                            var d;
                            for (d = 0; d < attr_all.length; d++) {
                                if (attr_all[d].size_id == sizes && attr_all[d].color_id == color) {
                                    document.getElementById('checked_attr').value = attr_all[d].id;
                                    Vue.set(app.item, 'checked_attr', attr_all[d].id); /////////
                                    //console.log(attr_all[d].id);
                                }
                            }
                        };
                    }(c);
                }


            }
        }
    },
    /* computed: {
         sum() {
             // Воспользуемся методом `reduce`.
             // https://developer.mozilla.org/ru/docs/Web/JavaScript/Reference/Global_Objects/Array/reduc
             //console.log(item);

             return 5
             //return this.qty.reduce((price, qty) => this.price * Number(qty))
         }
     }*/


});

