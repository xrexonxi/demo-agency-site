<?php
// ---------------------------
// Настройки — ЗАМЕНИТЕ EMAIL
// ---------------------------
$to = "you@example.com"; // <- укажите вашу почту для заявок
$subject = "Новая заявка с сайта";

// Данные формы
$name    = trim($_POST['name']    ?? '');
$phone   = trim($_POST['phone']   ?? '');
$message = trim($_POST['message'] ?? '');
$plan    = trim($_POST['plan']    ?? '');

// Валидация
if ($name === '' || $phone === '') {
  http_response_code(400);
  echo "Пожалуйста, заполните имя и телефон/мессенджер.";
  exit;
}

// Тело письма
$body = "План: {$plan}
Имя: {$name}
Контакт: {$phone}
Сообщение: {$message}
IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown');

$headers   = [];
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/plain; charset=UTF-8";
$headers[] = "From: Website <noreply@" . ($_SERVER['SERVER_NAME'] ?? 'site') . ">";

$ok = @mail($to, "=?UTF-8?B?".base64_encode($subject)."?=", $body, implode("\r\n", $headers));

if ($ok) {
  header("Location: /?sent=1#contact");
  exit;
} else {
  http_response_code(500);
  echo "Не удалось отправить. Проверьте поддержку mail() на хостинге или укажите SMTP.";
}
