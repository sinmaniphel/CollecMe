from django.db import models 
from django.contrib.auth.models import User,Group
import core, nomenclature


'''
You can't expect all collectors to socialize with everyone else.
Collecting tends to create jealousy and animosity, and, well, providing collectors with circles
of other collectors they appreciate is, IMHO, needed
'''
class CollectorCircle(models.Model): 
    
    cc_title = models.ForeignKey(core.CollectionKind)
    cc_members = models.ManyToManyField(User)
    cc_description = models.TextField()

# TODO : work on permisions for circles, such as moderators and admins
