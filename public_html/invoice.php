<?php
   require_once('../swim/tcpdf/tcpdf.php');
   
  require_once 'swim.php';
  

 

  $db=new database();
  $db->databaseName($SWIM['dbDatabaseName']);
  $db->username($SWIM['dbUsername']);
  $db->password($SWIM['dbPass']);
  $db->connect();
   
   
   $pdf = new TCPDF('P','pt','A4', true, 'UTF-8', false);
   $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
   $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
   
   if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
       require_once(dirname(__FILE__).'/lang/eng.php');
       $pdf->setLanguageArray($l);
   }
   
   
   $pdf->SetFont('helvetica', '', 9);
   $pdf->AddPage('P', 'A4');


    $request=new request();

     $selects=['paymentprocessor','id','quantity','amount','discount','type_id','paid_response','billing_info','paymentintentid','paymentid','hair','haircolor','eyes','eyescolor','glasses','freckles','body','bodycolor','pages','childsname','lovenote','childspicture','timestamp'];
    $search=['id'=>$request->getGet('id',0)];
    $db->tablePrefix('');
    $db->tableName('payments');
    $paymentRow=$db->get($selects,$search);

    if($paymentRow!==false)
    {
      $paymentRow=mysqli_fetch_assoc($paymentRow);
            
      if($paymentRow!==null)
      {
      

      $paymentProcessor='Stripe';
    $paymentIntentId=$paymentRow['paymentintentid'];
    if(empty($paymentIntentId))
    {
        $paymentProcessor='Pre Order';
    }
    
    if($paymentRow['type_id']==1){
     $type='Big Adventure';   
    }else {
        $type='Rivers Big Adventure';  
    }


        $responseData3=json_decode($paymentRow['paid_response']);
    $billingInfo=json_decode($paymentRow['billing_info']);
    
   $paymentProcessor='Stripe';
    $paymentIntentId=$paymentRow['paymentintentid'];
    if(empty($paymentIntentId))
    {
        $paymentProcessor='Pre Order';
    }

    if($paymentProcessor=='stripe')
    {
        
        $responseData3=json_decode($payment['paid_response']);
        $name= $responseData3->data->object->shipping->name;

    }else{
        
        $billingInfo=json_decode($paymentRow['billing_info']);
        $name =$billingInfo->name;
    }
    $nameArray= explode(' ', $name);
    $firstname= isset($nameArray[0])?$nameArray[0]:'';
    $lastname= isset($nameArray[1])?$nameArray[1]:'';
    $orderId= $paymentRow['id'];

   

   $html = '<html>
   <head>
      <title></title>
   </head>
   <body>
      <div>
         <table style="width:100%">
            <tr>
               <th style="color: #9f9e9e;font-size:15px">Cosmic Unicorns</th>
            </tr>
            <tr>
               <td style="color: #9f9e9e;font-size:10px">orders@cosmicunicorns.com</td>
            </tr>
            <tr>
               <td style="color: #9f9e9e;font-size:10px">754.300.9292</td>
            </tr>
         </table>
      </div>
      <div style="text-align:center;color: #9f9e9e;font-size:15px;    line-height: 10px;margin-bottom: 0px !important;margin-top: 0px !important;">Order Form</div>
      <div style="text-align:center;color: #9f9e9e;font-size:10px;    line-height: 10px;margin-bottom: 0px !important;margin-top: 0px !important;">Date : '.date('Y-m-d',$paymentRow['timestamp']).'</div>
      <hr>
      <div>
         <table style="width:100%">
            <tr>
               <th style="color: #9f9e9e;font-size:15px">
               
                  <div style="color: #9f9e9e;font-size:15px" >Customer Name</div>';

                  if($paymentProcessor=='Stripe'){
                     $html.='<div style="color: #9f9e9e;font-size:8px;line-height: 6px; ">'.$responseData3->data->object->shipping->name.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;" >'.$responseData3->data->object->shipping->address->line1.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;" >'.$responseData3->data->object->shipping->address->line2.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;">'.$responseData3->data->object->shipping->address->city.','.$responseData3->data->object->shipping->address->state.','.$responseData3->data->object->shipping->address->postal_code.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;">'.$responseData3->data->object->shipping->phone.'</div>';
                  }else {
                      $html.='<div style="color: #9f9e9e;font-size:8px;line-height: 6px; ">'.$billingInfo->name.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;" >'.$billingInfo->line1.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;" >'.$billingInfo->line2.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;">'.$billingInfo->city .','. $billingInfo->state .','.$billingInfo->postal_code.'</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;">'.$billingInfo->phone.'</div>';
                  }
                 
                $html.='</th>
               <th style="color: #9f9e9e;font-size:15px">
                  <div style="color: #9f9e9e;font-size:15px" >Invoice #</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px; ">'.$paymentRow['id'].'</div>
                  <div style="color: #9f9e9e;font-size:15px" >Due date</div>
                  <div style="color: #9f9e9e;font-size:8px;line-height: 6px;" >'.date('Y-m-d', strtotime('+10 days', $paymentRow['timestamp'])).'</div>
               </th>
            </tr>
         </table>
      </div>
      <div>
         <table style="width:100%" >
            <tr >
               <th  style="background-color: #26b4d7;color: #fff;font-size: 1.05em;"><br><br>Description<br></th>
               <th  style="background-color: #26b4d7;color: #fff;font-size: 1.05em;"><br><br>Qty<br></th>
               <th  style="background-color: #26b4d7;color: #fff;font-size: 1.05em;"><br><br>Unit price<br></th>
               <th  style="background-color: #26b4d7;color: #fff;font-size: 1.05em;"><br><br>Total price<br></th>
              
            </tr>
            <tr>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>'.$type.'<br></td>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>'.$paymentRow['quantity'].'<br></td>';
            $unit =  $paymentRow['type_id']==1?'29.00':'15.00';

               $html.='<td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>$'.$unit.'<br></td>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>$'.number_format($unit*$paymentRow['quantity'],2).'<br></td>
           
            </tr>';

$db->query('SELECT * FROM `payments` WHERE paid="1" AND order_id="'.$paymentRow['id'].'" ORDER BY `id` DESC');
                        $result=$db->exe();
                       while($payment=mysqli_fetch_assoc($result))
                      {
                         
                         $unit=($payment['type_id']==1)?'29.00':'15.00';
                          if($payment['type_id']==1){
                        $type='Big Adventure';   
                        }else {
                       $type='Rivers Big Adventure';  
                     }

                     $html.='<tr>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>'.$type.'<br></td>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>'.$payment['quantity'].'<br></td>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>$'.$unit.'<br></td>
               <td  style="border-left: 1px solid #d1d1d1;border-bottom: 1px solid #d8d8d8;color: #000;font-size: 1.05em;"><br><br>$'.number_format($unit*$payment['quantity'],2).'<br></td>
               
            </tr>';

                      }
            

        
        
            
        
        $html.='</table>
      </div>

      <div>
      <table>
      <tr>
               <td colspan="3"></td>
               <td >
                  <table style="width:100%">
                     <tr>
                        <th style="color: #9f9e9e;font-size:10px"><br>Subtotal<br></th>
                     </tr>
                  </table>
               </td>
               <td >
                  <table style="width:100%">
                     <tr>
                        <th style="color: #9f9e9e;font-size:10px"><br>$'.number_format($paymentRow['discount']+$paymentRow['amount'],2).'<br></th>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr >
               <td colspan="3"></td>
               <td >
                  <table style="width:100%">
                     <tr>
                        <th style="color: #9f9e9e;font-size:10px"><br>Adjustments<br></th>
                     </tr>
                  </table>
               </td>
               <td >
                  <table style="width:100%">
                     <tr>
                        <th style="color: #9f9e9e;font-size:10px"><br>-$'.number_format($paymentRow['discount'],2).'<br></th>
                     </tr>
                  </table>
               </td>
            </tr>

             <tr >
               <td colspan="3"></td>
               <td >
                  <table style="width:100%">
                     <tr>
                        <th style="color: #000;font-size: 26px;font-weight: 700;"><br>$'.number_format($paymentRow['amount'],2).'<br></th>
                     </tr>
                  </table>
               </td>
              
            </tr>




            </table></div>
   </body>
</html>';
 
 $pdf->writeHTML($html, true, 0, true, 0);
   $pdf->lastPage();
   $fileName=$lastname.'.'.$firstname.'.'.$orderId.'.invoice.pdf';
   $pdf->Output($fileName, 'D');

}}
   
   
   ?>