<div>
    <p>Receiver name: {{$customer_name}}</p>
    <p>Address: {{$customer_address}}</p>
    <p>Phone: {{$customer_phone}}</p>
    <p>Order method: {{$method}}</p>
    @if ($coupon != null)
    <p>Coupon: {{$coupon->title}}</p>
    @endif
    <p>Status: {{$status}}</p>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Amount (gram)</th>
                <th>Price (kilogram)</th>
                <th>Sale</th>
            </tr>
        </thead>
        <tbody>
            @for ($i =0; $i<count($cart);$i++)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$cart[$i]->Product->name}}</td>
                    <td>{{$cart[$i]->amount}}</td>
                    <td>{{$cart[$i]->Product->price}}</td>
                    <td>{{$cart[$i]->Product->sale}}%</td>
                </tr>
                @php
                    $total = 0;
                    if($cart[$i]->Product->sale> 0){
                        $total += $cart[$i]->Product->price*(1-$cart[$i]->Product->sale/100)*$cart[$i]->amount/1000;
                    }else{
                        $total +=$cart[$i]->Product->price*$cart[$i]->amount/1000;
                    }
                    $total += $shipment_fee;
                    if($coupon !=null){
                        $total = $coupon->discount>=10 ? $total*(1-$coupon->discount/100): $total - $coupon->discount;
                    }
                @endphp
            @endfor
        </tbody>
        <tfoot>
            <tr><td colspan="3">Total</td><td colspan="2">{{number_format($total,2,'.', ' ')}}</td></tr>
        </tfoot>
    </table>
</div>