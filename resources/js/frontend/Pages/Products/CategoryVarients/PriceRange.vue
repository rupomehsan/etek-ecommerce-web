<template lang="">
    <div class="mb-3 bg-white card filter_card">
        <div class="card-header bg-white">
            <b>
                Price Range
            </b>
        </div>
        <div class="p-2 pt-5 pb-4">
            <div ref="range" id="range"></div>
        </div>
        <div class="category_filter_search">
            <input :value="min_price" @focusout="set_min_price($event)" ref="input_min" class="form-control" />
            <input :value="max_price" @focusout="set_max_price($event)" ref="input_max" class="form-control" />
            <button @click.prevent="set_min_max_price_range(input_min, input_max)" class="btn btn-outline-info">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</template>
<script>
import noUiSlider from 'nouislider';
import { mapState,mapWritableState, mapActions } from 'pinia';
import { product_store } from '../Store/product_store';
import debounce from "debounce";

export default {
    data: () => ({
        slider: null,
        input_min: 0,
        input_max: 0,
    }),
    mounted: async function () {
        this.init_range(this.min_price, this.max_price);
        this.input_min = this.min_price;
        this.input_max = this.max_price;
    },
    methods: {
        ...mapActions(product_store, {
            get_min_max_price: "get_min_max_price",
            set_min_max_price_range: "set_min_max_price_range",
        }),
        init_range: function (min, max) {
            this.slider = document.getElementById('range');
            let that = this
            noUiSlider.create(this.slider, {
                start: [(min), (max)],
                tooltips: [true, true],
                range: {
                    'min': [min],
                    'max': [max]
                }
            });
            this.slider.noUiSlider.on('change.one', debounce(function ([min_price, max_price]) {
                // console.log(this.slider.noUiSlider.get());
                min_price = parseInt(min_price);
                max_price = parseInt(max_price);

                that.input_min = min_price;
                that.input_max = max_price;
                that.$refs.input_min.value = min_price;
                that.$refs.input_max.value = max_price;
                that.set_min_max_price_range(min_price, max_price);
            }), 500);
        },
        makeValidInteger:function(input) {
            if (/^-?\d+$/.test(input.trim())) {
                return parseInt(input, 10);
            }
            return 0;
        },
        set_min_price: function(e){
            let value = e.target.value;
            value = this.makeValidInteger(value);

            if(value < this.min_price){
                value = this.min_price;
            }

            if(value >= this.max_price - 100){
                value = this.min_price;
            }

            if(value >= this.input_max - 100){
                value = this.min_price;
            }

            e.target.value = value;

            this.input_min = value;
        },
        set_max_price: function(e){
            let value = e.target.value;
            value = this.makeValidInteger(value);

            if(value > this.max_price ){
                value = this.max_price;
            }

            if(value <= this.min_price + 100){
                value = this.max_price;
            }

            if(value <= this.input_min + 100){
                value = this.max_price;
            }

            e.target.value = value;
            this.input_max = value;
        },
    },

    watch: {
        min_price: function (v) {
            this.slider.noUiSlider.updateOptions(
                {
                    start: [(this.price_range.min_price), this.price_range.max_price],
                    tooltips: [true, true],
                    range: {
                        'min': [+this.min_price],
                        'max': [+this.max_price]
                    }
                },
                true
            );
            // this.slider.noUiSlider.set([v, this.max_price]);
        },
        max_price: function (v) {
            this.slider.noUiSlider.updateOptions(
                {
                    start: [(this.price_range.min_price), (this.price_range.max_price)],
                    tooltips: [true, true],
                    range: {
                        'min': [+this.min_price],
                        'max': [+this.max_price]
                    }
                },
                true // Boolean 'fireSetEvent'
            );
            // this.slider.noUiSlider.set([this.min_price, v]);
        },
    },

    computed: {
        ...mapWritableState(product_store, {
            min_price: 'min_price',
            max_price: 'max_price',
            slug: 'slug',
            price_range: 'price_range',

        })
    }

}
</script>
<style lang="">

</style>
