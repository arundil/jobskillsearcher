from django.db import models
from django.contrib.auth.models import User


# Create your models here.
class baseword(models.Model):
    word = models.TextField()
    type = models.TextField()
    
    class Meta:
        db_table = 'baseword'
    
    def __unicode__(self):
        return self.word 
    
class eval_analysis(models.Model):
    announcementID = models.CharField(max_length=11)
    evaluator = models.CharField(max_length=8)
    type = models.CharField(max_length=8)
    term = models.CharField(max_length=64)
    
    class Meta:
        db_table = 'eval_analysis'
        
    def __unicode__(self):
        return self.announcementID  
 
class group(models.Model):
    parentid = models.IntegerField(max_length=11)
    name = models.CharField(max_length=40)
    type = models.IntegerField(max_length=11)
    
    class Meta:
        db_table = 'group'
    
    def __unicode__(self):
        return self.parentid
    

class hjh_term_group (models.Model):
    parent_id = models.IntegerField (max_length=11)
    name = models.CharField (max_length=128)
    class Meta:
        db_table = 'hjh_term_group'
    
    def __unicode__(self):
        return self.name

class hjh_terms(models.Model):
    name = models.IntegerField (max_length=11)
    group_id = models.ForeignKey(hjh_term_group)
    language = models.IntegerField (max_length=11)
    
    class Meta:
        db_table = 'hjh_terms'
    
    def __unicode__(self):
        return self.name


class source (models.Model):
    name = models.CharField(max_length=50)
    class Meta:
        db_table = 'source'
    def __unicode__(self):
        return self.name

class jannouncement (models.Model):
    title = models.CharField (max_length=50)
    url = models.URLField (max_length=200)
    date = models.DateField()
    status = models.IntegerField (max_length=11)
    sourceid = models.ForeignKey(source)
    class Meta:
        db_table = 'jannouncement'
    def __unicode__(self):
        return self.title

class morphword (models.Model):
    word = models.CharField (max_length=40)
    bid = models.ForeignKey(baseword)
    class Meta:
        db_table = 'morphword'
    def __unicode__(self):
        return self.word

class old_words (models.Model):
    groupID = models.ForeignKey(group)
    type = models.IntegerField (max_length=11)
    word = models.CharField (max_length=40)
    class Meta:
        db_table = 'old_words'
    def __unicode__(self):
        return self.word
    
class searchlog (models.Model):
    term = models.CharField (max_length=64)
    announcements = models.IntegerField(max_length=11)
    word = models.IntegerField (max_length=11)
    execution_time = models.CharField (max_length=16)
    executed = models.CharField(max_length=20)
    ip_address = models.IPAddressField()
    class Meta:
        db_table = 'searchlog'
    def __unicode__(self):
        return self.word
    
    
class words (models.Model):
    gid = models.ForeignKey(group)
    bid = models.ForeignKey(baseword)
    word = models.CharField(max_length=128)
    type = models.ForeignKey(hjh_term_group)
    count = models.IntegerField(max_length=11)
    class Meta:
        db_table = 'words'
    def __unicode__(self):
        return self.word 
    
class synonymes (models.Model):
    word_group_ID = models.IntegerField(max_length=11)
    word_ID = models.ForeignKey(words)
    baseword = models.ForeignKey(baseword)
    class Meta:
        db_table = 'synonymes'
    def __unicode__(self):
        return self.word_group_ID

class wlist (models.Model):
    jid = models.ForeignKey(jannouncement)
    wid = models.ForeignKey(words)
    class Meta:
        db_table = 'wlist'
    def __unicode__(self):
        return self.jid

    
    
    
