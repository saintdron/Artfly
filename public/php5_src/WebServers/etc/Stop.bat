@echo off
:: ��������� ��� ��������� ���� ��������: Apache � MySQL.
: ��������� Apache.
Z:
cd \usr\local\apache
start apache.exe -k shutdown
: ��������� MySQL
cd \usr\local\mysql\bin
mysqladmin.exe -u root shutdown
: �������� ���� ������� ��� ��������� ������ ��������