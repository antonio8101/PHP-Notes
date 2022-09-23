#  Sending Mail from PHP using MAIL
PHP `mail()` function rely on a binary called `sendmail`. While this binary is usually available on linux server in shared hosting, it should be installed in local DEV environment, or PRODUCTION custom environment.

An alternative to the installation of this binary, could be to "rely" on an external SMTP server.
You can configure it on PHP by installing the `ssmtp` extension on non-windows system, or by setting property in `php.ini` settings if you are running `WINDOWS`.

## SMTP RELAY on Windows

#### PHP ini settings:
```ini
[mail function]
; For Win32 only.
; https://php.net/smtp
SMTP = localhost
; https://php.net/smtp-port
smtp_port = 25
```

#### Runtime settings:
```php
ini_set( 'SMTP', 'localhost' );
ini_set( 'smtp_port', '25' );
```

## SMTP RELAY on DOCKER containers

In case you are using PHP on Docker, instead of installing `sendmail` binary on local instance, you can rely on a dedicated smtp server.

#### Your PHP Docker instance should contain the following lines:
```dockerfile
# 7 Sendmail
RUN apt-get update && apt-get install -q -y ssmtp mailutils
RUN echo "mailhub=host.docker.internal" >> /etc/ssmtp/ssmtp.conf # buildkit
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini # buildkit
```
These lines allow your internal PHP settings to use an external SMTP server (running in the context of the host).


## Some possible SMTP servers

In addiction, when you relay on external SMTP system you can choose to RUN a dedicated smtp instance on localhost port ``25`` by using a dedicated container.
For example you can use `namshi\smtp` image, which allow you to configure your preferred external SMTP service.

The following are some examples:

```shell

# MAILTRAP.io
docker run -d -p 127.0.0.1:25:25 --env SMARTHOST_ADDRESS=smtp.mailtrap.io --env SMARTHOST_PORT={port-config} --env SMARTHOST_USER={user} --env SMARTHOST_PASSWORD={password} --env SMARTHOST_ALIASES=*.mailtrap.io --name smtp namshi/smtp:latest

# SENDGRID
docker run -d -p 127.0.0.1:25:25 --env SMARTHOST_ADDRESS=smtp.sendgrid.net --env SMARTHOST_PORT={port-config} --env SMARTHOST_USER=apikey --env SMARTHOST_PASSWORD={apikeyValue} --env SMARTHOST_ALIASES=*.sendgrid.net --name smtp namshi/smtp:latest

```