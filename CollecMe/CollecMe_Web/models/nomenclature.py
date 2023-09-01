from django.db import models

'''
So here is how it works in my mind.
Any kind of collectable is described by collectors using some kind of nomenclature.
For watches for example, you will have the general type, the mechanism, the size, the maker with a list of know maker
Stamps or coins have a face value, a country of origin, a condition with specific names (like "mint" or "fleur de coin") etc etc

When creating a new collectable, the user should be provided with a helpful nomenclature.
Let's say that I collect razors, I should automatically have fields like the size, the grinding, the kind of steel etc

Which means that in the future there will be a need of curators for the nomenclatures on the type of collections most represented on the site.
A vote system could be a plus
'''       
class Nomenclature(models.Model):
    
    nom_name = models.CharField(max_length=256)
    
    
class NomenclatureField(models.Model):
    
    nf_nomenclature = models.ForeignKey(Nomenclature, on_delete=models.CASCADE)
    nf_name = models.CharField(max_length=256)
    nf_mandatory = models.BooleanField(default=False);
    nf_restricted_values = models.BooleanField(default=False)
    
class NomenclatureFieldAllowedValues(models.Model):
    nfav_nom_field = models.ForeignKey(NomenclatureField)    
    nfav_val = models.CharField(max_length=100)