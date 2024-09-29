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
    </div>
</template>
<script>
import noUiSlider from 'nouislider';
import { mapState, mapActions } from 'pinia';
import { product_store } from '../Store/product_store';
export default {
    data: () => ({
        slider: null
    }),
    mounted: async function () {
        // setTimeout(this.init_range, 1000);
        // await this.get_min_max_price(this.slug);
        // console.log(this.min_price, this.max_price);
        this.init_range(this.min_price, this.max_price);
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
                start: [(min + 100), (max - 100)],
                tooltips: [true, true],
                range: {
                    'min': [min],
                    'max': [max]
                }
            });
            this.slider.noUiSlider.on('change.one', function ([min_price, max_price]) {
                // console.log(this.slider.noUiSlider.get());
                that.set_min_max_price_range(min_price, max_price);
            });
        }
    },

    watch: {
        min_price: function (v) {
            // console.log(this.min_price, this.max_price);
            this.slider.noUiSlider.updateOptions(
                {
                    start: [(this.price_range.min_price ), this.price_range.max_price],
                    tooltips: [true, true],
                    range: {
                        'min': [this.min_price],
                        'max': [this.max_price]
                    }
                }, // Object
                true // Boolean 'fireSetEvent'
            );
            // this.slider.noUiSlider.set([v, this.max_price]);
        },
        max_price: function (v) {
            // console.log(this.min_price, this.max_price);
            this.slider.noUiSlider.updateOptions(
                {
                    start: [(this.price_range.min_price ), (this.price_range.max_price)],
                    tooltips: [true, true],
                    range: {
                        'min': [this.min_price],
                        'max': [this.max_price]
                    }
                }, // Object
                true // Boolean 'fireSetEvent'
            );
            // this.slider.noUiSlider.set([this.min_price, v]);
        },
    },

    computed: {
        ...mapState(product_store, {
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
