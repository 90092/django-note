# Django入門(1) 前置設定

Django是一個開放原始碼的Web應用框架，由Python寫成。採用了MVC的軟體設計模式 --wiki

###安裝

	pip install Django
	
###建置專案

	django-admin.py startproject proj
其中proj就是專案名

###目錄結構
 -- manage.py  
|    
 -- proj  
&nbsp;&nbsp;|  
&nbsp; -- \_\_init__.py  
&nbsp; -- settings.py  
&nbsp; -- urls.py  
&nbsp; -- wsgi.py
 	 
manage.py:python的命令稿，讓使用者更方便管理專案  
proj：專案的主目錄  
\_\_init__.py  
settings.py：設定檔  
urls.py：URL的配置檔  
wsgi.py：網頁伺服器和Django的接口

###啟動Server
	
	python manage.py runserver
	
###環境設定
使用settings.py檔案

####專案路徑

	BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
預設就會產生了，所以不用手動設定

之後還要設定模板(templates)路徑，在自動產生的TEMPLATES=[]底下：
	
	TEMPLATES = [
      {
          'BACKEND': 'django.template.backends.django.DjangoTemplates',
          'DIRS': [],
          'APP_DIRS': True,
          'OPTIONS': {
              'context_processors': [
                  'django.template.context_processors.debug',
                  'django.template.context_processors.request',
                  'django.contrib.auth.context_processors.auth',
                  'django.contrib.messages.context_processors.messages',
              ],
          },
      },
	]

在'DIRS': [],裡設置模板位置(Django 1.8適用)：

	'DIRS': [os.path.join(BASE_DIR, 'templates')],

若是Django1.8以前版本請另外新增以下：

	TEMPLATE_DIRS = (
      os.path.join(BASE_DIR, 'templates'),
    )
接著請在最上層的proj(和manage.py同一層)新增一個templates目錄，其是用來放網頁的模板

####除錯模式
	# SECURITY WARNING: don't run with debug turned on in production!
	DEBUG = True
PS:為了網頁安全性考量，若網站要上線時，請記得將DEBUG模式關閉

####Application安裝
在Django中App和Project是兩種不同的東西，一個Project可以由多個App組成。

	 INSTALLED_APPS = (
      'django.contrib.admin',
      'django.contrib.auth',
      'django.contrib.contenttypes',
      'django.contrib.sessions',
      'django.contrib.messages',
      'django.contrib.staticfiles',
     )
這些是內建的，若往後有需要新增或移除App請在這裡設定

####根URL配置
	ROOT_URLCONF = 'proj.urls'
	
####資料庫設定

	DATABASES = {
      'default': {
          'ENGINE': 'django.db.backends.sqlite3',
          'NAME': os.path.join(BASE_DIR, 'db.sqlite3'),
      }
    }

Django預設是使用sqlite3

####語言和時區設定
預設是美國，因此可以將它改為台灣

	LANGUAGE_CODE = 'zh-TW'
	TIME_ZONE = 'Asia/Taipei'

*****

####參考書籍：
It’s Django：用Python迅速打造Web應用