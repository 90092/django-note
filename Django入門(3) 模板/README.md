#Django入門(3) 模板標籤

###變量
####字典
views.py：

	def person(request):
   		person={'name':'John','sex':'man','age':20}
   		return render_to_response('person.html',locals())

person.html:

	<html>
  	<head></head>
  	<body>
  	名字: {{ person.name }}
  	性別: {{ person.sex }}
  	年齡: {{ person.age }}
  	</body>
  	</html>
   	
####list
views.py：

	def person(request):
   		person={'name':'John','sex':'man','age':20}
   		color = ['red','blue']
   		return render_to_response('person.html',locals())

person.html:
	
	<html>
  	<head></head>
  	<body>
  	名字: {{ person.name }}
  	性別: {{ person.sex }}
  	年齡: {{ person.age }}
  	喜歡的顏色: {{ color.0 }}
  	</body>
  	</html>
	
###標籤
####if
html:

	{% if person.isMan %}
		hi! {{ person.name }} 先生
	{% elif person.isWoman %}
		hi! {{ person.name }} 女士
	{% else %}
		hi! {{ person.name }}
	{% endif %}

####for
html:
	
	{% for color in colors %}
		喜歡的顏色: {{ color }}
	{% endfor %}

####註解

	{% comment %}
	檔不能沒有註註解
	{% endcomment %}
###過濾器
用於修飾變量:

	{{ person.name }}喜歡的顏色總共有{{ colors|length }}種
可接受串連：

	{{ colors|first|length }}
