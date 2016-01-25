@if(isset($orderProducts) && count($orderProducts))

    <table class="table_products_in_order">
        <thead>
            <tr>
                <td>#</td>
                <td>Название</td>
                <td>Кол-во, шт.</td>
                <td>Цена, грн</td>
                @if(OrderProduct::$showParam == true)
                    <td>Параметры</td>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($orderProducts as $product)
            <? $tovar = $product->getTovar(); ?>
              <tr>
                <td>{{$loop->index1}}</td>
                <td>
                <a href="{{$tovar->getUrl()}}" target="_blank">{{$tovar->getImg("50", "50")}}</a>
                <a href="{{$tovar->getUrl()}}" target="_blank">{{$tovar->title}}</a></td>
                <td>{{$product->count}}</td>
                <td>{{$product->price}}</td>
                @if(OrderProduct::$showParam == true)
                    <td>{{$product->params}}</td>
                @endif
             </tr>
            @endforeach
        </tbody>
    </table>

@endif