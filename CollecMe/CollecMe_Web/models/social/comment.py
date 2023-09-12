from django.db import models 
from django.contrib.auth.models import User,Group
import core, nomenclature


''' 
Will be a comment or a post. Whatever
'''
class Comment(models.Model):
    com_item = models.ForeignKey(core.CollectableInstance,on_delete=models.CASCADE)
    com_timestamp = models.DateTimeField(auto_now=True)
    com_author = models.ForeignKey(User)
    com_text = models.TextField()
    
#(joy, fear, anger, sadness, disgust, shame, and --guilt-- puzzled).
class ReactionType(models.TextChoices):
    LIKE = "LIK", _("Like")
    UNLIKE = "ULK", _("Unlike")
    JOY = "JOY", _("Joy")
    BRAVO = "BRA", _("Bravo")
    FEAR = "FEA", _("Fear")
    ANGER = "ANG", _("Anger")
    SADNESS = "SAD", _("Sadness")
    DISGUST = "DIS", _("Disgust")
    SHAME = "SHA", _("Shame")
    PUZZLED = "PUZ", _("Puzzled")


class CommentReaction(models.Model):
    creac_comment = models.ForeignKey(Comment,on_delete=models.CASCADE)
    creac_timestamp = models.DateTimeField(auto_now=True)
    creac_author = models.ForeignKey(User)
    creac_type = models.CharField(max_length=3,
                                  choices=ReactionType.choices,
                                  default=ReactionType.LIKE
                                  )
    
    