# Как запустить бот на Python без pooling, через свой сервер

Разберем пошагово, как запустить бота на Python через свой сервер (без использования pooling), с настройкой автозапуска и защитой от сбоев.

---

Шаг 1. Подготовка сервера

1. Выберите сервер:

* VPS/VDS с ОС Linux (рекомендуется Ubuntu/Debian).

2. Настройте SSH-доступ:

       ssh username@server_ip

3. Обновите пакеты:

       sudo apt update && sudo apt upgrade -y

---

Шаг 2. Загрузка кода бота

1. Создайте папку для бота:

        mkdir ~/my_bot && cd ~/my_bot

2. Загрузите код:

* Через Git:

      git clone <ваш_репозиторий>

* Или скопируйте файлы через SCP/SFTP.

---

Шаг 3. Настройка окружения Python

1. Установите Python и pip:

       sudo apt install python3 python3-pip -y

2. Создайте виртуальное окружение:

       python3 -m venv venv

3. Активируйте виртуальное окружение:

       source venv/bin/activate

4. Установите зависимости:

       pip install -r requirements.txt

---

Шаг 4. Настройка вебхуков (вместо pooling)

Для Telegram-бота:

1. Получите SSL-сертификат (обязательно для вебхуков):

* Бесплатный через Let’s Encrypt:

      sudo apt install certbot -y
      sudo certbot certonly --standalone -d yourdomain.com

* Либо используйте самоподписанный сертификат (только для тестирования):

      openssl req -x509 -newkey rsa:2048 -keyouts key.pem -out cert.pem

2. В коде бота настройте вебхук:

```py
import requests

url = f"https://yourdomain.com:8443/{TOKEN}"
data = {"url": url}
response = requests.post(f"https://api.telegram.org/bot{TOKEN}/setWebhook", data=data)
print(response.json())
```

3. Пример минимального сервера на Flask:

```py
from flask import Flask, request
import telebot

app = Flask(__name__)
bot = telebot.TeleBot("YOUR_TOKEN")

@app.route('/YOUR_TOKEN', methods=['POST'])
def get_message():
    bot.process_new_updates([telebot.types.Update.de_json(request.stream.read().decode("utf-8"))])
    return "!", 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8443, ssl_context=('path/to/cert.pem', 'path/to/key.pem'))
```

---

Шаг 5. Запуск бота как службы (systemd)

1. Создайте файл службы:

       sudo nano /etc/systemd/system/my_bot.service

2. Вставьте конфигурацию (замените User, пути в WorkingDirectory и ExecStart на реальные):

```bash
[Unit]
Description=My Python Telegram Bot
After=network.target

[Service]
User=ubuntu
WorkingDirectory=/home/ubuntu/my_bot
ExecStart=/home/ubuntu/my_bot/venv/bin/python /home/ubuntu/my_bot/bot.py
Restart=always
RestartSec=5
StandardOutput=syslog
StandardError=syslog
SyslogIdentifier=my_bot

[Install]
WantedBy=multi-user.target
```

3. Активируйте службу:

       sudo systemctl daemon-reload
       sudo systemctl enable my_bot.service
       sudo systemctl start my_bot.service

---

Шаг 6. Проверка работы

1. Проверьте статус службы:

       sudo systemctl status my_bot.service

2. Посмотрите логи:

       journalctl -u my_bot.service -f

3. Проверьте работу вебхука:

       curl https://yourdomain.com:8443/YOUR_TOKEN

---

Альтернативные способы запуска (на выбор)

Вариант 1. Через screen (простой, но без автозапуска после перезагрузки):

```
sudo apt install screen -y
screen -S bot
source venv/bin/activate
python bot.py
# Нажмите Ctrl+A, затем D для отсоединения
```

Вариант 2. Через PM2 (удобный менеджер процессов):

```
sudo npm install pm2 -g
pm2 start bot.py --interpreter=python3
pm2 save
pm2 startup
```

---

Важные нюансы

* Порты: откройте в фаерволе порт для вебхука (например, 8443):

      sudo ufw allow 8443

* Безопасность:
  * Не храните токены в коде. Используйте переменные окружения или .env-файл.
  * Настройте фаервол (ufw) и ограничьте доступ по IP, если возможно.
* Обновления: после изменения кода перезапустите службу:

      sudo systemctl restart my_bot.service

---