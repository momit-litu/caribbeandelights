<?php
include 'views/layout/common_php.php';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    include 'views/layout/header_files.php';
    ?>
</head>

<body>
<?php
include 'views/layout/pre_load.php';
?>
<script>
    customer_id=<?php echo $customer_id;?>
</script>
<div class="wrapper">
    <!-- Start Header -->
    <?php
    include 'views/layout/header.php';
    ?>
    <!-- End Header -->
    <!-- Start Main -->
    <?php
    include 'views/layout/auth_modal.php';
    ?>

    <!-- Start Main -->
    <div class="main-part" id="content" style="min-height: 600px;" >
        <section class="home-icon shop-cart bg-skeen wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="icon-default icon-skeen">
                <img src="images/scroll-arrow.png" alt="">
            </div>
            <div class="container">
                <div class="checkout-wrap">
                    <ul class="checkout-bar">
                        <li class="done-proceed">Shopping Cart</li>
                        <li class="done-proceed">Checkout</li>
                        <li class="active">Order Complete</li>
                    </ul>
                </div>

                <div class="order-complete-box">
                    <img src="images/complete-sign.png" alt="">
                    <p >Thank you for ordering our food. You will receive a confirmation email shortly. your order referenced id #<b><?php echo $_SESSION['Last_invoice_no']; ?></b>
                        <br> Now check a Food Tracker progress with your order.</p>
                    <a href="#" class="btn-medium btn-primary-gold btn-large" id="tracker">Go To Food Tracker</a>
                    <br /><br />
                    <button type="button" class="btn btn-warning"  onclick="view_order()" id=""><i class="fa fa-lg fa-print"> &nbsp; Print order #</i></button>
                </div>

            </div>
        </section>
        <div class="modal fade booktable" id="order_modal" tabindex="-2" role="dialog" aria-labelledby="booktable">
            <div class="modal-dialog width_80_p" role="document" >
                <div class="modal-content">
                    <div class="modal-body" style="margin-bottom: 50px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div id="order-div" >
                            <div class="title text-center">
                                <h3 class="text-coffee left"> <a href="index.php"><img src="<?php echo ($logo); ?>" alt="" style="height: 100px; width: 100px"></a></h3>
                            </div>
                            <div class="done_registration ">
                                <div class="doc_content">
                                    <div class="col-md-12 left-margin-0" style=" padding: 0px; margin-bottom: 20px">
                                        <div class="col-md-6" style="margin: 0px; padding: 0px">
                                            <h4>Order Details:</h4>
                                            <div class="byline">
                                                <span class="after_order_initiate" id="inv_no"></span><br/>
                                                <span id="order_status"></span><br/>
                                                <span id="ord_date"></span><br/>
                                                <span id="dlv_date"></span> <br/>

                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right text-right-l left-margin-0  left-padding-0">
                                            <h4>Customer Details:</h4>
                                            <address id="customer_detail_vw">
                                            </address>
                                        </div>

                                    </div>

                                    <div id="ord_detail_vw">
                                        <table class="table table-bordered" id="ord_detail_vw_big" >
                                            <thead>
                                            <tr>
                                                <th align="center">Items</th>
                                                <th width="10%" align="center">Quantity</th>
                                                <th width="12%" style="text-align:right">Rate</th>
                                                <th width="12%"  style="text-align:right">Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered" id="ord_detail_vw_small" style="display: none" >
                                            <thead>
                                            <tr>
                                                <th align="center">Items</th>
                                                <th width="12%"  style="text-align:right">Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <p>Note: <span id="note_vw"></span></p>
                                        <p>Print Time : <?php echo date("Y-m-d h:m:s"); ?></p>
                                        <br />

                                        <p style="font-weight:bold; text-align:center" id="thankingNoted">Thank you. Hope we will see you soon </p>
                                    </div>

                                </div>


                            </div>
                        </div>


                        <div class="col-md-12 hidden-print" style="text-align: center" id="print_repeat_order"> </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- End Main -->
    <!-- Start Footer -->
    <?php
    include 'views/layout/footer.php';
    ?>
    <!-- End Footer -->

    <?php
    include 'views/layout/open_time_modal.php';
    ?>
</div>
<!-- Back To Top Arrow -->
<a href="#" class="top-arrow"></a>
</body>


<!-- Mirrored from laboom.sk-web-solutions.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Sep 2018 06:20:20 GMT -->
</html>


<?php
include 'views/layout/footer_files.php';

$item_number=0;

if(isset($_SESSION['Unpaid_invoice_no']) && $_SESSION['Unpaid_invoice_no']!=null){
    $item_number= trim(preg_replace('/\s+/', '', $_SESSION['Unpaid_invoice_no']));
}
?>

