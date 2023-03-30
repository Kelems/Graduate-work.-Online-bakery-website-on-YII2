<?php
  require_once 'vendor/autoload.php';
  $document = new \PhpOffice\PhpWord\TemplateProcessor('./review.docx');
  $uploadDir =  __DIR__;
  $outputFile = 'review_full.docx';
  $uploadFile = $uploadDir . '\\' . basename($_FILES['file']['name']);
  move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
  $id = $_POST['id'];
  $order_date = $_POST['order_date'];
  $provider = $_POST['provider'];
  $ingredient = $_POST['ingredient'];
  $comment = $_POST['comment'];
  $cost = $_POST['cost'];
  $num = $_POST['num'];
  $itog = $_POST['cost'] * $_POST['num'];
  $document->setValue('id', $id);
  $document->setValue('order_date', $order_date);
  $document->setValue('provider', $provider);
  $document->setValue('ingredient', $ingredient);
  $document->setValue('comment', $comment);
  $document->setValue('cost', $cost);
  $document->setValue('num', $num);
  $document->setValue('itog', $itog);
  $document->saveAs($outputFile);
  // Имя скачиваемого файла
  $downloadFile = $outputFile;
  // Контент-тип означающий скачивание
  header("Content-Type: application/octet-stream");
  // Размер в байтах
  header("Accept-Ranges: bytes");
  // Размер файла
  header("Content-Length: ".filesize($downloadFile));
  // Расположение скачиваемого файла
  header("Content-Disposition: attachment; filename=".$downloadFile);
  // Прочитать файл
  readfile($downloadFile);
  unlink($uploadFile);
  unlink($outputFile);
?>
