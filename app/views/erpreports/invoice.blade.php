<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<html >



<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
   
<script type="text/javascript">
  document.body.onload = function () {
                var textcontrol = document.getElementById("t");
                textcontrol.style.height = (window.innerHeight) + 'px';
            }
</script>

<style>

@page { margin: 170px 20px; }
 .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -120px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }

  table{
    font-size: 12px;
  }

  .demo {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:0px;
  }
  .demo th {
    border:1px solid #C0C0C0;
    padding:5px;
  }
  .demo td {
    border:1px solid #C0C0C0;
    padding:5px;
  }


  .inv {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:0px;
  }
  .inv th {
    border:1px solid #C0C0C0;
    padding:5px;
  }
  .inv td {
    border-bottom:0px solid #C0C0C0;
    border-right:1px solid #C0C0C0;
    padding:5px;
  }


</style>


</head>

<body>
    
<div class="content">

<div class="row">
  <div class="col-lg-12">

  <?php

  $address = explode('/', $organization->address);

  ?>

      <table class="" style="border: 0px; width:100%">

          <tr>

            <td style="width:150px">

            <img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="100%">
    
        </td>

        </tr>

        </table>

        <table style="border: 0px; width:100%">
        <tr>
          
            <td >
            {{ strtoupper('Bank Name: '.Bank::getName($organization->bank_id))}}<br>
            {{ strtoupper('Bank Branch Name: '.BBranch::getName($organization->bank_branch_id))}}<br>
            {{ strtoupper('Bank Acc No.: '.$organization->bank_account_number)}}

            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>

            <td colspan="2" align="right">
                  <strong style="font-size: 24px;">Invoice</strong>
                <table class="demo" style="width:70%; margin-right:-65px !important ;">
                  
                  <tr >
                    <td>Date</td><td>Invoice #</td>
                  </tr>
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td><td>{{$erporder->order_number}}</td>
                  </tr>
                  
                </table>
            </td>
          </tr>

          
        
      </table>
      <br>
      <table class="demo" style="width:40%">
        <tr>
          <td><strong>Bill To</strong></td>
        </tr>
        <tr>
          <td>{{$erporder->client->name}}<br>
          {{$erporder->client->contact_person}}<br>
           {{$erporder->client->phone}}<br>
            {{$erporder->client->email}}<br>
            {{$erporder->client->address}}<br>
          </td>
        </tr>
      </table>




      <br>

           <table class="inv" style="width:100%;">
          
           <tr>
            <td style="border-bottom:1px solid #C0C0C0">Quantity</td>
            <td style="border-bottom:1px solid #C0C0C0">Description</td>
            <td style="border-bottom:1px solid #C0C0C0">Rate</td>
            <td style="border-bottom:1px solid #C0C0C0">Amount</td>
          </tr>

         <?php $total = 0; $i=1;  $grandtotal=0;?>
          @foreach($erporder->erporderitems as $orderitem)

          <?php

            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $amount;


            ?>
          <tr>
            <td>{{ $orderitem->quantity}}</td>
            <td>{{ $orderitem->item->name.' : '.$orderitem->item->description}}</td>
            <td>{{ asMoney($orderitem->price)}}</td>
             <td> {{asMoney($orderitem->price * $orderitem->quantity)}}</td>
          </tr>


      @endforeach

     <!-- <tr>
            <td rowspan="{{15-count($erporder->erporderitems)}}"></td>
            <td rowspan="{{15-count($erporder->erporderitems)}}"></td>
            
            <td rowspan="{{15-count($erporder->erporderitems)}}"></td>
            <td rowspan="{{15-count($erporder->erporderitems)}}"></td>
            
             <td rowspan="{{15-count($erporder->erporderitems)}}"> </td>
          </tr>  -->

     @for($i=1; $i<23-count($erporder->erporderitems);$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor 
          <tr>
            <td colspan="2" style="border-top:1px solid #C0C0C0">Inclusive of 16% VAT Pin No. {{$organization->kra_pin}}</td>
            
            <!-- <td style="border-top:1px solid #C0C0C0" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($total)}}</td></tr><tr>

            <td style="border-top:1px solid #C0C0C0" ><strong>Discount</strong> </td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($orders->discount_amount)}}</td> -->
           
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $grandtotal + $txorder->amount; ?>
           <!-- <tr>
            <td style="border-top:1px solid #C0C0C0" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #C0C0C0" colspan="1">KES {{asMoney($txorder->amount)}}</td>
           </tr> -->
           @endforeach
            <!-- <tr> -->
            <td style="border-top:1px solid #C0C0C0" colspan="2"><strong style="margin-right:60%;">Total</strong>&emsp;&emsp;&emsp; KES {{asMoney($grandtotal-$orders->discount_amount)}}</td>
           </tr>
           
         


      
      </table>



    
  </div>


</div>
</div>







   



<div class="footer">
     <p style="font-size: 10px;"><!-- Page <?php $PAGE_NUM ?> --> 
     {{ $organization->name}}&nbsp;&nbsp;
     {{ $organization->address}}
     </p>
   </div>

<br><br>

   

</body>

</html>



