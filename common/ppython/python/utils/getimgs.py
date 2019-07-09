
from bs4 import BeautifulSoup
import requests
import time

#isbn_raw = '978-7-5354-4055-6'
# isbn_raw = '978-7-1111-2222-3'
#isbn_raw = ' 978-7-5354-4055-6 '

def get_imgs_url(isbn):    
    isbn = isbn.strip()
    isbn = isbn.replace("-", "")

    while True:
        try:
            ret = requests.get('https://www.amazon.cn/s?k='+isbn+'&i=stripbooks')
            break
        except:
            # print("get exception, sleep 5 seconds...")
            time.sleep(5)

    soup = BeautifulSoup(ret.text, 'html.parser')
    # disconnection
    ret.close()

    tags = soup.find_all('img', class_="s-image")

    img_url = ''
    for tag in tags:
        if tag['src'] != None:
            img_url = tag['src']
            break

    # print(img_url)
    return img_url
