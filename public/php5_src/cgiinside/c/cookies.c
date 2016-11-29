// ������� ��������, ������������ Cookies.
#include <stdio.h>
#include <stdlib.h>

// ������ ���������
void main() {
  // ��������� �����
  char Buf[1000];
  // �������� � ���������� Cook �������� Cookies
  char *Cook = getenv("HTTP_COOKIE");
  // ���������� � ��� 5 ������ �������� ("cook="), ���� ��� �� ������ -
  // ������� ��� ��� �������� Cookie, ������� �� ���������� �����
  // (��. ����).
  Cook += 5;  // �������� ��������� �� 5 �������� ������ �� ������
  // �������� ���������� QUERY_STRING
  char *Query = getenv("QUERY_STRING");
  // ���������, ������ �� ��������� � �������� - ���� ��, ��
  // ������������, ��������, ���� ���� ��� ��� ����� ������,
  // � ��������� ������ �� ������ �������� �������� ��� ����������
  if(strcmp(Query, "")) { // ������ �� ������?
    // �������� � ����� �������� QUERY_STRING,
    // ��������� ������ 5 �������� (����� "name=") -
    // ������� ��� ��� ����� ������������
    strcpy(Buf, Query + 5);
    // ������������ ���� ��� - ������, ����� ���������� Cookie 
    printf("Set-cookie: cook=%s; "
           "expires=Friday,31-Dec-01 23:59:59 GMT", Buf); 
    // ������ ��� - ����� �������� Cookie
    Cook=Buf;
  }
  // ������� �������� � ������
  printf("Content-type: text/html\n\n");
  printf("<html><body>\n");
  // ���� ��� ������ (�� ������ ������), �����������
  if(strcmp(Cook, ""))
    printf("<h1>������, %s!</h1>\n",Cook);
  // ����������
  printf("<form action=/cgi-bin/script.cgi method=get>\n");
  printf("���� ���: ");
  printf("<input type=text name=name value='%s'>\n",Cook);
  printf("<input type=submit value='���������'>\n");
  printf("</form>\n");
  printf("</body></html>");
}
