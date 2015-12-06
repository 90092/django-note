from django.http import HttpResponse
from django.shortcuts import render_to_response

def hello(request):
    return HttpResponse('HelloWorld')

def hi(request, name):
    name = name
    return render_to_response('hi.html', locals())

def index(request):
    return render_to_response('index.php')
