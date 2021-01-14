
<h1>My Order</h1>
<div class="table-responsive table-striped">
    <table class="table">
        <thead style="background: #007bff; color: white;">
            <th>Order Id</th>
            <th>Name</th>
            <th>Order Item</th>
        </thead>
        <tbody>
                    
            <tr>
                <td>
                    <?= $order->id ?>
                </td>
                <td>
                    <?= $customer->name ?>
                </td>
                <td>
                    <?php foreach ($order_item as $item) { ?>
                        <?= $item->item_id ?>, 
                    <?php } ?>
                </td>
            </tr>

        </tbody>
    </table>
</div>