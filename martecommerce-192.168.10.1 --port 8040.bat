@echo off
cd /d "c:\xampp\htdocs\nrb-erp-jago"
for /f "delims=[] tokens=2" %%a in ('ping -4 -n 1 Munir-PC ^| findstr [') do set NetworkIP=%%a
php artisan serve --host 192.168.10.1 --port 8040
pause