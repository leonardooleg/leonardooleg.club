<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 15.11.2018
 * Time: 19:34
 */
?>
@extends('layouts.cart')
@section('title', 'Оформление заказа')
@section('meta_keyword', 'Оформление заказа')
@section('meta_description', 'Оформление заказа')
@section('content')


    <div class="body">


        <!-- Корзина -->
        <br>
        <h1 class="title--size-l title--light text-center content__title">Оформление заказа</h1>

        <!-- page__layout -->

        <div class=" section section--bg section--small-padding" itemtype="http://schema.org/Offer">
            <div class="container page__layout">


                <form id="app" class="form cart row" action="{{route('cart2.add')}}" method="POST">
                    <div class="col-md-9  basket_wrapp">
                        @csrf

                        <div class="order__block" id="delivery">
                            <h3 class="cart__title">Доставка:</h3>
                            <div class="form-group move_ddlocation">
                                <label for="exampleInputEmail1">Выберите город доставки:</label>
                                <input type="text" name="clientCity" class="form-control search-suggest" value="Городской город" id="exampleInputEmail1" aria-describedby="emailHelp" required>

                            </div>

                            <table class="sale_order_full_table wrap_delivery_select">
                            <tbody><tr>
                                <td valign="top" width="0%">
                                    <div style="    display: flex;">
                                        <input class="checkbox__input" type="radio" v-model="cartShipping.type" name="clientShipping" value="500" checked="" v-on:change="addCartShipping()">
                                        <i class="checkbox__icon"></i>
                                    </div>
                                </td>
                                <td valign="top" width="100%">
                                    <label class="dd_click" for="ID_DELIVERY_ID_40">
                                        <b>Почта России</b><br>
                                        от 2 до 7 дней <br>						    Стоимость                                                            500 руб.<br>
                                        Посылка Почтой России.<br>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="0%">
                                    <div style="    display: flex;">
                                        <input class="checkbox__input" type="radio" v-model="cartShipping.type" name="clientShipping" value="1000"   v-on:change="addCartShipping()">
                                        <i class="checkbox__icon"></i>
                                    </div>
                                </td>
                                <td valign="top" width="100%">
                                    <label class="dd_click" for="ID_DELIVERY_ID_51">
                                        <b>EMS Почта России</b><br>
                                        от 2 часов <br>						    Стоимость                                                            1,000 руб.<br>
                                        Сегодня, минимум через 2 часа, до вашей квартиры или офиса.<br>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="0%">
                                    <div style="    display: flex;">
                                        <input class="checkbox__input" type="radio" v-model="cartShipping.type" name="clientShipping" value="0"   v-on:change="addCartShipping()" >
                                        <i class="checkbox__icon" ></i>
                                    </div>
                                </td>
                                <td valign="top" width="100%">
                                    <label class="dd_click" for="ID_DELIVERY_ID_96">
                                        <b>Самовывоз</b><br>
                                        от 1 до 7 дней <br>						    Стоимость                                                            0 руб.<br>
                                        Мы поможем Вам выбрать наиболее подходящий тип доставки.<br>
                                    </label>
                                </td>
                            </tr>
                            </tbody></table>
                        </div>
                        <div class="order__block">
                            <h3 class="cart__title">Адрес и личные данные:</h3>

                            <div class="order__help">
                                <div class="form__required">Поля, обязательные для заполнения</div>
                            </div>
                            <div class="row" style="width: 100%">


                                <div class="form-group form__field col-xs-12 col-md-8">
                                    <label class="form__label form__label--required">Данные по доставке</label>
                                </div>

                                <div class="form-group form__field col-xs-12 col-md-6">
                                    <label for="Input1" class="form__label form__label--required">Телефон:</label>
                                    <input class="input field form-control" id="Input1"  required data-mask="mask"  type="tel" maxlength="250" size="" value="+106546545646" placeholder="Телефон" name="clientTel" required>
                                </div>


                                <div class="form-group form__field g col-xs-12 col-md-6">
                                    <label for="Input2" class="form__label form__label--required">E-mail:</label>
                                    <input class="input field form-control" id="Input2"  required type="email" maxlength="250" size="" value="leonardooleg2@gmail.com" placeholder="E-mail" name="clientEmail">
                                </div>


                                <div class="form-group form__field col-xs-12 col-md-6">
                                    <label for="Input3" class="form__label form__label--required">Имя:</label>
                                    <input class="input field form-control" id="Input3"  required type="text" maxlength="250" size="" value="Великий" placeholder="Имя" name="clientName">
                                </div>


                                <div class="form-group form__field col-xs-12 col-md-6">
                                    <label for="Input4" class="form__label ">Адрес:</label>
                                    <input class="input field form-control" id="Input4"  required type="text" maxlength="250" size="" value="улица Уличная" placeholder="Адрес" name="clientAddress">
                                </div>



                                <div class="form-group form__field col-xs-12 col-md-6">
                                    <label for="Input5" class="form__label ">Индекс:</label>
                                    <input class="input field form-control" id="Input5"   type="text" maxlength="250" size="" value="1234567" placeholder="Индекс" name="clientIndex">
                                </div>


                                <div class="form-group form__field col-xs-12 col-md-6">
                                    <label for="Input6" class="form__label">Комментарий:</label>
                                    <textarea class="textarea field form-control" id="Input6"   name="clientComment" placeholder="Введите комментарий ...">Комментарий к заказу не учитыва</textarea>
                                </div>
                                <input name="_check" type="hidden" value="{{ time() }}">
                            </div>
                        </div>

                        <div class="order__block">
                            <h3 class="">Способ оплаты:</h3>

                            <div class="form__label pay__desrc">
                                <p class="paragraph">Сразу после оплаты на указанную почту Вам будет прислан чек</p>
                            </div>
                            <div class="form__fields">
                                <div class="form__field order__pay">
                                        <label><input type="radio" name="type_pay" value="cash" checked="checked" class="type_pay"> <img src="/img/pay/nal_pay.png"></label>
                                        <label><input type="radio" name="type_pay" value="yookassa" class="type_pay"> <img src="/img/pay/bank_pay.png"></label>

                                </div>
                            </div>

                            <div style="margin: 50px 0px 0px;"> Оформляя заказ вы соглашаетесь c <a href="#!">пользовательским соглашением.</a></div>
                            <button style="margin: 20px 0px 0px;" class="button button--default button--pink order__button" type="submit"  >Подтвердить заказ</button>

                        </div>
                    </div>
                    <div  class="col-md-3 cart__side">
                        <div class="order__amount">
                            <h3 class="cart__title">Товары:</h3>
                            <div class="order__items" >

                                <div class="order__item row CartItem" data-autotest="CartItem" v-for="item in items">
                                    <div class="order__image col-md-5">
                                        <a v-bind:href="/product-cart/ + item.attributes.id">
                                            <img class="img loading" v-bind:src="item.attributes.img" alt="" data-was-processed="true">
                                        </a>
                                    </div>
                                    <div class="order__description col-md-7">
                                        <div class="title title--up order__name order-title"> @{{ item.name }}</div>
                                        <div class="title title--dim title--normal"></div>
                                        <div class="list order__features order-attr">
                                            <div class="list__item">Цвет:  <img :src="item.attributes.color_code" :title="item.attributes.color_name" style="width: 20px"> @{{ item.attributes.color_name }}
                                            <div class="list__item">Размер:  @{{  item.attributes.brand_name_size}} (  @{{  item.attributes.rus_name_size}}  )</div>
                                            <div class="list__item">Кол-во: @{{  item.quantity }}</div>
                                        </div>
                                        <div class="order__price">@{{  item.quantity * item.price}} руб.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            <div class="list order__info">
                                <div class="list__item">
                                    <div class="list__label">Товаров на</div>
                                    <div class="list__value"> @{{  details.sub_total.toFixed(2)  + ' руб.' }}</div>
                                </div>


                                <div class="list__item">
                                    <div class="list__label">Доставка:</div>
                                    <div class="list__value">@{{cartShipping.type}} руб.</div>
                                </div>
                                {{--<div class="list__item">
                                    <div class="list__label">Скидка</div>
                                    <div class="list__value">1,050 руб.</div>
                                </div>--}}
                            </div>
                            <div class="order__summ">Итого: <span> @{{ details.total.toFixed(2) + ' руб.' }}</span>
                                <input type="hidden" name="total_price" :value="details.total.toFixed(2)"><br>
                            </div>

                    </div>
                </form>


            </div>
        </div>




@endsection
