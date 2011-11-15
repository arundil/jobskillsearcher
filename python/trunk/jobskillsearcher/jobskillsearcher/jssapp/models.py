from django.db import models
from django.contrib.auth.models import User


# Create your models here.
class baseword(models.Model):
    word = models.TextField()
    type = models.TextField()
    class Meta:
        db_table = 'baseword'
    
class eval_analysis(models.Model):
    announcementID = models.CharField(max_length=11)
    evaluator = models.CharField(max_length=8)
    type = models.CharField(max_length=8)
    term = models.CharField(max_length=64)
    class Meta:
        db_table = 'eval_analysis'  
 
class group(models.Model):
    parentid = models.IntegerField(max_length=11)
    name = models.CharField(max_length=40)
    type = models.IntegerField(max_length=11)
    class Meta:
        db_table = 'group'

class hjh_terms(models.Model):
    name = models.IntegerField (max_length=11)
    group_id = models.CharField (max_length=128)
    language = models.IntegerField (max_length=11)
    class Meta:
        db_table = 'hjh_terms'

class hjh_term_group (models.Model):
    parent_id = models.IntegerField (max_length=11)
    name = models.CharField (max_length=128)
    class Meta:
        db_table = 'hjh_term_group'

class jannouncement (models.Model):
    title = models.CharField (max_length=50)
    url = models.URLField (max_length=200)
    date = models.DateField()
    status = models.IntegerField (max_length=11)
    sourceid = models.IntegerField (max_length=11)
    class Meta:
        db_table = 'jannouncement'

class morphword (models.Model):
    word = models.CharField (max_length=40)
    bid = models.IntegerField (max_length=11)
    class Meta:
        db_table = 'morphword'

class old_words (models.Model):
    groupID = models.IntegerField (max_length=11)
    type = models.IntegerField (max_length=11)
    word = models.CharField (max_length=40)
    class Meta:
        db_table = 'old_words'
    
class searchlog (models.Model):
    term = models.CharField (max_length=64)
    announcements = models.IntegerField(max_length=11)
    word = models.IntegerField (max_length=11)
    execution_time = models.CharField (max_length=16)
    executed = models.CharField(max_length=20)
    ip_address = models.IPAddressField()
    class Meta:
        db_table = 'searchlog'
    
class source (models.Model):
    name = models.CharField(max_length=50)
    class Meta:
        db_table = 'source'
    
    
class synonymes (models.Model):
    word_group_ID = models.IntegerField(max_length=11)
    word_ID = models.IntegerField(max_length=11)
    baseword = models.IntegerField(max_length=11)
    class Meta:
        db_table = 'synonymes'

class wlist (models.Model):
    jid = models.IntegerField(max_length=11)
    wid = models.IntegerField(max_length=11)
    class Meta:
        db_table = 'wlist'

class words (models.Model):
    gid = models.IntegerField(max_length=11)
    bid = models.IntegerField(max_length=11)
    word = models.CharField(max_length=128)
    type = models.IntegerField(max_length=11)
    count = models.IntegerField(max_length=11)
    class Meta:
        db_table = 'words' 
    
    
    
