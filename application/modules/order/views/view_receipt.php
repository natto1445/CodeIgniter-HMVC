<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$order[0]->order_no?></title>
 <style>
  html {
    height: 100%;
    background-color: #ccc;
  }

  body {
    background-color: #fff
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  .a4 {
    box-sizing: border-box;
    width: 80mm;
    height: auto;
    padding: 5mm;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10mm;
    margin-bottom: 10mm;
    color: #222;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 2px 3px 5px rgba(119, 116, 116, 0.1);
    position: relative
  }

  .solid{
    border-top: 2px solid black;
    border-bottom: 2px double black;
  }

 </style>
</head>

<body class="a4">
 <div class="content">
    <h2 style='text-align: center;'>ใบเสร็จ</h2>

    <div class="detail" style='line-height: 5px;'>
        <p>ออเดอร์ : <?=$order[0]->order_no?></p>
        <p>วันที่ขาย : <?=date('Y-m-d', strtotime($order[0]->date_order))?></p>
        <p>ผู้ขาย : <?=$order[0]->usr_fname . " " . $order[0]->usr_lname?></p>
    </div>
    <table>
    <tr><th>รายการ</th><th>จำนวน</th><th>ราคา</th><th>ส่วนลด</th></tr>
    <?php if (!empty($detail)) {for ($i = 0; $i < count($detail); $i++) {?>
        <tr><td><?=$detail[$i]['name_product']?></td><td style='text-align: center;'><?=$detail[$i]['num_product']?></td><td style='text-align: right;'><?=$detail[$i]['price_product']?></td><td style='text-align: right;'><?=$detail[$i]['discount_product']?></td></tr>
    <?php }}?>
    <tr class='solid'><td><b>รวมยอด</b></td><td style='text-align: center;'>30</td><td style='text-align: right;'>50000</td><td style='text-align: right;'>500</td></tr>
    </table>

    <h5 style='text-align: center;'>***ขอบคุณที่ใช้บริการ***</h5>
 </div>
</body>

</html>
