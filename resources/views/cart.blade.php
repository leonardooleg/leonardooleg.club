<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 15.11.2018
 * Time: 19:34
 */
?>
@extends('layouts.cart')
@section('title', 'Корзина')
@section('meta_keyword', 'Корзина')
@section('meta_description', 'Корзина')
@section('content')


    <div class="body">
        <div class="container page__layout">
                <!-- breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                    <li class="breadcrumb-item"> Корзина</li>

                </ol>
            </nav>
        </div>
            <!-- breadcrumbs -->

                <!-- Корзина -->
            <br>
            <h1 class="title--size-l title--light text-center content__title">Моя корзина</h1>

            <!-- page__layout -->

            <div class=" section section--bg section--small-padding" itemtype="http://schema.org/Offer">
                <div class="container page__layout">
                    <div class="content__back">
                        <a class="btn btn-dark" href="/catalog" role="button" style="background-color: #000" target="_blank"><span class="button__text"><i class="fas fa-angle-left"></i> Продолжить покупки</span></a>
                    </div>


                    <form id="app" class="form cart row" action="{{route('cart2.go')}}" method="POST">
                        <div class="col-md-9 cart__content basket_wrapp">
                            @csrf
                            @if ($errors->has('token_error'))
                                {{ $errors->first('token_error') }}
                            @endif
                            <h5 class="cart__title">Товары:</h5>
                            <div class="CartItem cart__item" data-autotest="CartItem"  v-for="item in items">
                                <div class="cart__item row">
                                    <div class="cart__image col-md-3">
                                        <a v-bind:href="/product-cart/ + item.attributes.id" target="_blank">
                                            <img class="img" v-bind:src="item.attributes.img" >
                                        </a>
                                    </div>
                                    <div class="cart__description col-md-9">
                                        <div class="form__field row">
                                            <div class="col-md-10">
                                                <a v-bind:href="/product-cart/ + item.attributes.id" class="title cart__name" target="_blank" style="color: #000; text-decoration: none;">
                                                    @{{ item.name }}
                                                </a>
                                                <div class="cart__type">@{{ item.attributes.vendor_code }}</div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="cart__price">@{{  item.quantity * item.price}} руб.</div>
                                            </div>
                                        </div>
                                        <div class="form__field row">
                                            <div class="form__row cart__parameters b_details__fields" data-inline="992" idel="2055032" idres="81639">
                                                <div class="form__col b_details__field wrap_color_select">
                                                    <label class="form__label">Цвет:</label>
                                                    <div class="select field field--small sel_color dis-sel" name="color_81639" >
                                                        <img :src="item.attributes.color_code" :title="item.attributes.color_name" style="width: 20px"> @{{ item.attributes.color_name }}
                                                    </div>
                                                </div>
                                                <div class="form__col b_details__field wrap_size_select">
                                                    <label class="form__label">Размер:</label>
                                                    <div class="select field field--small sel_size  dis-sel" name="size_81639" >
                                                        @{{  item.attributes.brand_name_size}} (  @{{  item.attributes.rus_name_size}}  )
                                                    </div>
                                                </div>
                                                <div class="form__col">
                                                    <label class="form__label">Кол-во:</label>

                                                    <select v-model="item.quantity" class="select field field--small sel_quantity"   @change="updateItem(item.id, $event)" name="qty[]">
                                                        <option v-for="count in counts" v-bind:value="count.id" @change="updateItem(item.id, $event)"  name="qty[]" class="select field field--small sel_quantity">
                                                            @{{  count.id }}
                                                        </option>
                                                    </select>




                                                </div>
                                            </div>
                                        </div>
                                        <i class="icon icon--close cart__del"  v-on:click="removeItem(item.id)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 cart__side">
                            <div class="cart__amount">
                                <h5 class="cart__title">Итого:
                                    <div class="cart__summ allSum_FORMATED_static">
                                        @{{ details.total.toFixed(2) + ' руб.' }}
                                    </div>
                                </h5>
                                <div class="form__fields">



                                   {{-- <div class="form__field">
                                        <div class="form-group row">
                                            <label for="promocode" class="col-sm-4 col-form-label">Промокод</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="promocode" name="code" placeholder="Введите код" class="form-control" >
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="form__field">
                                     {{--   <div style="font-size: 16px;margin-bottom: 1rem;"><a href="/kak-poluchit-promokod/" target="_blank">Как получить промокод?</a></div>--}}
                                        <button type="submit" class="btn button--default  button--bright cart__button" target="_self">
                                            <span  style="line-height: 48px;color: #fff; text-decoration: none;">Оформить заказ</span>
                                        </button>
                                        <br>
                                        <a data-toggle="modal" data-target="#fastOrder" href="javascript:void(0)" class="btn button--default button--line cart__button" style="line-height: 40px; text-decoration: none;">Заказ без регистрации
                                            <div style="top: -25px;position:  relative;font-size:  8px;">(Мы вам перезвоним)</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="wr_ssl">
                                <div class="wr_ssl_item">
                                    <img src="/image/sslseal.png" class="loading" data-was-processed="true">
                                </div>
                                <div class="wr_ssl_item">
                                    <img src="/image/54ФЗ.png" class="loading" data-was-processed="true">
                                </div>
                                <div class="wr_ssl_item">
                                    <img src="/image/guar2.png" class="loading" data-was-processed="true">
                                </div>
                                <div class="wr_ssl_item pay">
                                    <img src="/image/yandexkassalogo.png" class="loading" data-was-processed="true">
                                </div>
                                <div class="wr_ssl_item pay">
                                    <img src="/image/paymasterlogo.png" class="loading" data-was-processed="true">
                                </div>
                            </div>
                        </div>
                    </form>



                </div>
                <div class="section section--bg section--small-padding">
                    <div class="container page__layout">
                        <div class="cart__delivery">
                            <a class="link link--inherit" href="/delivery/" target="">
                                <div class="cart__circle">
                                    <i class="icon icon--truck cart__icon"></i>
                                </div>
                            </a>
                            <a class="link link--inherit" href="/delivery/" target="">Подробнее о доставке</a>
                        </div>
                        <div class="desc-delivery">
                            <h1 class="title title--size-m title--light title--center">Доставка и оплата</h1>
                            <div class="title title--size-m title--dim title--light title--center content__sub-title">Условия доставки и оплаты в
                                интернет-магазине «Шелк и кружево»
                            </div>
                            <h1 class="title title--size-m title--light title--center pdt3">Мы доставляем заказы по всему миру!</h1>
                            <hr class="sep page__sep">
                            <div class="text text--center">
                            </div>
                            <div class="section section--bg content__gap" id="pay">
                                <div class="container page__layout">
                                    <div class="pay">
                                        <div class="title title--size-m title--light title--center">Как оплатить заказ?</div>
                                        <div class="title--center pdt2  pdb4">Все платежи на 100% безопасны и проходят через защищенный сервер</div>
                                        <div class="pay__items">
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_1.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Наличными при получении заказа
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_2.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Оплата картой на сайте <b>(Visa, MasterCard, МИР)</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_3.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Сбербанк Онлайн<br> или Альфа-клик
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_4.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Наличными в терминале</p>
                                                </div>
                                            </div>
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_5.png" alt="" srcset="/img/pay/item_5@2x.png 2x">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Электронными деньгами <b>(Яндекс Деньги или Webmoney)</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pay__item">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_6.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Счет на e-mail</p>
                                                </div>
                                            </div>
                                            <div class="pay__item pay__item--disabled">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_7.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">QR-код</p>
                                                </div>
                                            </div>
                                            <div class="pay__item pay__item--disabled">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_8.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Счёт в SMS</p>
                                                </div>
                                            </div>
                                            <div class="pay__item pay__item--disabled">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_9.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Оплата Viber</p>
                                                </div>
                                            </div>
                                            <div class="pay__item pay__item--disabled">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_10.svg" alt="">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">Telegram-бот</p>
                                                </div>
                                            </div>
                                            <div class="pay__item pay__item--disabled">
                                                <div class="pay__icon">
                                                    <img class="img" src="/img/pay/item_11.png" alt="" srcset="/img/pay/item_11@2x.png 2x">
                                                </div>
                                                <div class="text text--light pay__text">
                                                    <p class="paragraph">JivoSite</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="title--center pdt6">Мы поможем выбрать вам наиболее удобный для вас способ оплаты!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="container page__layout">
                                    <div class="title title--size-m title--light title--center">Мы сотрудничаем с проверенными партнерами:</div>
                                    <div class="content__partners text-center" >
                                        <img class="img" src="/img/content/partners.png" alt="" srcset="/img/content/partners@2x.png 2x">
                                        <!--<img class="img" src="/img/content/logo_cdek.png" alt="">-->
                                    </div>
                                    <div class="content__gap">
                                        <div class="title title--size-m title--light title--center content__title">Как получить заказ? Сколько стоит
                                            доставка?
                                        </div>
                                        <div class="content__faq">
                                            <div class="spoiler accordion" id="accordion">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">1. Доставка до двери по Москве и Московской обл.</div>
                                                <div class="spoiler__content collapse" id="collapse1"  aria-labelledby="heading1" data-parent="#accordion">
                                                    <div class="title spoiler__title">Срок доставки:</div>
                                                    <div class="text">
                                                        <p class="paragraph">1-2 дня, не считая день заказа.</p>
                                                        <p class="paragraph">Доставка 5 дней в неделю с ПН по ПТ</p>
                                                        <p class="paragraph">При оформлении заказа до 12:00 текущего дня (кроме субботы и
                                                            воскресенья), доставим ваш заказ на следующий день.</p>
                                                        <p class="paragraph">При оформлении заказа в субботу и воскресенье ваш заказ будет
                                                            доставлен вам во вторник.</p>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Время доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">c 10:00 до 21:00</p>
                                                            <p class="paragraph">Временные интервалы доставки - 3 часа.</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Способ оплаты заказа:</div>
                                                        <div class="list">
                                                            <div class="list__item">• наличными при получении заказа</div>
                                                            <div class="list__item">• Сбербанк Онлайн, Visa/Mastercard/МИР</div>
                                                            <div class="list__item">• наличными в терминале</div>
                                                            <div class="list__item">• оплата счета на e-mail</div>
                                                            <div class="list__item">• WebMoney, Альфа-Клик, Яндекс Деньги</div>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Территория доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">г. Москва и Московская обл.</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Стоимость доставки:</div>
                                                        <div class="list">
                                                            <div class="list__item">• до 3499 руб. - 265 руб.</div>
                                                            <div class="list__item">• от 3500 руб. - бесплатно</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spoiler">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">2. День-в-день по Москве</div>
                                                <div class="spoiler__content collapse" id="collapse2"  aria-labelledby="heading2" data-parent="#accordion">

                                                    <div class="title spoiler__title">Срок доставки:</div>
                                                    <div class="text">
                                                        <p class="paragraph">Через 1,5 - 2 часа в день заказа.</p>
                                                    </div>

                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Время доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">"Круглусуточно</p>
                                                            <p class="paragraph">Временные интервалы доставки - 30 мин."</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Способ оплаты заказа:</div>
                                                        <div class="list">
                                                            <div class="list__item">• наличными при получении заказа</div>
                                                            <div class="list__item">• Сбербанк Онлайн, Visa/Mastercard/МИР</div>
                                                            <div class="list__item">• наличными в терминале</div>
                                                            <div class="list__item">• оплата счета на e-mail</div>
                                                            <div class="list__item">• WebMoney, Альфа-Клик, Яндекс Деньги</div>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Территория доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">г. Москва и Московская обл.</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Стоимость доставки:</div>
                                                        <div class="list">
                                                            <div class="list__item">• до 6999 руб. - 500 руб.</div>
                                                            <div class="list__item">• от 7000 руб. - бесплатно</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spoiler">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">3. Самовывоз в Москве и Московской обл.</div>
                                                <div class="spoiler__content collapse" id="collapse3"  aria-labelledby="heading3" data-parent="#accordion">
                                                    <div class="title spoiler__title">Срок доставки:</div>
                                                    <div class="text">
                                                        <p class="paragraph">1-2 дня, не считая день заказа.</p>
                                                        <p class="paragraph">Забрать заказ можно с ПН по СБ</p>
                                                        <p class="paragraph">При оформлении заказа до 12:00 текущего дня (кроме субботы и
                                                            воскресенья), доставим ваш заказ на следующий день.</p>
                                                        <p class="paragraph">При оформлении заказа в субботу или воскресенье, ваш заказ будет
                                                            доставлен вам во вторник.</p>
                                                    </div>

                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Время доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">(не нужно указывать время доставки)</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Способ оплаты заказа:</div>
                                                        <div class="list">
                                                            <div class="list__item">• наличными при получении заказа (после 50% предоплаты)</div>
                                                            <div class="list__item">• Сбербанк Онлайн, Visa/Mastercard/МИР</div>
                                                            <div class="list__item">• наличными в терминале</div>
                                                            <div class="list__item">• оплата счета на e-mail</div>
                                                            <div class="list__item">• WebMoney, Альфа-Клик, Яндекс Деньги</div>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Территория доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">Россия</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Стоимость доставки:</div>
                                                        <div class="list">
                                                            <div class="list__item">• до 3499 руб. - 125 руб.</div>
                                                            <div class="list__item">• от 3500 руб. - бесплатно</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spoiler">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">4. Доставка и самовывоз по России</div>
                                                <div class="spoiler__content collapse" id="collapse4"  aria-labelledby="heading4" data-parent="#accordion">
                                                    <div class="title spoiler__title">Срок доставки:</div>
                                                    <div class="text">
                                                        <p class="paragraph">• Уточните подробности по телефону горячей линии 8(800)100-8766</p>
                                                    </div>

                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Время доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">c 10:00 до 21:00</p>
                                                            <p class="paragraph">Временные интервалы доставки - 3 часа.</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Способ оплаты заказа:</div>
                                                        <div class="list">
                                                            <div class="list__item">• наличными при получении заказа</div>
                                                            <div class="list__item">• Сбербанк Онлайн, Visa/Mastercard/МИР</div>
                                                            <div class="list__item">• наличными в терминале</div>
                                                            <div class="list__item">• оплата счета на e-mail</div>
                                                            <div class="list__item">• WebMoney, Альфа-Клик, Яндекс Деньги</div>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Территория доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">Россия</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Стоимость доставки:</div>
                                                        <div class="list">
                                                            <div class="list__item">• до 3499 руб. - от 265 руб.</div>
                                                            <div class="list__item">• от 3500 руб. - бесплатно</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spoiler">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">5. Доставка почтой России</div>
                                                <div class="spoiler__content collapse" id="collapse5"  aria-labelledby="heading5" data-parent="#accordion">

                                                    <div class="title spoiler__title">Срок доставки:</div>
                                                    <div class="text">
                                                        <p class="paragraph">• Уточните подробности по телефону горячей линии 8(800)100-8766</p>
                                                    </div>

                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Время доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">(не нужно указывать время доставки)</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Способ оплаты заказа:</div>
                                                        <div class="list">
                                                            <div class="list__item">• наличными при получении заказа (после 50% предоплаты)</div>
                                                            <div class="list__item">• Сбербанк Онлайн, Visa/Mastercard/МИР</div>
                                                            <div class="list__item">• наличными в терминале</div>
                                                            <div class="list__item">• оплата счета на e-mail</div>
                                                            <div class="list__item">• WebMoney, Альфа-Клик, Яндекс Деньги</div>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Территория доставки:</div>
                                                        <div class="text">
                                                            <p class="paragraph">Россия</p>
                                                        </div>
                                                    </div>
                                                    <div class="spoiler__gap">
                                                        <div class="title spoiler__title">Стоимость доставки:</div>
                                                        <div class="list">
                                                            <div class="list__item">• до 4999 руб. - 295 руб.</div>
                                                            <div class="list__item">• от 5000 руб. - бесплатно</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spoiler">
                                                <div class="spoiler__top" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">6. Международная доставка</div>
                                                <div class="spoiler__content collapse" id="collapse6"  aria-labelledby="heading6" data-parent="#accordion">

                                                    • Уточните подробности по телефону горячей линии 8(800)100-8766

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="content__gap">
                                        <div class="title title--size-m title--light title--center content__title">Преимущества нашей доставки</div>
                                        <div class="advantages">
                                            <div class="advantages__items">
                                                <div class="advantages__item">
                                                    <div class="advantages__icon">
                                                        <img class="img" src="/img/advantages/world.svg" alt="">
                                                    </div>
                                                    <div class="title advantages__title">Широкая география</div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">мы доставляем заказы по всему миру</p>
                                                    </div>
                                                </div>
                                                <div class="advantages__item">
                                                    <div class="advantages__icon">
                                                        <img class="img" src="/img/advantages/shield.svg" alt="">
                                                    </div>
                                                    <div class="title advantages__title">Проверенные курьерские службы</div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">Мы постоянно совершенствуемся, стремясь предложить вам максимально
                                                            качественный и доступный сервис. Доставка наших заказов по РФ осуществляется курьерами
                                                            транспортной компании СДЭК. Курьеры одеты в фирменную одежду с логотипом СДЭК, при них
                                                            всегда есть кассовый аппарат, по которому вам выдадут чек на покупку.</p>
                                                    </div>
                                                </div>
                                                <div class="advantages__item">
                                                    <div class="advantages__icon">
                                                        <img class="img" src="/img/advantages/rub.svg" alt="">
                                                    </div>
                                                    <div class="title advantages__title">Единый тариф<br> по Москве и Московской обл.
                                                    </div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">в будние, выходные дни, вечернее время 265 руб.</p>
                                                    </div>
                                                </div>
                                                <div class="advantages__item">
                                                    <div class="advantages__value">3500 ₽</div>
                                                    <div class="title advantages__title">Бесплатная доставка по Москве</div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">при заказе от 3500 руб.</p>
                                                    </div>
                                                </div>
                                                <div class="advantages__item">
                                                    <div class="advantages__value">3500 ₽</div>
                                                    <div class="title advantages__title">Бесплатная доставка по России</div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">при заказе от 3500 руб.</p>
                                                    </div>
                                                </div>
                                                <div class="advantages__item">
                                                    <div class="advantages__value">5000 ₽</div>
                                                    <div class="title advantages__title">Бесплатная доставка Почтой России</div>
                                                    <div class="text text--light advantages__text">
                                                        <p class="paragraph">при заказе от 5000 руб.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="container page__layout">
                            </div>


                        </div>
                    </div>
                </div>




                <div> <!-- container page__layout --></div>
            </div>







        </div>
    </div>



    <script type='application/javascript'>
        $(document).ready(function(){
            $(".cart__delivery .link").click(function( event ) {
                event.preventDefault();
                $('.desc-delivery').slideToggle('slow');
            });
            $('a[href$=".html"]').attr("target", "_blank");
        });
    </script>
@endsection
