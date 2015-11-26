#Django入門(2) 視圖與模板

在配置好Django後就是要show出Hello World啊！不然要幹嘛？ (° ∀ °)

### HelloWorld
在urls.py中的urlpatterns = []裡新增：

	url(r'^hello/', hello),

url的第一個參數使用的是正則式配對，第二個是我們要在views.py所配置的方法  

所以整個會長這樣：

	 urlpatterns = [
      url(r'^admin/', include(admin.site.urls)),
      url(r'^hello/', hello),
    ]

因為前面有說到要使用views.py的方法hello，所以必須要import hello

	 from views import hello

這樣一來urls.py的配置就完成了，不過因為當前目錄下沒有views.py，所以我們要自己建立一個。  
在views.py裡定義hello方法：

	def hello(request):
       return HttpResponse('HelloWorld')

其中HttpResponse()需要被import：

	from django.http import HttpResponse

接著回到我們的上層目錄讓server執行：
	
	python manage.py runserver

出現

	...
	Django version 1.8.6, using settings 'proj.settings'
	Starting development server at http://127.0.0.1:8000/
	Quit the server with CONTROL-C.

就代表執行了，於是開啟瀏覽器到http://127.0.0.1:8000/發現  
沒有東西是正常的，因為我們還未定義，接著直接跳轉到http://127.0.0.1:8000/hello吧   
這時候就會看到HelloWorld了

### Hi, Django
接下來要做的事，要向所有過客打招呼  
做法是使用url，假如說要向Django打招呼，則url會變成這樣  
http://127.0.0.1:8000/hi/django  

首先一樣在urls.py裡新增：

	url(r'^hi/(\w{1,10})/', hi)
\w代表的意思是匹配任一字母數字，而後面的{1,10}代表匹配\w 1~10次，也就是說匹配的字母或數字總共不超過10個，且至少要有一個，另外加上()裡面的值代表是要傳給hi的值

最後別忘了import hi

	from views import hello, hi

在views.py裡加入：

	def hi(request, name):
       return HttpResponse('Hi, ' + name)

其中傳入的name視為str

接著執行server後在瀏覽器裡輸入：
	
	http://127.0.0.1:8000/hi/Django/
就會出現：Hi, Django了

###使用模板
因為每次都在views.py裡直接輸出很不方便，所以現在要將輸出撰寫在html裡

在templates裡面新增一個hi.html檔：

	<html>
	<head></head>
	<body> 
		hi, {{name}}
	</body>
	</html>

其中{{name}}代表傳入的變量名稱

接著在views.py將hi()改成：

	def hi(request, name):
       return render_to_response('hi.html', {'name':name})

render_to_response第一個傳入的是使用的網頁，第二個參數是字典，另外要使用render_to_response也需要透過import：

	from django.shortcuts import render_to_response
	
有個方便儲存區域字典變數的函數：locals()  
用法：

	>>> a=1
	>>> locals()
	{'__builtins__': <module '__builtin__' (built-in)>, '__name__': '__main__', '__doc__': None, 'a': 1, '__package__': None}
	>>> b=2
	>>> locals()
	{'a': 1, 'b': 2, '__builtins__': <module '__builtin__' (built-in)>, '__package__': None, '__name__': '__main__', '__doc__': None}
	>>> c=3
	>>> locals()
	{'a': 1, 'c': 3, 'b': 2, '__builtins__': <module '__builtin__' (built-in)>, '__package__': None, '__name__': '__main__', '__doc__': None}

因此在hi()裡面就可以這樣改
	
	def hi(request, name):
		name = name
		return render_to_response('hi.html', locals())

這樣一來return就不用寫的"樂樂等"了
