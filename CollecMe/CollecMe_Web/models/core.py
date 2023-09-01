from django.db import models
from django.contrib.auth.models import User

import nomenclature

# TODO: that's not ok, should not depend on user, should depend on a UUID or something like that
def user_directory_path(instance, filename):
    # file will be uploaded to MEDIA_ROOT/user_<id>/<filename>
    return "user_{0}/{1}".format(instance.user.id, filename)

'''
A collection kind is a acknowledge category in which several collectors can share a common interest.
Some of them are old as heck, like walking sticks (rabology) or coins (numismatics)
Some are err... Newer and sometimes weird, but c'est la vie (if this this ever catches on, we are going to have some serious eyebrows raising)

Collection kinds have diverse kind of relations with other kinds.
For example, artemisophilia (absinthe related stuff) is a subset of bistrophilia and have crossovers with advertising
Tamagochi collection can be seen as a subset of both video games and keychains

But well, let's keep that for another time
'''
class CollectionKind(models.Model):
    
    ck_name = models.CharField(max_length=256)
    # Let's be playfull with this one. They should be short like glacophilia or numismatics but you never know
    ck_sci_name = models.CharField(max_length=64)
    ck_description = models.TextField()



'''
This one is going to be a headache in the whole development process.
Let's call a collection a CuratedCollection, by opposition to the IT term "collection"
'''
class CuratedCollection(models.Model):
    curcol_curator = models.ForeignKey(User, on_delete=models.CASCADE)
    curcol_name = models.CharField(max_length=256)
    curcol_description = models.TextField()
    curcol_kind = models.ManyToManyField(CollectionKind)


'''
In each kind of collection you may have several types of items you can collect
Militaria, in that aspect is HUGE for example. It includes firearms, uniforms or pieces of uniforms, canteens, you name it
Numismatics includes coins, medals, but also bills and to some extent deeds and other documents
And let's not talk about toy collectors

Some are fare more specific like tyrosemiophiles (cheese labels) luckily

For now we will associated a type with a nomenclature
'''
class CollectableType(models.Model):
    ct_name = models.CharField(max_length=256)
    ct_nomenclature = models.ForeignKey(nomenclature.Nomenclature)


'''
That is going to be the main element of our system.

And so this is tricky
In some cases, there is only one instance of the collectable, like for a unique painting, or a custom made item
In some cases, there are "copies" of the collectable 
So there is more or less an abstract object and a concrete one

Both can be created from a nomenclature, or from the other kind.
For example, the first time a new absinthe spoon is documented, it can be described as unique, but as soon as two are found there is a "model"
On the other hand, it should be easy to say "hey, I have one of these, here is how it is and how well preserved it is"

'''
class Collectable(models.Model):
    
    col_name = models.CharField(max_length=256,null=False)
    col_main_picture = models.FileField(upload_to=user_directory_path)
    # A collectable can be in several collections
    col_description = models.TextField()
    #
    def __str__(self):
        return self.col_name

class CollectableInstance(models.Model):
    # a collectable, as a physical item, has an owner, someone who has the "abusus" of the object, but not necesarrily the usus or the fruitus
    ci_owner = models.ForeignKey(User, on_delete=models.CASCADE)
    # nullable = true
    ci_instanceof = models.ForeignKey(Collectable)
    ci_curcol = models.ManyToManyField(CuratedCollection)
    