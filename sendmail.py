import requests
import queue

with open('sendmail.xml', 'r') as content_file:
    xml = content_file.read()
headers = {'Content-Type': 'application/xml'} # set what your server accepts
print(xml)
r = requests.post('https://cloudmatica.com/sendmail/sendmail.php', data=xml, headers=headers)
#r = requests.post('http://localhost/sendmail/sendmail.php', data=xml, headers=headers)
print(r.text)