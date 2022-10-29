<x-client.head.meta
    title="Оформление подписки"
    description="Оформление подписки"
    :url="route('subscribe.create')"/>

<x-guest-layout>
    <main>
        <!--<x-client.common.page-title title="Оформление подписки"/>-->
        <section class="card-set sm:pt-28 sm:pb-16" x-data="paymentFormSend">
            <div class="content-wrapper max-w-instruction mb-36 pb-32 pt-20 md:pb-0 md:pt-0">
                <h2 class="text-gray-100 text-2xxl sm:text-4xl font-helvetica flex flex-col sm:flex-row items-center justify-center mb-5 sm:mb-8">
                    <span class="block mr-3 text-center order-2 sm:order-1">Получить план похудения за 1 рубль  </span>
                </h2>

                <form class="" id="paymentForm" autocomplete="off">
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full lg:w-1/2 px-4">
                            <div class="card-wrapper relative">
                                <div class="card-number-wrapper">
                                    <span class="card-number"></span>
                                </div>
                                <div class="name-wrap">
                                    <span class="card-person-name"></span>
                                </div>
                                <div class="period-wrap">
                                    <div class="period-num">
                                        <span class="card-period-month"></span>
                                        <span class="text-white font-helvetica font-bold text-lg px-1">/</span>
                                        <span class="card-period-year"></span>
                                    </div>

                                </div>

                                <picture class="block w-full mb-9" style="max-width:433px;">
                                    <source srcset="{{ asset('/images/ketoplan.png') }} 2x">
                                    <img src="{{ asset('/images/ketoplan.png') }}" alt="icon" class="w-full  object-containe">
                                </picture>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 px-4 form-wraper">
                            <div class="w-full mb-3 relative ">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-input" id="email" name="email" value="{{ old('email') ?? request()->get('email') }}" required>
                            </div>
                            <div class="w-full mb-3 relative ">
                                <label for="" class="form-label">Имя владельца карты</label>
                                <input type="text" data-cp="name" class="form-input" id="name" value="{{ request()->get('name') }}">
                            </div>
                            <div class="w-full mb-3 relative ">
                                <label for="" class="form-label">Номер карты</label>
                                <input data-cp="cardNumber" type="text" class="form-input">
                            </div>
                            <div class="flex items-center mb-3 w-full">
                                <div class="w-1/2 relative">
                                    <label for="" class="form-label">ММ/ГГ</label>
                                    <div class="inputs-wrapper flex items-center">
                                        <input type="text"  data-cp="expDateMonth" size="2" class="couple-form-input" maxlength="2">
                                        <span class="mx-1 text-gray-100">/</span>
                                        <input type="text" data-cp="expDateYear" size="2" class="couple-form-input" maxlength="2">
                                    </div>
                                </div>
                                <div class="w-1/2 relative pl-4">
                                    <label for="" class="form-label">CVV</label>
                                    <div class="inputs-wrapper flex items-center">
                                        <input type="text"  data-cp="cvv" class="couple-form-input" maxlength="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-10">
                        <div class="checkbox-wrap flex items-center">
                            <input type="checkbox" name="rules" id="rules" required class="hidden" >
                            <label for="rules" id="rules-text">
                                <span class="check-decor block mr-4"><img src="{{ asset('/images/check-icon.svg') }}" alt=""></span>
                                <span>
                                    Подвязав карту вы подтверждаете, что принимаете <a class="text-blue-600" target="_blank" href="{{ route('public-offer') }}">«публичную оферту»</a>, <a class="text-blue-600" target="_blank" href="{{ route('privacy') }}">«политику обработки данных»</a>,  и <a class="text-blue-600" target="_blank" href="{{ route('terms') }}">«условия использования и подписки»</a>.
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrap flex items-center mt-3">
                            <input type="checkbox" name="rules2" id="rules2" required class="hidden" >
                            <label for="rules2" id="rules-text2">
                                <span class="check-decor block mr-4"><img src="{{ asset('/images/check-icon.svg') }}" alt=""></span>
                                <span>
                                    Вы также ознакомлены с тем, что через {{ settings('free_days') }} дня тестового периода с Вас будет списана оплата в размере {{ settings('payment_sum_success') }} руб. и будет списываться каждые {{ settings('payment_counts_success_range') }} дней за использование нашего сервиса или 140 руб за день доступа в личный кабинет
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-12 w-full">
                        <button id="send-btn" @click="submit()" type="button" class="mx-auto flex justify-center items-center bg-pink-400 rounded-50 px-5 sm:px-24 py-3 ">
                            <span class="text-white font-helvetica font-bold text-sm sm:text-lg w-full text-center">Получить план похудения</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
    <script>
        window.onload = function () {
            const name = document.querySelector('[data-cp="name"]');
            const cardnumber = document.querySelector('[data-cp="cardNumber"]');
            const expirationMonth = document.querySelector('[data-cp="expDateMonth"]');
            const expirationYear = document.querySelector('[data-cp="expDateYear"]');

            function inputJump(x){
                let ml = ~~x.getAttribute('maxlength');
                if(ml && x.value.length >= ml){
                    do{
                        x = x.nextSibling;
                    }
                    while(x && !(/text/.test(x.type)));
                    if(x && /text/.test(x.type)){
                        x.focus();
                    }
                }
            }

            //Mask the Credit Card Number Input
            var cardnumber_mask = new IMask(cardnumber, {
                mask: [
                    {
                        mask: '0000 000000 00000',
                        regex: '^3[47]\\d{0,13}',
                        cardtype: 'american express'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^(?:6011|65\\d{0,2}|64[4-9]\\d?)\\d{0,12}',
                        cardtype: 'discover'
                    },
                    {
                        mask: '0000 000000 0000',
                        regex: '^3(?:0([0-5]|9)|[689]\\d?)\\d{0,11}',
                        cardtype: 'diners'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^(5[1-5]\\d{0,2}|22[2-9]\\d{0,1}|2[3-7]\\d{0,2})\\d{0,12}',
                        cardtype: 'mastercard'
                    },
                    {
                        mask: '0000 000000 00000',
                        regex: '^(?:2131|1800)\\d{0,11}',
                        cardtype: 'jcb15'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^(?:35\\d{0,2})\\d{0,12}',
                        cardtype: 'jcb'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^(?:5[0678]\\d{0,2}|6304|67\\d{0,2})\\d{0,12}',
                        cardtype: 'maestro'
                    },
                    // {
                    //     mask: '0000-0000-0000-0000',
                    //     regex: '^220[0-4]\\d{0,12}',
                    //     cardtype: 'mir'
                    // },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^4\\d{0,15}',
                        cardtype: 'visa'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        regex: '^62\\d{0,14}',
                        cardtype: 'unionpay'
                    },
                    {
                        mask: '0000 0000 0000 0000',
                        cardtype: 'Unknown'
                    }
                ],
                dispatch: function (appended, dynamicMasked) {
                    var number = (dynamicMasked.value + appended).replace(/\D/g, '');

                    for (var i = 0; i < dynamicMasked.compiledMasks.length; i++) {
                        let re = new RegExp(dynamicMasked.compiledMasks[i].regex);
                        if (number.match(re) != null) {
                            return dynamicMasked.compiledMasks[i];
                        }
                    }
                }
            });

            //On Input Change Events
            document.querySelector('.card-person-name').innerHTML = name.value;
            name.addEventListener('input', function () {
                if (name.value.length == 0) {
                    document.querySelector('.card-person-name').innerHTML = 'ANDREI MAR';
                } else {
                    document.querySelector('.card-person-name').innerHTML = this.value;
                }
            });

            document.querySelector('.card-number').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span>';
            cardnumber.addEventListener('input', function () {
                if (cardnumber.value.length == 0) {
                    document.querySelector('.card-number').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span> <span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span><span class="num-dots"></span>';
                } else {
                    document.querySelector('.card-number').innerHTML = cardnumber.value;
                }
            });
            document.querySelector('.card-period-month').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span>';
            expirationMonth.addEventListener('input', function () {
                if (expirationMonth.value.length == 0) {
                    document.querySelector('.card-period-month').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span>';
                } else {
                    document.querySelector('.card-period-month').innerHTML = expirationMonth.value;
                    inputJump(this)
                }
            });
            document.querySelector('.card-period-year').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span>';
            expirationYear.addEventListener('input', function () {
                if (expirationYear.value.length == 0) {
                    document.querySelector('.card-period-year').innerHTML = '<span class="num-dots"></span><span class="num-dots"></span>';
                } else {
                    document.querySelector('.card-period-year').innerHTML = expirationYear.value;
                    inputJump(this)
                }
            });


        }
    </script>

    @push('footer-scripts')
        <script src="{{ asset('//checkout.cloudpayments.ru/checkout.js') }}"></script>
        <script>
            const paymentFormSend = function () {
                return {
                    checkout: null,
                    cryptogram: null,
                    email: document.getElementById('email'),
                    name: document.getElementById('name'),
                    init() {
                        this.checkout = new cp.Checkout({
                            publicId: '{{ config('services.cloudpayments.public_key') }}',
                            container: document.getElementById('paymentForm'),
                        });
                    },

                    async submit() {
                        this.name.value = this.translit(this.name.value);

                        let reset = false;

                        if (this.email.value.length == 0 || ! this.email.value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
                            reset = true;
                        }

                        if (this.name.value.length == 0) {
                            reset = true;
                        }

                        if (! document.getElementById('rules').checked) {
                            document.getElementById('rules-text').style.color = 'red';
                            reset = true;
                        } else {
                            document.getElementById('rules-text').style.color = '#000';
                            reset = false;
                        }
                        if (! document.getElementById('rules2').checked) {
                            document.getElementById('rules-text2').style.color = 'red';
                            reset = true;
                        } else {
                            document.getElementById('rules-text2').style.color = '#000';
                            reset = false;
                        }

                        if(reset) {
                            return;
                        }

                        await this.setCookie('email', this.email.value);

                        await this.register();

                        await this.generateCryptogram();

                        await this.sendForm();
                    },

                    translit(str) {
                        var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")
                        var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")
                        var res = '';
                        for(var i=0, l=str.length; i<l; i++)
                        {
                            var s = str.charAt(i), n = ru.indexOf(s);
                            if(n >= 0) { res += en[n]; }
                            else { res += s; }
                        }
                        return res;
                    },

                    async register() {
                        await fetch('{{ route('register') }}', {
                            method: 'POST',
                            body: JSON.stringify({
                                email: this.email.value,
                                name: this.name.value,
                            }),
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            }
                        });
                    },

                    async generateCryptogram() {
                        await this.checkout.createPaymentCryptogram()
                            .then((cryptogram) => {
                                this.setCryptogram(cryptogram);
                            }).catch((errors) => {
                                this.viewErrors(errors);
                            });
                    },

                    setCryptogram(cryptogram) {
                        this.cryptogram = cryptogram;
                    },

                    async setCookie(name,value,days) {
                        var expires = "";
                        if (days) {
                            var date = new Date();
                            date.setTime(date.getTime() + (days*24*60*60*1000));
                            expires = "; expires=" + date.toUTCString();
                        }
                        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
                    },

                    async sendForm() {
                        await fetch('{{ route('subscription.create') }}', {
                            method: 'POST',
                            body: JSON.stringify({
                                token: this.cryptogram,
                                email: this.email.value,
                                clickid: this.getGet('clickid'),
                                iduser: this.getGet('iduser'),
                                payaction: this.getGet('payaction')
                            }),
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            }
                        }).then(response => {
                            return response.json();
                        }).then(data => {
                            if (data.Success === false && data.Model.AcsUrl !== null) {
                                this.redirectForm(data);
                            } else if (data.Success === true) {
                                window.location = '{{ route('dashboard') }}';
                            }
                        });
                    },

                    getGet(name) {
                        var s = window.location.search;
                        s = s.match(new RegExp(name + '=([^&=]+)'));
                        return s ? s[1] : false;
                    },

                    redirectForm(data) {
                        let form = document.createElement('form');

                        form.method = "POST";
                        form.action = data.Model.AcsUrl;

                        let element = document.createElement('input');
                        element.type = 'hidden';
                        element.value = data.Model.PaReq;
                        element.name = 'PaReq';

                        form.appendChild(element);

                        let elementTwo = document.createElement('input');
                        elementTwo.type = 'hidden';
                        elementTwo.value = data.Model.TransactionId;
                        elementTwo.name = 'MD';

                        form.appendChild(elementTwo);

                        let elementThere = document.createElement('input');
                        elementThere.type = 'hidden';
                        elementThere.value = '{{ route('subscription.post3ds') }}';
                        elementThere.name = 'TermUrl';

                        form.appendChild(elementThere);

                        document.body.appendChild(form);

                        form.submit();
                    },

                    viewErrors(errors) {
                        console.log(errors);
                        this.setButtonVisible(false);
                    },

                    setButtonVisible(is)
                    {
                        let button = document.getElementById('send-btn');

                        if (is) {
                            button.style.opacity = '0.5';
                            button.style.pointerEvents = 'none';
                        } else {
                            button.style.opacity = '1';
                            button.style.pointerEvents = 'event';
                        }
                    }
                };
            };
        </script>
    @endpush
</x-guest-layout>
