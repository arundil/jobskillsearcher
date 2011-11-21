from django.conf.urls.defaults import *
from django.contrib import admin
from jobskillsearcher.jssapp.views import *
import os

# Uncomment the next two lines to enable the admin:
from django.contrib import admin
admin.autodiscover()

site_media = os.path.join(os.path.dirname(__file__),  'jssapp/site_media') 

urlpatterns = patterns('',
    (r'^site_media/(?P<path>.*)$', 'django.views.static.serve',{'document_root': site_media}),
                       
    (r'^$', 'django.contrib.auth.views.login', {'template_name': 'main.html'}),
    (r'^time/$', current_datetime),
    (r'^time/plus/(\d{1,2})+/$', hours_ahead),
    (r'^admin/', include(admin.site.urls)),
    (r'^hola/$',hola),
    (r'^search/$',search),
    
    # Examples:
    # url(r'^$', 'jobskillsearcher.views.home', name='home'),
    # url(r'^jobskillsearcher/', include('jobskillsearcher.foo.urls')),

    # Uncomment the admin/doc line below to enable admin documentation:
    # url(r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
)
