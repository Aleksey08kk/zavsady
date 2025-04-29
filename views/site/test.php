<br><br><br><br><br>

<?php
include_once 'phpqrcode/qrlib.php';

    $codeContents = 'ST00012|Name=СНТ Завьяловские сады|PersonalAcc=40703810648000001278|BankName=УДМУРТСКОЕ ОТДЕЛЕНИЕ N8618 ПАО СБЕРБАНК|BIC=049401601|CorrespAcc=30101810400000000601|KPP=184101001|PayeeINN=1831167843|lastName=НеЖопа|payerAddress=Виноградная 12|Purpose=Взнос 24-25г.|Sum=10000';
    
   QRcode::png($codeContents);


?>                


<br><br><br><br><br><br>

