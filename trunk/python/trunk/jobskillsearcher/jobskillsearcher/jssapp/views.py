from django.template.loader import get_template
from django.template import Context
from django.http import HttpResponse
import datetime
from jobskillsearcher.jssapp.models import *
from django.shortcuts import render_to_response
from django.db.models import Q
from django.core.context_processors import request
from django.db.models import Count,Avg
from django.db import *

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

def my_custom_sql():
    cursor = connection.cursor()

    # Data retrieval operation - no commit required
    cursor.execute('''SELECT word, count(word) as lkm FROM wlist LEFT JOIN words ON wlist.wid=words.id 
    WHERE (1=0 OR jid=646 OR jid=711 OR jid=712 OR jid=745 OR jid=762 OR jid=763 OR jid=1007 
    OR jid=1008 OR jid=1135 OR jid=1559 OR jid=1879 OR jid=2884 OR jid=2887 OR jid=2952 OR 
    jid=2955 OR jid=3138 OR jid=3139 OR jid=3143 OR jid=3151 OR jid=3161 OR jid=3162 OR jid=3892 OR 
    jid=4944 OR jid=4946 OR jid=4972 OR jid=5204 OR jid=5217 OR jid=5218 OR jid=5222 OR jid=5440 OR
     jid=5679 OR jid=5706 OR jid=5707 OR jid=5709 OR jid=5776 OR jid=5900 OR jid=6396 OR jid=6408 OR 
     jid=6412 OR jid=6478 OR jid=6582 OR jid=6617 OR jid=6768 OR jid=6813 OR jid=6815 OR jid=6974 OR 
     jid=7283 OR jid=7802 ) AND type!=3 AND type!=0 AND type!=701 GROUP BY word ORDER BY lkm DESC, word;''')
    
    row = cursor.fetchall()

    return row

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
        
        #test= my_custom_sql()
        
        #lista=[]
        #for i in range(len(test)):
        #    lista.append(test[i][0])
        
        
#        #Palabras por cada aunucio
       
        palabras_totales=[]
        for i in jaun:
            palabrasporanuncio= Wlist.objects.filter(jid=i.jid)         
            for j in palabrasporanuncio :
                palabras_totales.append(Words.objects.get(id=j.wid))
                 
#        final=[]
#        cont=[]
#        for i in definitiva:
#            for j in i:
#                if final.__contains__(j.wid):
#                    n=final.index(j.wid)
#                    cont[n]= cont[n]+1
#                else :
#                    final.append(j.wid)
#                    cont.append(1)
         
               
#        algo = Wlist.objects.iterator()
#        algo2 = Words.objects.iterator()
        
#        for a1 in algo :
#            for a2 in algo2 :
#                if a1.wid == a2.id :
#                    res = a2.word
        #Busco en los anuncios a ver con que palabra se relaciona esta oferta.
        
        
        
        cont = Wlist.objects.filter(query2).count()
            
        
        return render_to_response('search.html',{'search':search, 'results':results, 'cont':cont, 'jaun':jaun, 'test': palabras_totales })  
        
    else :
        results ="Debes introducir algo en el buscador";
    
        return render_to_response('search.html', {'results':results})


def nada (request):
    t=get_template('search.html')
    return HttpResponse(t)                                     