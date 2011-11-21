from django.template.loader import get_template
from django.template import Context
from django.http import HttpResponse
import datetime
from jobskillsearcher.jssapp.models import *
from django.shortcuts import render_to_response
from django.db.models import Q
from django.core.context_processors import request

def hola(request):
    return HttpResponse("Hola Mundo")

def current_datetime(request):
    now = datetime.datetime.now()
    t = get_template('current_datetime.html')
    html = t.render(Context({'current_date':now}))
    return HttpResponse(html)

def hours_ahead(request, offset):
    offset = int(offset)
    dt = datetime.datetime.now() + datetime.timedelta(hours=offset)
    html = "<html><body>In %s hour(s), it will be %s.</body></html>" % (offset, dt)
    return HttpResponse(html)

def search(request):
    search="Introduce algo"
    
    if search :
        search =request.POST['q']
        results = "algo hay"
        query= (Q(name__icontains=search))
        results = HjhTermGroup.objects.filter(query).distinct()
    else :
        results ="Debes introducir algo en el buscador";
    
    return render_to_response('search.html',{'search':search, 'results':results})  


def nada (request):
    t=get_template('search.html')
    return HttpResponse(t)                                     