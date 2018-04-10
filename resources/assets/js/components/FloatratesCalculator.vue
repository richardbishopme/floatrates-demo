<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Floatrates Currency Calculator</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form @submit.prevent="calculate">
                                    <div class="form-group">
                                        <label for="from_currency">From currency</label>
                                        <select class="form-control" v-model="from_currency" @change="clear()" id="from_currency" name="from_currency">
                                            <option v-for="currency in currencies" :value="currency.code">
                                                {{ currency.name }}
                                            </option>
                                        </select>
                                        <span v-if="errors.from_currency" class="text-danger">{{ errors.from_currency[0] }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="from_amount">Amount</label>
                                        <input type="text" class="form-control" v-model="from_amount"  id="from_amount" name="from_amount">
                                        <span v-if="errors.from_amount" class="text-danger">{{ errors.from_amount[0] }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="from_currency">To currency</label>
                                        <select class="form-control" v-model="to_currency" id="to_currency" name="to_currency">
                                            <option v-for="currency in currencies" :value="currency.code">
                                                {{ currency.name }}
                                            </option>
                                        </select>
                                        <span v-if="errors.to_currency" class="text-danger">{{ errors.to_currency[0] }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Calculate</button>
                                </form>
                            </div>
                            <div class="col-sm">
                                <div v-if="to_amount" class="text-center">
                                    <h1>{{ to_amount }} <small>{{ to_currency }}</small></h1>
                                    <p><i><strong>Rate:</strong> {{ to_rate }}</i></p>
                                    <p><i><strong>Updated:</strong> {{ to_date }}</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Floatrates calculator mounted.')
        },
        created() {
            this.fetchCurrencies();
        },
        data() {
            return {
                currencies: [],
                from_currency: '',
                from_amount: 0,
                to_currency: '',
                to_amount: null,
                to_date: null,
                to_rate: null,
                errors: []
            };
        },
        methods: {
            fetchCurrencies() {
                axios.get('api/currencies').then(this.refresh);
            },

            calculate() {
                this.errors = [];
                axios.post('api/currencies', {
                    'from_currency': this.from_currency,
                    'from_amount': this.from_amount,
                    'to_currency': this.to_currency
                }).then(({ data }) => {
                    this.to_amount = data.to_amount;
                    this.to_date = data.to_date;
                    this.to_rate = data.to_rate;
                }).catch(error => {
                    this.errors = error.response.data.errors;
                })
            },
            refresh({ data }) {
                this.currencies = data.data;
            },

            clear() {
                this.to_currency = '';
                this.to_amount = null;
                this.to_date = null;
                this.to_rate = null;
                this.errors = [];
            }
        }
    }
</script>
