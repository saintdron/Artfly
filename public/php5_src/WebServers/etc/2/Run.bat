@echo off
:: ��������� ��� ������� ���� ��������: Apache � MySQL.
call Boot.bat
Z:
: ��������� ���� ������ php.ini.
set PHPRC=\usr\local\php5
set PATH=%PHPRC%;%PATH%
: ������ Apache.
cd \usr\local\apache
start apache.exe
: �������� ���� ������� ��� ������� ������ ��������