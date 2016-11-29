// ��������� POST-������ � URL-��������������.
#include <stdio.h>
#include <stdlib.h>
#include "urldecode.c"

void main(void) {
  // �������� �������� ���������� ���������
  char *RemoteAddr = getenv("REMOTE_ADDR");
  char *ContentLength = getenv("CONTENT_LENGTH");
  //!! �������� ������ ��� ������ QUERY_STRING
  char *QueryString = malloc(strlen(getenv("QUERY_STRING")) + 1);
  //!! �������� QUERY_STRING � ��������� ����� 
  strcpy(QueryString, getenv("QUERY_STRING"));
  // ���������� QUERY_STRING
  UrlDecode(QueryString);
  // ��������� ���������� ������ ������ - ��������� ������ � �����
  int NumBytes = atoi(ContentLength);
  // �������� � ��������� ������ ����� ������� �������
  char *Data = (char*)malloc(NumBytes + 1);
  // ������ ������ �� ������������ ������ �����
  fread(Data, 1, NumBytes, stdin);
  // ��������� ������� ��� � ����� ������
  // (� �� ������� ��� ������������� � ����� ������)
  Data[NumBytes] = 0;
  // ���������� ������ (���� ��� � �� ������ ����������, �� 
  // ��������� ����� ��� ���� POST-������, �� �������� �� �� 
  // ���������)
  UrlDecode(Data);
  // ������� ���������
  printf("Content-type: text/html\n\n");
  // ������� ��������
  printf("<html><body>");
  printf("<h1>������������. �� ����� � ��� ���!</h1>");
  printf("��� IP-�����: %s<br>",RemoteAddr);
  printf("���������� ������ ������: %d<br>", NumBytes);
  printf("��� ���������, ������� �� �������: %s<br>",Data);
  printf("� ��� ��, ��� �� �������� ����� URL: %s",
    QueryString);
  printf("</body></html>");
}