<script>


    //alert('sdf')
    order_id = "<?php echo $_SESSION['Last_invoice_no']; ?>";
    item_number = '<?php echo $item_number; ?>';

    if(item_number!=0){
        $.ajax({
            url: project_url +"includes/controller/ecommerceController.php",
            dataType: "json",
            type: "post",
            async: false,
            data: {
                q: "unpaid_order",
                order_id: item_number,
                checkout_confirm:1
            },
            success: function(data){
                //if(data==1) window.location.href = project_url+'categories.php';
            }
        })
    }
    showCart()


    var view_order = function view_order(){
        //alert('ok')
        $('#ord_detail_vw>table>tbody').html('');
        /*
        $.ajax({
            url:project_url +"includes/controller/ecommerceController.php",
            type:'POST',
            async:false,
            dataType: "json",
            data:{
                q: "get_order_details_by_invoice",
                order_id:order_id
            },
            success: function(data){
                //alert(data.item_id)
                console.log(data)
                if(!jQuery.isEmptyObject(data.records)){
                    $.each(data.records, function(i,data){
                        $('#ord_title_vw').html(data.invoice_no);
                        $('#ord_date').html("Ordered time: "+data.order_date);
                        $('#dlv_date').html("Delivery time: "+data.delivery_date);
                        $('#dlv_ps').html("Payment Status: "+data.paid_status);
                        $('#dlv_pm').html("Payment Method: "+data.payment_method);
                        $('#customer_detail_vw').html(" "+data.customer_name+"<br/><b>Mobile:</b> "+data.customer_contact_no+"<br/><b>Address:</b> "+data.customer_address);
                        $('#note_vw').html(data.remarks);

                        var order_tr = "";
                        var order_total = 0;
                        order_infos	 = data.order_info;
                        var order_arr = order_infos.split('..,');
                        $.each(order_arr, function(i,orderInfo){
                            //alert(orderInfo)
                            var order_info_arr = orderInfo.split('#');
                            var total = ((parseFloat(order_info_arr[4])*parseFloat(order_info_arr[5])));
                            order_tr += '<tr><td class="text-capitalize">'+order_info_arr[2]+' <br>'+order_info_arr[6].split('..')[0]+'</td><td align="center">'+order_info_arr[5]+'</td><td align="right">'+currency_symbol+''+order_info_arr[4]+'</td><td align="right">'+currency_symbol+''+total+'</td></tr>';
                            order_total += total;
                        });
                        var total_order_bill = ((parseFloat(order_total)+parseFloat(data.delivery_charge))-parseFloat(data.discount_amount));
                        var total_paid = data.total_paid_amount;
                        order_tr += '<tr><td colspan="3" align="right" ><b>Discount</b></td><td align="right"><b>'+currency_symbol+''+parseFloat(data.discount_amount).toFixed(2)+'</b></td></tr>';
                        order_tr += '<tr><td colspan="3" align="right" ><b>Tax</b></td><td align="right"><b>'+currency_symbol+''+parseFloat(data.tax_amount).toFixed(2)+'</b></td></tr>';
                        order_tr += '<tr><td colspan="3" align="right" ><b>Tips</b></td><td align="right"><b>'+currency_symbol+''+parseFloat(data.tips).toFixed(2)+'</b></td></tr>';
                        order_tr += '<tr><td colspan="3" align="right" ><b>Total Amount</b></td><td align="right"><b>'+currency_symbol+''+parseFloat(total_paid).toFixed(2)+'</b></td></tr>';
                        $('#ord_detail_vw>table>tbody').append(order_tr);



                        //for small device

                    });
                    $('#modal_logo').attr('src',$('.logo>a>img').attr('src'));
                    $('#order_modal').modal();
                }

            }
        });
        */
        if(!order_id.includes("CBG")){
            $.ajax({
                url:project_url +"includes/controller/ecommerceController.php",
                type:'GET',
                async:false,
                dataType: "json",
                data:{
                    q: "get_order_details_by_invoice",
                    order_id:order_id
                },
                success: function(data){
                    repeat =  "<button class='btn btn-primary'><i class='fa fa-repeat pointer' onclick='repeat_order(`"+order_id+"`)'></i></button>"
                    //alert(data.item_id)
                    $('#print_repeat_order').append(repeat)
                    console.log(data)
                    if(!jQuery.isEmptyObject(data.records)){
                        $.each(data.records, function(i,data){
                            //$('#ord_title_vw').html(data.invoice_no);
                            $('#inv_no').html("Invoice Number: "+data.invoice_no);
                            $('#order_status').html("Order Status: "+data.order_status_text);
                            $('#ord_date').html("Ordered time: "+data.order_date);
                            //$('#dlv_date').html("Delivery time: "+data.delivery_date);
                            $('#customer_detail_vw').html(" "+data.customer_name+"<br/><b>Mobile:</b> "+data.customer_contact_no+"<br/><b>Address:</b> "+data.customer_address);
                            $('#note_vw').html(data.remarks);
							if(data.ASAP==1){
                                $('#dlv_date').html("<span style='background-color:Lime'>Pickup:<b> (ASAP)</b><span>");
                            }
                            else {
                                $('#dlv_date').html("<span style='background-color:orange'>Scheduled Pickup Time: "+data.delivery_date+"</span>");
                            }

                            var order_tr = "";
                            var order_total = 0;
                            order_infos	 = data.order_info;
                            var order_arr = order_infos.split('..,');
                            $.each(order_arr, function(i,orderInfo){
                                //alert(orderInfo)
                                var order_info_arr = orderInfo.split('#');
                                var total = ((parseFloat(order_info_arr[4])*parseFloat(order_info_arr[5])));
                                order_tr += '<tr><td class="text-capitalize">'+order_info_arr[2]+' <br>'+order_info_arr[6]+'<br><i style="color: black">'+order_info_arr[7].split('..')[0]+'</i></td><td align="center">'+order_info_arr[5]+'</td><td align="right">'+currency_symbol+''+order_info_arr[4]+'</td><td align="right">'+currency_symbol+''+total+'</td></tr>';
                                order_total += total;
                            });
                            var total_order_bill = ((parseFloat(order_total)+parseFloat(data.delivery_charge))-parseFloat(data.discount_amount));
                            var total_paid = data.total_paid_amount;
                            order_tr += '<tr><td colspan="3" align="right" ><b>Discount</b></td><td align="right"><b>'+currency_symbol+''+data.discount_amount+'</b></td></tr>';
                            order_tr += '<tr><td colspan="3" align="right" ><b>Tax</b></td><td align="right"><b>'+currency_symbol+''+data.tax_amount+'</b></td></tr>';
                            order_tr += '<tr><td colspan="3" align="right" ><b>Tips</b></td><td align="right"><b>'+currency_symbol+''+data.tips+'</b></td></tr>';
                            order_tr += '<tr><td colspan="3" align="right" ><b>Total Amount</b></td><td align="right"><b>'+currency_symbol+''+total_paid+'</b></td></tr>';
                            $('#ord_detail_vw>table>tbody').append(order_tr);



                            //for small device

                        });
                    }
                }
            });

        }
        else {
            $.ajax({
                url:project_url +"includes/controller/groupController.php",
                type:'GET',
                async:false,
                dataType: "json",
                data:{
                    q: "get_group_order_details_by_invoice",
                    order_id:order_id
                },
                success: function(data){
                    //alert(data)
                    //console.log(data)
                    if(!jQuery.isEmptyObject(data.order_details)) {

                        //$('#ord_title_vw').html(data.order_details.name);
                        $('#inv_no').html("Invoice Number: "+data.order_details.invoice_no);
                        $('#ord_date').html("Ordered time: "+data.order_details.order_date);
                        $('#dlv_date').html("Delivery time: "+data.order_details.delivery_date);
                        $('#ntf_date').html("Notification time: "+data.order_details.notification_time);
                        $('#order_status').html("Order Status: "+data.order_details.order_status);
                        $('#customer_detail_vw').html(" "+data.order_details.full_name+"<br/><b>Mobile:</b> "+data.order_details.mobile+"<br/><b>Address:</b> "+data.order_details.c_address);
                        //$('#note_vw').html(data.remarks);
                    }
                    let order_status = parseInt(data['order_details']['status'])
                    if(order_status>3){
                        $('.before_order_initiate').css('display','none')
                        $('.after_order_initiate').css('display','block')

                    }

                    if(!jQuery.isEmptyObject(data.records)){
                        var sub_total=0;
                        $.each(data.records, function(i,data){
                            //console.log(data)
                            //alert(data['id'])

                            var order_tr = '';//for big screen
                            var order_total = 0;
                            var order_tr_small = ''; //for small screen

                            order_infos	 = data['order_info'];
                            var order_arr = order_infos.split('..,');
                            if(!order_arr[0] && order_status<4){
                                order_tr+='<tr><td colspan="4" align="left"  ><b>'+data['name']+' </b> ('+data['email']+')</td>'
                                order_tr_small+='<tr><td colspan="2" align="left"  ><b>'+data['name']+' </b> ('+data['email']+')</td>'
                                var tem = data['group_order_details_id']+'&'+data['order_key']
                                order_tr += '<tr><td class="text-capitalize">Not Selected<br><a href="#" onclick="selectItems('+order_id+','+"'"+data['group_order_details_id']+'&'+data['order_key']+"'"+')">Click here to Select item for <b>'+data['name']+'<b></a></td><td align="center"></td><td align="right"></td><td align="right">'+currency_symbol+''+'00'+'</td></tr>';
                                order_tr_small+='<tr><td class="text-capitalize">Not Selected<br><a href="#" onclick="selectItems('+order_id+','+"'"+data['group_order_details_id']+'&'+data['order_key']+"'"+')">Click here to Select item for <b>'+data['name']+'<b></a></td><td align="right">'+currency_symbol+''+'00'+'</td></tr>';

                            }
                            else if(order_arr[0]){
                                order_tr+='<tr><td colspan="4" align="left"  ><b>'+data['name']+' </b> ('+data['email']+')</td>'
                                order_tr_small+='<tr><td colspan="2" align="left"  ><b>'+data['name']+' </b> ('+data['email']+')</td>'
                                $.each(order_arr, function(i,orderInfo){
                                    //alert(orderInfo)
                                    var order_info_arr = orderInfo.split('#');
                                    var total = ((parseFloat(order_info_arr[4])*parseFloat(order_info_arr[5])));
                                    order_tr += '<tr><td class="text-capitalize">'+order_info_arr[2]+' <br>'+order_info_arr[6]+'<br><i style="color: black">'+order_info_arr[7].split('..')[0]+'</i></td><td align="center">'+order_info_arr[5]+'</td><td align="right">'+currency_symbol+''+order_info_arr[4]+'</td><td align="right">'+currency_symbol+''+total+'</td></tr>';
                                    order_tr_small+='<tr><td class="text-capitalize">'+order_info_arr[2]+':'+order_info_arr[5]+'X'+currency_symbol+''+order_info_arr[4]+'<br>'+order_info_arr[6]+'</td><td align="right">'+currency_symbol+''+total+'</td></tr>';

                                    order_total += total;
                                });
                                sub_total += order_total;
                                order_tr += '<tr><td colspan="3" align="right" ><b>Total Amount</b></td><td align="right"><b>'+currency_symbol+''+order_total.toFixed(2)+'</b></td></tr>';
                                order_tr_small += '<tr><td align="right" ><b>Total Amount</b></td><td align="right"><b>'+currency_symbol+''+order_total.toFixed(2)+'</b></td></tr>';

                            }

                            $('#ord_detail_vw_big>tbody').append(order_tr);
                            $('#ord_detail_vw_small>tbody').append(order_tr);


                            //for small device

                        });

                        var discount = 0;
                        var tax = 0;

                        discount = parseFloat(data['order_details']['discount_amount'])
                        tax = parseFloat(data['order_details']['tax_amount'])
                        total_paid_amount =  parseFloat(data['order_details']['total_paid_amount'])



                        /*if(data['order_details']['cupon_amount']!=null){
                            if(data['order_details']['c_type']==2){
                                discount =sub_total*data['order_details']['cupon_amount']/100
                            }
                            else  discount =data['order_details']['cupon_amount']
                        }

                        if(data['tax']['tax_enable']!=0){
                            if(data['tax']['tax_enable']==0){
                                tax=(sub_total-discount)*data['tax']['tax_amount']/100
                            }
                            else tax = data['tax']['tax_amount']
                        }*/


                        var order_tr='<tr align="right"><td colspan="3" ><b>Total Order Amount</b></td><td align="right"><b>'+currency_symbol+''+sub_total.toFixed(2)+'</b></td></tr>'
                        order_tr += '<trstyle="display: block><td colspan="3" align="right" ><b>Discount</b></td><td align="right"><b id="discount_amt">'+currency_symbol+''+discount.toFixed(2)+'</b></td></tr>';
                        order_tr += '<trstyle="display: block><td colspan="3" align="right" ><b>Tax</b></td><td align="right"><b id="tax_amt">'+currency_symbol+''+tax.toFixed(2)+'</b></td></tr>';
                        order_tr += '<trstyle="display: block><td colspan="3" align="right" ><b>Tips</b></td><td align="right"><b id="tax_amt">'+currency_symbol+''+data['order_details']['tips']+'</b></td></tr>';
                        order_tr += '<tr><td colspan="3" align="right" ><b>Grand Total Amount</b></td><td align="right"><b id="total_amt">'+currency_symbol+''+(total_paid_amount).toFixed(2)+'</b></td></tr>';


                        $('#ord_detail_vw>table>tbody').append(order_tr);
                    }
                }

            });

        }
        $('#order_modal').modal();


    }

    $('#tracker').on('click', function () {
        localStorage.setItem("currenturl", "tracking");
        localStorage.setItem("order_no_tracking",order_id)

        window.location.href=project_url+'account.php'
    })


</script>


