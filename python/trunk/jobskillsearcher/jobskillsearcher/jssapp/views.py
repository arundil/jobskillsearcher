from django.template.loader import get_template
from django.template import Context
from django.http import HttpResponse
import datetime
from jobskillsearcher.jssapp.models import *
from django.shortcuts import render_to_response
from django.db.models import Q
from django.core.context_processors import request
from django.db.models import Count,Avg

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
    
    search =request.POST['q']
    if search  :
        #palabra a buscar, Esta en la lista?
        query= (Q(word = search))
        results = Words.objects.filter(query)
        
        #Si esta en la lista, sacamos el anuncio donde esta contenido esta palabra.
        query2 = (Q(wid = Words.objects.filter(word=search)))
        jaun = list(Wlist.objects.filter(query2))    
        
        #Palabras por cada aunucio
        definitiva = []
        for i in jaun:
            definitiva.append((Wlist.objects.filter(jid=i.jid)))         
        
        final=[]
        count=[]
        for i in definitiva:
            for j in i:
                if final.__contains__(j.wid):
                    n=final.index(j.wid)
                    count[n]= count[n]+1
                else :
                    final.append(j.wid)
                    count.append(1)
                
#        algo = Wlist.objects.iterator()
#        algo2 = Words.objects.iterator()
        
#        for a1 in algo :
#            for a2 in algo2 :
#                if a1.wid == a2.id :
#                    res = a2.word
        #Busco en los anuncios a ver con que palabra se relaciona esta oferta.
        
        cont = Wlist.objects.filter(query2).count()
        
        test=Words.objects.filter()     
        
        return render_to_response('search.html',{'search':search, 'results':results, 'cont':cont, 'jaun':jaun, 'test': count})  
        
    else :
        results ="Debes introducir algo en el buscador";
    
        return render_to_response('search.html', {'results':results})


def nada (request):
    t=get_template('search.html')
    return HttpResponse(t)                                     