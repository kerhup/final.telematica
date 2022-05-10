FROM php:7.0-apache
RUN apt-get update
RUN apt-get install git-core -y
RUN apt-get install bind9 -y 
RUN git clone https://github.com/kerhup/final.telematica.git /home/final/

RUN mv /etc/bind/named.conf /etc/bind/named.conf.old
RUN mv /home/final/named.conf /etc/bind/
RUN mv /home/final/mizonitadirecta /var/cache/bind/
RUN mv /home/final/mizonitainversa /var/cache/bind/
RUN mv /home/final/src/* /var/www/html/ 
RUN service apache2 stop
RUN service apache2 start

EXPOSE 80
EXPOSE 53

CMD ["/usr/sbin/apachectl", "-DFOREGROUND"]