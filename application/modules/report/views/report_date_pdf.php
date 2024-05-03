<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>รายงานการขายตามช่วงเวลา</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>
    body {
    background: rgb(204,204,204);
    font-family: 'Kanit', sans-serif;
    }
    page {
        padding: 10px;
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }
    @media print {
        body, page {
            background: white;
            margin: 0;
            box-shadow: 0;
        }
    }

</style>
</head>
<body>
<?php

$chunk = array_chunk($arr_rec, 25);

foreach ($chunk as $key => $value) {?>

<page size="A4">
    <div class="div" style='text-align: center; margin-bottom: 10px;'>
        <a style='font-size: 24px; font-weight: bold;'>รายงานการขายตามช่วงเวลา</a><br>
        <a style='font-size: 20px; font-weight: bold;'>ระหว่างวันที่ <?=$date_start?> - วันที่ <?=$date_end?></a>
    </div>
    <div class="div">
        <table style='width: 100%; line-height: 25px;'>
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ออเดอร์</th>
                    <th>การชำระ</th>
                    <th>วันที่ขาย</th>
                    <th>ลูกค้า</th>
                    <th>ต้นทุน</th>
                    <th>ยอดขาย</th>
                    <th>ส่วนลด</th>
                    <th>ยอดสุทธิ</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($value as $k => $v) {?>

                <tr>
                    <td style='text-align: center;'><?=$v[0]?></td>
                    <td style='text-align: center;'><?=$v[1]?></td>
                    <td style='text-align: center;'><?=$v[3]?></td>
                    <td style='text-align: center;'><?=$v[4]?></td>
                    <td><?=$v[5]?></td>
                    <td style='text-align: right;'><?=$v[7]?></td>
                    <td style='text-align: right;'><?=$v[8]?></td>
                    <td style='text-align: right;'><?=$v[9]?></td>
                    <td style='text-align: right;'><?=$v[10]?></td>
                </tr>

            <?php }?>

            </tbody>
        </table>
    </div>
</page>

<?php }?>
</body>
</html>
