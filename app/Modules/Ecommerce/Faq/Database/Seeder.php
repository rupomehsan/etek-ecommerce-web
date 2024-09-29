<?php

namespace App\Modules\Ecommerce\Faq\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\Ecommerce\Faq\Database\Seeder"
     */
    static $model = \App\Modules\Ecommerce\Faq\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $faqs = [
            ['question' => 'What payment methods do you accept?', 'answer' => 'We accept credit cards, debit cards, and PayPal.'],
            ['question' => 'How can I track my order?', 'answer' => 'Once your order is shipped, you will receive a tracking link via email.'],
            ['question' => 'Can I change or cancel my order?', 'answer' => 'You can change or cancel your order within 24 hours of placing it.'],
            ['question' => 'What is your return policy?', 'answer' => 'We offer a 30-day return policy on all items.'],
            ['question' => 'How long does shipping take?', 'answer' => 'Shipping typically takes 3-7 business days.'],
            ['question' => 'Do you offer international shipping?', 'answer' => 'Yes, we ship to many countries worldwide.'],
            ['question' => 'How do I reset my password?', 'answer' => 'Click on "Forgot Password" at the login screen and follow the instructions.'],
            ['question' => 'How do I contact customer service?', 'answer' => 'You can contact us via email or phone during business hours.'],
            ['question' => 'Are there any shipping fees?', 'answer' => 'Shipping fees depend on your location and the size of your order.'],
            ['question' => 'Can I get a refund for a sale item?', 'answer' => 'Sale items are eligible for refunds unless otherwise stated.'],
            ['question' => 'What if my order arrives damaged?', 'answer' => 'Contact customer service with your order number and photos of the damage.'],
            ['question' => 'How do I apply a discount code?', 'answer' => 'You can enter the discount code during the checkout process.'],
            ['question' => 'What do I do if I receive the wrong item?', 'answer' => 'Contact customer service and we will arrange for a replacement.'],
            ['question' => 'Do you offer gift cards?', 'answer' => 'Yes, we offer digital gift cards that can be used on our website.'],
            ['question' => 'Can I exchange an item?', 'answer' => 'Yes, exchanges are accepted within 30 days of purchase.'],
            ['question' => 'How do I unsubscribe from your newsletter?', 'answer' => 'Click "Unsubscribe" at the bottom of any of our emails.'],
            ['question' => 'What if I have a problem with my order?', 'answer' => 'Please contact customer service and we will resolve any issues.'],
            ['question' => 'How secure is my personal information?', 'answer' => 'We use the latest security measures to protect your information.'],
            ['question' => 'How do I update my shipping address?', 'answer' => 'You can update your shipping address in your account settings.'],
            ['question' => 'Can I pre-order an item?', 'answer' => 'Yes, pre-orders are available for select items.'],
        ];

        foreach ($faqs as $faq) {
            self::$model::create($faq);
        }
    }
}
