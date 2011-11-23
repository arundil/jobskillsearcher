# This is an auto-generated Django model module.
# You'll have to do the following manually to clean this up:
#     * Rearrange models' order
#     * Make sure each model has one field with primary_key=True
# Feel free to rename the models, but don't rename db_table values or field names.
#
# Also note: You'll have to insert the output of 'django-admin.py sqlcustom [appname]'
# into your database.

from django.db import models

class Baseword(models.Model):
    id = models.IntegerField(primary_key=True)
    word = models.TextField()
    type = models.TextField()
    class Meta:
        db_table = u'baseword'
        
    def __unicode__(self):
        return self.word

class EvalAnalysis(models.Model):
    id = models.IntegerField(primary_key=True)
    announcementid = models.IntegerField(null=True, db_column='announcementID', blank=True) # Field name made lowercase.
    evaluator = models.CharField(max_length=24, blank=True)
    type = models.CharField(max_length=24, blank=True)
    term = models.CharField(max_length=192, blank=True)
    class Meta:
        db_table = u'eval_analysis'
        
    def __unicode__(self):
        return self.term

class Group(models.Model):
    id = models.IntegerField(primary_key=True)
    parentid = models.IntegerField(null=True, blank=True)
    name = models.CharField(max_length=120)
    type = models.IntegerField()
    class Meta:
        db_table = u'group'
    
    def __unicode__(self):
        return self.name

class HjhTermGroup(models.Model):
    id = models.IntegerField(primary_key=True)
    parent_id = models.IntegerField(null=True, blank=True)
    name = models.CharField(max_length=384, blank=True)
    class Meta:
        db_table = u'hjh_term_group'

class HjhTerms(models.Model):
    id = models.IntegerField(primary_key=True)
    name = models.CharField(max_length=384, blank=True)
    group_id = models.IntegerField(null=True, blank=True)
    language = models.IntegerField(null=True, blank=True)
    class Meta:
        db_table = u'hjh_terms'
        
    def __unicode__(self):
        return self.name

class Jannouncement(models.Model):
    id = models.IntegerField(primary_key=True)
    title = models.CharField(max_length=150)
    url = models.CharField(max_length=600)
    date = models.DateField()
    status = models.IntegerField()
    sourceid = models.IntegerField()
    class Meta:
        db_table = u'jannouncement'
        
    def __unicode__(self):
        return self.title

class Morphword(models.Model):
    id = models.IntegerField(primary_key=True)
    word = models.CharField(max_length=120)
    bid = models.IntegerField()
    class Meta:
        db_table = u'morphword'
    
    def __unicode__(self):
        return self.word

class OldWords(models.Model):
    id = models.IntegerField(primary_key=True)
    groupid = models.IntegerField(null=True, db_column='groupID', blank=True) # Field name made lowercase.
    type = models.IntegerField(null=True, blank=True)
    word = models.CharField(max_length=120, blank=True)
    class Meta:
        db_table = u'old_words'
    def __unicode__(self):
        return self.word

class Searchlog(models.Model):
    term = models.CharField(max_length=192, blank=True)
    announcements = models.IntegerField(null=True, blank=True)
    words = models.IntegerField(null=True, blank=True)
    execution_time = models.CharField(max_length=48, blank=True)
    executed = models.DateTimeField()
    ip_address = models.CharField(max_length=96, blank=True)
    class Meta:
        db_table = u'searchlog'
    
    def __unicode__(self):
        return self.words

class Source(models.Model):
    id = models.IntegerField(primary_key=True)
    name = models.CharField(max_length=150)
    class Meta:
        db_table = u'source'
        
    def __unicode__(self):
        return self.name

class Synonymes(models.Model):
    id = models.IntegerField(primary_key=True)
    word_group_id = models.IntegerField(null=True, db_column='word_group_ID', blank=True) # Field name made lowercase.
    word_id = models.IntegerField(null=True, db_column='word_ID', blank=True) # Field name made lowercase.
    baseword = models.IntegerField(null=True, blank=True)
    class Meta:
        db_table = u'synonymes'

    def __unicode__(self):
        return self.baseword
    
class Wlist(models.Model):
    id = models.IntegerField(primary_key=True)
    jid = models.IntegerField()
    wid = models.IntegerField()
    class Meta:
        db_table = u'wlist'
    
    def __str__(self):
        return '%s|%s'%(self.wid,self.jid)

class Words(models.Model):
    id = models.IntegerField(primary_key=True)
    gid = models.IntegerField()
    bid = models.IntegerField()
    word = models.CharField(max_length=384, blank=True)
    type = models.IntegerField()
    count = models.IntegerField()
    class Meta:
        db_table = u'words'
    
    def __unicode__(self):
        return self.word
