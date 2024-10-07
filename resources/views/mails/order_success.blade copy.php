<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>
    <div class="invoice-box" style="max-width: 700px; margin: auto;font-family: sans-serif;">
        <table cellpadding="0" cellspacing="0" style="width: 100%;">
            <thead>
                <tr class="top">
                    <td colspan="4">
                        <table style="width: 100%">
                            <tr>
                                <td class="title">
                                    <img src="https://etek.com.bd/frontend/images/etek_logo.png"
                                        style="width: 100%; max-width: 150px;">
                                </td>
                                <td style="text-align:right;">
                                    Invoice #:
                                    <span class="fw-bold">
                                        {{ $order->order_id }}
                                    </span><br>
                                    Date : {{ Carbon\Carbon::parse($order->date)->format('D M d Y') }}<br>
                                    Payment status : {{ $order->payment_status }}<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2" style="width: 50%;  padding-bottom: 10px;">
                        @php
                            try {
                                $delivery_address_details = json_decode($order->delivery_address_details);
                            } catch (\Throwable $th) {
                                $delivery_address_details = (object) [];
                            }
                        @endphp
                        <h4>
                            Delivery Address
                        </h4>
                        <br>
                        {{ $delivery_address_details->address ?? '' }}
                        <br>
                        {{ $delivery_address_details->station_name ?? '' }}.
                        {{ $delivery_address_details->district_name ?? '' }} ,
                        {{ $delivery_address_details->division_name ?? '' }},
                        <br><br>
                    </td>
                    <td colspan="2" style="text-align:right; padding-bottom: 10px;">
                        <h4>
                            Customer Information
                        </h4>
                        <br>
                        Name : {{ $order->user->name ?? '' }}.<br>
                        <span>
                            Email : {{ $order->user->email ?? '' }}<br>
                        </span>
                        Phone : {{ $order->user->phone_number ?? '' }}
                    </td>
                </tr>
                <tr style="background: rgb(223, 223, 223);">
                    <th style="text-align: left;padding: 10px;">Item</th>
                    <th style="text-align: center;padding: 10px;">Quantity</th>
                    <th style="text-align: center;padding: 10px;">Unit Price</th>
                    <th style="text-align: right;padding: 10px;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->order_products as $product)
                    <tr class="item">
                        <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.212);">
                            {{ $product->product_name }}
                        </td>
                        <td style="text-align: center;padding: 10px;border-bottom: 1px solid rgba(0, 0, 0, 0.212);">
                            {{ $product->qty }}
                        </td>
                        <td style="text-align: center;padding: 10px;border-bottom: 1px solid rgba(0, 0, 0, 0.212);">
                            {{ number_format($product->price) }}
                        </td>
                        <td style="text-align: right;padding: 10px;border-bottom: 1px solid rgba(0, 0, 0, 0.212);">
                            {{ number_format($product->subtotal) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3" style="text-align: right;padding: 5px 10px;"> Sub total </td>
                    <td style="text-align: right;padding: 5px 10px;">
                        {{ number_format($order->subtotal) }}
                    </td>
                </tr>
                <tr class="total">
                    <td colspan="3" style="text-align: right;padding: 5px 10px;">Delivery charge</td>
                    <td style="text-align: right;padding: 5px 10px;">
                        {{ number_format($order->delivery_charge) }}
                    </td>
                </tr>
                <tr class="total">
                    <td colspan="3" style="text-align: right;padding: 5px 10px;">Total:</td>
                    <td style="text-align: right;padding: 5px 10px;">
                        {{ number_format($order->total) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
